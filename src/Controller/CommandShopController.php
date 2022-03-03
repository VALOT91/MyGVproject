<?php 

namespace App\Controller;

use App\Entity\User;
use App\Services\CommandService;
use App\Repository\ProductRepository;
use App\Repository\CommandShopRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandShopController extends AbstractController
{
    #[Route('/admin/commande/liste', name: 'command_shop_list')]
    public function commandShopList(CommandShopRepository $commandShopRepository,  PaginatorInterface $paginator,  Request $request)
    {
        /** @var User $user */
        $user = $this->getUser();

        $commandShop = $paginator->paginate($commandShopRepository->findBy( array(),
        [
            'id' => 'desc'
        ]), $request->query->getInt('page', 1), 8 );
        
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
            $commandService->setConditionnement($item->getConditionnement());
           
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