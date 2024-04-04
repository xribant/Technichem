<?php

namespace App\Controller\Admin;

use App\Entity\Block;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BlockCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Block::class;
    }

    
    
    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('title', 'Nom');
        yield TextField::new('slug', 'Slug')->onlyOnIndex();
        
    }
    
    
}
