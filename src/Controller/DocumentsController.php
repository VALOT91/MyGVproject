<?php

namespace App\Controller;

use App\Services\ImageFinder;
use App\Form\DocumentType;
use App\Services\HandleImage;
use App\Repository\CommandShopRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 

#[Route('admin/documents')]
class DocumentsController extends AbstractController
{
    // suppression d'un fichier sur serveur
    #[Route('/{id}','admin/delete/documents', name: 'documents_delete',  methods: ['GET', 'POST'])]
    public function delete($id,Request $request ): Response
    {
        // j'utilise le csrf pour renforcer la sécurité 
         if ($this->isCsrfTokenValid('delete'.$id, $request->request->get('_token'))) {
          
            $file_path = $id;
            if(file_exists($file_path)) unlink($file_path);       // suppression    
        }
        return $this->redirectToRoute('documents_index', [], Response::HTTP_SEE_OTHER);
    }
    
    // affichage/ajout de fichiers sur le serveur
    #[Route('admin/liste/documents', name: 'documents_index',  methods: ['GET', 'POST'])] 
    public function index(CommandShopRepository $commandShopRepository, PaginatorInterface $paginator, HandleImage $handleImage,Request $request ): Response
    {
        $finder = new ImageFinder();
        $filesTab = $finder->GetUploadDirectory();   // chargement du répertoire uploads dans filesTab
        
        $files =  $paginator->paginate($filesTab,$request->query->getInt('page', 1),6); // initialisation de la pagination

        $form = $this->createForm(DocumentType::class );
        $form->handleRequest($request);


        // Le formulaire contient un seul champs du path de l'image
        if ($form->isSubmitted() && $form->isValid()) {

               //Recuperer le fichier 
            /** @var UploadedFile $file */
            $file = $form->get('image_path')->getData();

            //Verifier que il y a bien un fichier
            if($file)
            { 
                $handleImage->save($file);
            }
            return $this->redirectToRoute('documents_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderform('admin/documents/index.html.twig', [
            'files' => $files, 'form' => $form
        ]);
    }
}
