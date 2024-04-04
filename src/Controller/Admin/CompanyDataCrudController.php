<?php

namespace App\Controller\Admin;

use App\Entity\CompanyData;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use Symfony\Component\HttpFoundation\RedirectResponse;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;

class CompanyDataCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CompanyData::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
      return  $crud->setPageTitle('edit', 'Détails de la société');
    }
    
    public function configureFields(string $pageName): iterable
    {
        yield FormField::addTab('Contact')
            ->setIcon('fa-solid fa-phone');
        yield TextField::new('name', 'Nom');
        yield TextField::new('address', 'Adresse');
        yield TextField::new('postal_code', 'Code postal');
        yield TextField::new('city', 'Ville');
        yield TextField::new('phone1', 'Téléphone 1');
        yield TextField::new('phone2', 'Téléphone 2');
        yield TextField::new('email', 'E-Mail');

        yield FormField::addTab('RGPD')
            ->setIcon('fa-solid fa-shield-halved');
        
    }

    protected function getRedirectResponseAfterSave(AdminContext $context, string $action): RedirectResponse
    {
       
        return $this->redirect('admin');

        return parent::getRedirectResponseAfterSave($context, $action);
    }
    
}
