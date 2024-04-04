<?php

namespace App\Controller\Admin;

use App\Entity\Page;
use App\Entity\Slide;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Form\SlideFormType;
use DateTimeImmutable;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class PageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Page::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setPageTitle('index', 'Index des pages du site');
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

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->setPermission(Action::DELETE, 'ROLE_SUPER_ADMIN')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        yield FormField::addTab('Contenu')
            ->setIcon('fa-solid fa-file');
        yield IntegerField::new('id', 'ID')->onlyOnIndex();
        yield TextField::new('title', 'Titre');
        yield TextField::new('slug', 'Slug')->onlyOnIndex();
        yield ImageField::new('banner', 'Banner image')
            ->setBasePath('assets/media')
            ->setUploadDir('public/assets/media/')
        ;
        
        yield DateTimeField::new('updated_at', 'Modifié le')->onlyOnIndex();
        yield AssociationField::new('last_modified_by', 'Dernière modification')->onlyOnIndex();

        yield FormField::addTab('Slider')
            ->setIcon('fa-solid fa-images');

        yield CollectionField::new('slides')
            ->setEntryType(SlideFormType::class)
        ;

        yield FormField::addTab('Blocs')
            ->setIcon('fa-solid fa-cube');
    }

}
