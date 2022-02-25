<?php 

namespace App\Controller;
use DateTime;
use App\Entity\User;
use App\Services\CartItem;
use App\Entity\CommandShop;
use Doctrine\ORM\Mapping\Id;
use App\Services\CartService;
use App\Entity\CommandShopLine;
use App\Entity\DeliveryAddress;
use App\Form\DeliveryAddressType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RecapCommandController extends AbstractController
{
    #[Route('/commande/recapitulatif', name: 'command_recap')]
    public function recap(CartItem $cartitem, Request $request, EntityManagerInterface $em,CartService $cartService)
    {
        $deliveryAddress = new DeliveryAddress();

        $form = $this->createForm(DeliveryAddressType::class,$deliveryAddress);

        $form->handleRequest($request);

        $cart = $cartService->detail();

        $totalCart = $cartService->getTotal();

        /** @var User $user */
        $user = $this->getUser();

        if($form->isSubmitted() && $form->isValid())
        {
            //1ere etape : Creer la commande
            $commandShop = new CommandShop();
            $commandShop->setUser($user);
            $commandShop->setTotalPrice($totalCart);
            $commandShop->setCreatedAt(new \DateTime());
           
            
            $em->persist($commandShop);

            // Creer l'adresse de livraison
            $deliveryAddress->setCommandShop($commandShop);

            $em->persist($deliveryAddress);
            $em->flush();                 
                
        //    dd(item.product.getProduit().designation);
       

            //2eme etape : Creer les lignes de la commande 
             foreach($cart["detailCart"] as $item)
          
            {     
                $commandShopLine = new CommandShopLine();
                $commandShopLine->setCommandShop($commandShop);
                $commandShopLine->setProduct($item->getProduct()->getProduit());
                $commandShopLine->setQuantity($item->getQty());
                $commandShopLine->setProduitId($item->getProduct()->getProduit()->getId());     
                
                $em->persist($commandShopLine);
            }     
           
            //3eme etape bis : Flush vers BDD
            $em->flush();
             
            //4eme etape : rediriger vers Stripe
            return $this->redirectToRoute('stripe_checkout');
        }

        return $this->render("customer/commande/recap.html.twig",[
            'form' => $form->createView(),
            'cart' => $cart,
            'totalCart' => $totalCart

        ]);
    }
}