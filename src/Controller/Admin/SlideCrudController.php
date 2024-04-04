<?php

namespace App\Controller\Admin;

use App\Entity\Slide;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SlideCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Slide::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('title', 'Titre principal');
        yield TextField::new('text', 'Texte secondaire');
        yield ImageField::new('background', 'Image de fond')
            ->setBasePath('assets/media')
            ->setUploadDir('public/assets/media/')
        ;
        yield TextField::new('link','Lien vers une ressource');
        
    }

}
