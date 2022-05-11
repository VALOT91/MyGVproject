<?php

namespace App\Controller;
 
 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

 
// affichage de la page de paiement reussi
#[Route('customer/paiement')]
class PaiementReussiController extends AbstractController
{
    private $session;
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;   
    }  

#[Route('/', name: 'paiementReussi', methods: ['GET'])]
public function index(): Response
{
        $this->session->set('cart',[]);
    return $this->render('customer/paiement/paiementReussi.html.twig') ;
}

}