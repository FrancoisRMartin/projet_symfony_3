<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProduitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Produit::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('titre', 'Titre'),
            TextareaField::new('description', 'Description')->renderAsHtml()->hideOnForm(),
            TextEditorField::new('description', 'Description')->onlyOnForms(),
            ChoiceField::new('collection', 'Collection')->setChoices([
                'Homme' => 'Homme',
                'Femme' => 'Femme',
                'Mixte' => 'Mixte',
            ]),
            ChoiceField::new('couleur', 'Couleur')->setChoices([
                'Blanc' => 'blanc',
                'Noir' => 'noir',
                'Bleu' => 'bleu',
                'Rouge' => 'rouge',
                'Vert' => 'vert',
                'Gris' => 'gris',
            ]),
            ChoiceField::new('taille', 'Taille')->setChoices([
                'S' => 'S',
                'M' => 'M',
                'L' => 'L',
            ]),
            IntegerField::new('prix'),
            //MoneyField::new('prix')->setCurrency('EUR')->setStoredAsCents(false),
            IntegerField::new('stock'),
            ImageField::new('photo')
                ->setBasePath('images/produits/')
                ->setUploadDir('public/images/produits')
                ->setRequired(false)
                ->setUploadedFileNamePattern('[ulid].[extension]'),
            //DateTimeField::new('dateEnregistrement', "Date<br>Enregistrement")->setFormat("dd/MM/Y HH:mm:ss"),
            //DateTimeField::new('updatedAt', 'Date de MAJ')->onlyOnForms(),
        ];
    }

    public function createEntity(string $entityFqcn)
    {
        $produit = new Produit();
        $produit->setDateEnregistrement(new \DateTime);
        $produit->setUpdatedAt(new \DateTime);
        $ifile = $produit->getImageFile();
        if(!$ifile)
        {
            $produit->setPhoto('default.png');
        }
        return $produit;
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        // La fonction sera exécuter lors de la creation d'un article avant ADD Article
        $ifile = $entityInstance->getPhoto();

        if(!$ifile)
        {
            $entityInstance->setPhoto('default.png');
        }
        $entityInstance->setUpdatedAt(new \DateTime);
        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }    
}
