<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Produit;
use App\Entity\Commande;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('MyShop-Backoffice');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToRoute('Home', 'fa fa-home', 'home'),
            //MenuItem::linkToDashboard('Admin', 'fa fa-gear'),
            MenuItem::section('e-Boutique', 'fa fa-store'),
            MenuItem::linkToCrud('Produits', 'fa fa-gifts', Produit::class),
            MenuItem::linkToCrud('Commandes', 'fa fa-cart-arrow-down', Commande::class),
            MenuItem::section('Utilisateurs', 'fa fa-users-line'),
            MenuItem::linkToCrud('Membres', 'fa fa-users', User::class),
        ];
    }
}
