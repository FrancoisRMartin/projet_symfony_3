<?php

namespace App\Controller;

use App\Service\CartService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="app_panier")
     */
    public function index(CartService $cs): Response
    {
        return $this->render('panier/index.html.twig', [
            'items' => $cs->getCartWithData(),
            'total' => $cs->getTotal()
        ]);
    }

    /**
     * @Route("/panier/add/{id}", name="panier_add")
     */
    public function add($id, CartService $cs)
    {
        $cs->add($id);
        return $this->redirectToRoute('app_panier');
    }
    
    /**
     * @Route("/panier/minus/{id}", name="panier_minus")
     */
    public function minus($id, CartService $cs)
    {   
        $cs->minus($id);
        return $this->redirectToRoute('app_panier');
    }

    /**
     * @Route("/panier/remove/{id}", name="panier_remove")
     */
    public function remove($id, CartService $cs)
    {
        $cs->remove($id);
        return $this->redirectToRoute('app_panier');
    }

    /**
     * @Route("/panier/deleteAll", name="panier_delete_all")
     */
    public function deleteAll(RequestStack $rs)
    {
        $session = $rs->getSession();

        $session->remove("cart");
        return $this->redirectToRoute('app_panier');
    }
}
