<?php

namespace App\Controller\Admin;

use App\Entity\ProductCategory;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use DateTimeImmutable;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class ProductCategoryCrudController extends AbstractCrudController
{
    
    public static function getEntityFqcn(): string
    {
        return ProductCategory::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setPageTitle('index', 'Index des catégories de produits')
            ->setPageTitle('new', 'Créer une nouvelle catégorie')
            ->setEntityLabelInSingular('Catégorie')
            ->setEntityLabelInPlural('Catégories')
        ;
    }

    public function createEntity(string $entityFqcn)
    {
        $category = new ProductCategory();
        $category->setLastModifiedBy($this->getUser());

        return $category;
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
        yield TextField::new('name', 'Nom');
        yield ImageField::new('image', 'Illustration')
            ->setBasePath('assets/media')
            ->setUploadDir('public/assets/media/')
        ;

        yield DateTimeField::new('updated_at', 'Modifié le')->onlyOnIndex();
        yield AssociationField::new('last_modified_by', 'Dernière modification')->onlyOnIndex();

        
    }
}
