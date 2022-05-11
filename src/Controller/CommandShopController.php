<?php 

namespace App\Controller;

use App\Entity\User;
use App\Services\CommandService;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CommandShopRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandShopController extends AbstractController
{
    // liste les commandes
    #[Route('/admin/commande/liste', name: 'command_shop_list')]
    public function commandShopList(CommandShopRepository $commandShopRepository,  PaginatorInterface $paginator,  Request $request)
    {
        /** @var User $user */
        $user = $this->getUser();

        // initialise le paginator avec le findby 
        $commandShop = $paginator->paginate($commandShopRepository->findBy( array(),
        [
            'id' => 'desc'
        ]), $request->query->getInt('page', 1), 8 );
        
        return $this->render("admin/commande/list.html.twig",[
            'commandShop' => $commandShop
        ]);
    } 

    // validation de la livraison
    #[Route('/{id}/Exp', name: 'command_livraison', methods: ['GET', 'POST'])]
    public function validate(int $id,CommandShopRepository $commandShopRepository, EntityManagerInterface $entityManager): Response
    {
        $entity = $commandShopRepository->find($id);
        $entity->setIsshipped(!$entity->getIsshipped());
        $entityManager->flush();
    
        return $this->redirectToRoute("command_shop_list");
    }

    // affiche le détail d'une commande
    #[Route('admin/commande/detail/{id}', name: 'command_shop_detail')]
    public function commandShopDetail($id,CommandShopRepository $commandShopRepository,ProductRepository $productRepository)
    {
        /** @var User $user */
        $user = $this->getUser();

        $products = [];
       
        $commandShop = $commandShopRepository->find($id);        // renvoie la commande qui a une relation avec commandeShopLIne contenant
        foreach ($commandShop->getCommandShopLines() as $item)   // la liste des produits de la commande
        {
            $product = $productRepository->Find($item->getProduitId());  //  La boucle foreach retourne chaque détail de produits
            
            $commandService = new CommandService();
            $commandService->setProduct( $product);                             // produit 
            $commandService->setQte($item->getQuantity());                      // quantité 
            $commandService->setUnitPrice($item->getUnitPrice());               // prix unitaire
            $commandService->setConditionnement($item->getConditionnement());   // conditionnement 
           
              $products [] =  $commandService;  // ajout dans le tableau
        }
          
        if(!$commandShop)
        {
            $this->addFlash("danger","Commande introuvable");
            return $this->redirectToRoute("command_shop_list");
        }
      

        return $this->render("admin/commande/detail.html.twig",[
            'commandShop' => $commandShop,'products'=>$products
        ]);
    } 
}