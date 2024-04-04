<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Form\ProductImageFormType;
use DateTimeImmutable;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setPageTitle('index', 'Index des Produits')
            ->setPageTitle('new', 'Créer un nouveau produit')
            ->setEntityLabelInSingular('Produit')
            ->setEntityLabelInPlural('Produits')
        ;
    }

    public function createEntity(string $entityFqcn)
    {
        $product = new Product();
        $product->setLastModifiedBy($this->getUser());

        return $product;
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $user = $this->getUser();
        if (!$user instanceof User) {
            throw new \LogicException('Currently logged in user is not an instance of User?!');
        }
        $entityInstance
            ->setLastModifiedBy($user)
            ->setUpdatedAt(new DateTimeImmutable());
        parent::updateEntity($entityManager, $entityInstance);
    }

    public function configureFields(string $pageName): iterable
    {
        yield FormField::addTab('Détails')
            ->setIcon('fa-solid fa-file-lines')
        ;
        yield TextField::new('reference', 'Référence');
        yield TextField::new('name', 'Nom');
        yield AssociationField::new('category', 'Catégorie');
        
        yield AssociationField::new('last_modified_by', 'Dernière modification')
            ->onlyOnIndex()
        ;
        yield DateTimeField::new('updated_at', 'Modifié le')
            ->onlyOnIndex()
        ;

        yield FormField::addTab('Image(s)')
            ->setIcon('fa-solid fa-images')
        ;
        yield CollectionField::new('product_images', 'Illustration(s)')
            ->setEntryType(ProductImageFormType::class)
            ->onlyOnForms()
        ;

        yield FormField::addTab('Fiche(s) technique(s)')
            ->setIcon('fa-solid fa-file-invoice')
        ;
        yield CollectionField::new('product_data_sheets', 'Fiche(s) technique(s)');


        
    }
}
