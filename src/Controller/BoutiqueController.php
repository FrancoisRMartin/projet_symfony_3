<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BoutiqueController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function home(ProduitRepository $repo): Response
    {
        
        $produits = $repo->findBy([], ['dateEnregistrement' => 'DESC'], 3); // ou ASC pour le premier créé
        return $this->render('boutique/index.html.twig', [
            'tabProduits' => $produits
        ]);
    }

    /**
     * @Route("/boutique", name="app_produits")
     */
    public function index(ProduitRepository $repo): Response
    {
        $produits = $repo->findAll();

        return $this->render('boutique/boutique.html.twig', [
            'tabProduits' => $produits
        ]);
    }

    /**
     * @Route("/boutique/produit/{id}", name="show_produit")
     */
    public function show($id, ProduitRepository $repo): Response
    {
        $produit = $repo->find($id);

        return $this->render('boutique/show.html.twig', [
            'produit' => $produit
        ]);
    }
}
