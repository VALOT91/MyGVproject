<?php 

namespace App\Services;

use App\Services\CartItem;
use App\Services\CartRealProduct;
use App\Repository\ProduitConditionnementRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 

class CartService extends AbstractController
{
    private $session;
    private $produitConditionnementRepository;
         
    public function __construct(SessionInterface $session,ProduitConditionnementRepository $produitConditionnementRepository)
    {
        $this->session = $session;   
        $this->produitConditionnementRepository = $produitConditionnementRepository;
    }

    public function getCart()
    {
        return $this->session->get('cart',[]);
    }

    public function saveCart(array $cart)
    {
        return $this->session->set('cart',$cart);
    }

    public function add($id)
    {
        //Je vais chercher mon panier
        $cart = $this->getCart();

        foreach($cart as $item)
        {
            if($item->getId() === $id)
            {
                $qtyActuel = $item->getQty();

                $item->setQty($qtyActuel + 1);

                $this->saveCart($cart);
                return;
            }
        }

        //J'ajoute dans le panier un ITEM qui va representer chaque element du panier
        $cartItem = new CartItem();
        $cartItem->setId($id);
        $cartItem->setQty(1);

        $cart[] = $cartItem;

        $this->saveCart($cart);
        return;
    }

    public function detail()
    {
        //j'initialise un tableau vide
        $detailCart = [];
        $detail = [];
        $total=0;

        // récupére le rôle en cours du user pour définir le tarif à ajouter (pro ou public)
        $role = $this->getUser()->getRoles()[0];
      
        //je vais chercher mon panier
        $cart = $this->getCart();

        $typePrice="";

        if($role==="ROLE_ADMIN" || $role==="ROLE_CLIENT")
        {
            $typePrice= "PRIX_PRO";
        }
        else
        {
             $typePrice="PRIX_PUBLIC";
        }
   //  dd($cart);
        //Je boucle sur mon panier
        foreach($cart as $item)
        {
             //recherche le produitConditionnement avec l'id stocké dans le panier pour avoir access aux tarifs et conditionnement du produit
             $produitConditionnement = $this->produitConditionnementRepository->find($item->getId());
            // lit le conditionnement lié
             $conditionnementRepository = $produitConditionnement->getConditionnement(); 
             
            if(!$produitConditionnement)
            {
                continue;
            }
         
            $cartRealProduct = new CartRealProduct();
            $cartRealProduct->setProduct($produitConditionnement);                                  // données globale de la reference produit
            $cartRealProduct->setQty($item->getQty());                                              // quantité 
            $cartRealProduct->setConditionnement($conditionnementRepository->getDesignation());     // libellé du conditionnement
            
           

            // recherche le tarif actuel (pro ou public) en parcourant les tarifs liés à cette reference  comparaison sur le type de tarif.          
            foreach( $produitConditionnement->GetTarifs() as $tarif  )
            {
                if($tarif->getTypePrix() === $typePrice)
                {
                    $cartRealProduct->setPrice($tarif->getPrixUnitaire());
                    $cartRealProduct->setTypeprice($tarif->getTypePrix());
                    $total+=$tarif->getPrixUnitaire() * $item->getQty();
                }
            }
            
            $detailCart[] = $cartRealProduct;
        }
          
         $detail = ["detailCart" => $detailCart,"sousTotal"=>$total  ];
         return $detail; 
    }

    public function getTotal()
    {
        $total = 0;

        $cart = $this->getCart();

        foreach($cart as $item)
        {
            $produitConditionnement = $this->produitConditionnementRepository->find($item->getId());

            if(!$produitConditionnement)
            {
                continue;
            }

            $total += $item->getQty() ;
        }

        return $total;
    }

    public function remove(int $id)
    {
        //Je vais chercher mon panier
        $cart = $this->getCart();

        //Je boucle sur mon panier
        foreach($cart as $key => $item)
        {
            if($item->getId() === $id)
            {
                unset($cart[$key]);
                $this->saveCart($cart);
            }
        }
    }

    public function decrement(int $id)
    {
        //Je vais chercher mon panier
        $cart = $this->getCart();
         
        //Je boucle dessus
        foreach($cart as $key => $item)
        {
            if($item->getId() === $id)
            {
                $qty = $item->getQty();

                if($qty === 1)
                {
                    unset($cart[$key]);
                    $this->saveCart($cart);
                    return;
                }
                else 
                {
                    $item->setQty($qty - 1);
                    $this->saveCart($cart);
                    return;
                }
            }
        }
    }
}