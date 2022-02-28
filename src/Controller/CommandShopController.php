<?php 

namespace App\Controller;

use App\Services\CommandService;
use App\Entity\User;
use App\Repository\CommandShopRepository;
use App\Repository\ProductRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandShopController extends AbstractController
{
    #[Route('/admin/commande/liste', name: 'command_shop_list')]
    public function commandShopList(CommandShopRepository $commandShopRepository)
    {
        /** @var User $user */
        $user = $this->getUser();

        // $commandShop = $commandShopRepository->findBy([
        //     'user' => $user
        // ],
        // [
        //     'createdAt' => 'DESC'
        // ]);

        $commandShop = $commandShopRepository->findAll( 
        [
            'createdAt' => 'DESC'
        ]);
        
        return $this->render("admin/commande/list.html.twig",[
            'commandShop' => $commandShop
        ]);
    } 

    #[Route('admin/commande/detail/{id}', name: 'command_shop_detail')]
    public function commandShopDetail($id,CommandShopRepository $commandShopRepository,ProductRepository $productRepository)
    {
        /** @var User $user */
        $user = $this->getUser();

        $products = [];
       
        $commandShop = $commandShopRepository->find($id);
        foreach ($commandShop->getCommandShopLines() as $item)
        {
            $product = $productRepository->Find($item->getProduitId());
            
            $commandService = new CommandService();
            $commandService->setProduct( $product);
            $commandService->setQte($item->getQuantity());
            $commandService->setUnitPrice($item->getUnitPrice());
           
              $products [] =  $commandService;
        }
          
        if(!$commandShop)
        {
            $this->addFlash("danger","Commande introuvable");
            return $this->redirectToRoute("command_shop_list");
        }
          //  dd($commandShop->getCommandShopLines()[0]->getProduct());
        // if($commandShop->getUser() !== $user)
        // {
        //     $this->addFlash("danger","Cette commande ne vous appartient pas. Impossible de la consulter.");
        //     return $this->redirectToRoute("command_shop_list");
        // }

        return $this->render("admin/commande/detail.html.twig",[
            'commandShop' => $commandShop,'products'=>$products
        ]);
    } 
}