<?php

namespace App\Controller;

use App\Repository\CommandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    /**
     * @Route("/profil", name="app_profil")
     */
    public function index(CommandeRepository $repo): Response
    {   

        $commandes = $repo->findAll();
        
        return $this->render('profil/index.html.twig', [
            'tabCommandes' => $commandes
        ]);
    }
}
