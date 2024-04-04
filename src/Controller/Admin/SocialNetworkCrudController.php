<?php

namespace App\Controller\Admin;

use App\Entity\SocialNetwork;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SocialNetworkCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SocialNetwork::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
      return  $crud->setPageTitle('index', 'Réseaux sociaux')
        ->setPageTitle('new', 'Ajouter un réseau social');
    }
    
    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('title', 'Nom');
        yield TextField::new('icon', 'Tag Font Awesome');
        yield TextField::new('link', 'Lien vers la page Techichem');
    }
}
