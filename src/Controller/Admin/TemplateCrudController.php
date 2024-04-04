<?php

namespace App\Controller\Admin;

use App\Entity\Template;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Text;

class TemplateCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Template::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('name', 'Nom');
        yield TextField::new('slug', 'Slug')->onlyOnIndex();
        yield TextField::new('filename', 'Fichier');
    }
}
