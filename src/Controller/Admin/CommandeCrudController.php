<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Commande;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CommandeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commande::class;
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            AssociationField::new('membre', 'Membre')
                    ->setTemplatePath('admin/field/membres.html.twig')
                    ->onlyOnIndex(),
            AssociationField::new('produit')
                    ->setTemplatePath('admin/field/produits.html.twig')
                    ->onlyOnIndex(),
            IntegerField::new('quantite')->onlyOnIndex(),
            IntegerField::new('montant')->onlyOnIndex(),
            ChoiceField::new('etat', 'Etat')->setChoices([
                'En traitement' => 'En traitement',
                'Payement confirmé' => 'Payement confirmé',
                'Livraison en cours' => 'Livraison en cours',
                'Produit livré' => 'Produit livré',
            ]),
            DateTimeField::new('dateEnregistrement', "Date<br>Enregistrement")->setFormat("dd/MM/Y HH:mm:ss")->onlyOnIndex(),
        ];
    }
 
}
