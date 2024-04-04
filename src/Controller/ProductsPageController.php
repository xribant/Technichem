<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\PageRepository;

class ProductsPageController extends AbstractController
{
    #[Route('/nos-produits', name: 'our_products_page')]
    public function index(PageRepository $pageRepository): Response
    {
        return $this->render('pages/our_products.html.twig', [
            'page' => $pageRepository->findOneBy(['title' => 'Nos Produits'])
        ]);
    }
}
