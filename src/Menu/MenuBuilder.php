<?php 

// src/Menu/MenuBuilder.php

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class MenuBuilder
{
    private $factory;

    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu(RequestStack $requestStack)
    {
        $menu = $this->factory->createItem('main');

        $menu->addChild('Nos produits', ['route' => 'our_products_page']);
        $menu->addChild('Nos services', ['route' => 'our_services_page']);
        $menu->addChild('Documentation technique', ['route' => 'technical_doc_page']);
        $menu->addChild('Réalisations clients', ['route' => 'customer_usecase_page']);
        $menu->addChild('A propos', ['route' => 'about_page']);
        // ... add more children

        return $menu;
    }
}