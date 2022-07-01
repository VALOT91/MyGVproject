<?php 

namespace App\Controller;

use App\Services\CartService;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProduitConditionnementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    private $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    // ajoute un à la quantité de l'article dans le panier
    #[Route('/panier/plus/{id}', name: 'cart_plus')]
    public function plus(int $id ,ProduitConditionnementRepository $produitConditionnementRepository,Request $request)
    {  
        $produitConditionnementRepository = $produitConditionnementRepository->find($id);
        
        if(!$produitConditionnementRepository)
        {
            $this->addFlash("danger","Produit introuvable");
            return $this->redirectToRoute("home");
        } 
                
        // increment de la qté
        $this->cartService->add($id);

        $this->addFlash("success","Le produit a bien été ajouté au panier");
        
              return $this->redirectToRoute("cart_detail");  
       
    }

 // ajoute un à la quantité de l'article dans le panier
 #[Route('/panier/ajouter/{id}', name: 'cart_add')]
 public function add(int $id ,ProduitConditionnementRepository $produitConditionnementRepository,Request $request)
 { 
     $produitConditionnementRepository = $produitConditionnementRepository->find($id);
     
     if(!$produitConditionnementRepository)
     {
         $this->addFlash("danger","Produit introuvable");
         return $this->redirectToRoute("home");
     } 
                
     // increment de la qté
     $this->cartService->add($id);
 
     $this->addFlash("success","Le produit a bien été ajouté au panier");
           
           
          $route = $request->headers->get('referer');  // referrer permet de connaitre la page d'ou je viens

          return $this->redirect($route);   // retour à la page précédente aprés l'ajout
    
 }

    // supprimer l' article du panier
    #[Route('/panier/supprimer/{id}', name: 'cart_remove')]
    public function delete(int $id,ProduitConditionnementRepository $produitConditionnementRepository)
    {
        $produitConditionnementRepository = $produitConditionnementRepository->find($id);

        if(!$produitConditionnementRepository)
        {
            $this->addFlash("danger","Produit introuvable");
            return $this->redirectToRoute("cart_detail");
        } 

        // suppression par id
        $this->cartService->remove($id);

        $this->addFlash("success","Le produit a bien été supprimé du panier");
        return $this->redirectToRoute("cart_detail");
    }

    // renvoie le détail du panier
    #[Route('/panier/detail', name: 'cart_detail')]
    public function detail()
    {
        // renvoie un tableau de tous les produits
        $cart = $this->cartService->detail();
 
        // renvoie le total des montants
        $totalCart = $this->cartService->getTotal();
        
        return $this->render("customer/panier/detail.html.twig",[
            'cart' => $cart,
            'totalCart' => $totalCart
        ]);
    }

    // décremente la qté du panier
    #[Route('/panier/decrementer/{id}', name: 'cart_decrement')]
    public function decrementProduct(int $id,ProduitConditionnementRepository $produitConditionnementRepository)
    {
        // $product = $productRepository->find($id);
        $produitConditionnementRepository = $produitConditionnementRepository->find($id);
        
        if(!$produitConditionnementRepository)
        {
             $this->addFlash("danger","Le produit est introuvable.");
             return $this->redirectToRoute("cart_detail");
        }

        // decrement 
        $this->cartService->decrement($id);

        $this->addFlash("success","La quantité du produit a bien été décrémentée.");
        return $this->redirectToRoute("cart_detail");
    }
}