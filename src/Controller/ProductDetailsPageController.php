<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductDetailsPageController extends AbstractController
{
    #[Route('/nos-produits/{category_slug}/{product_slug}', name: 'product_details_page')]
    public function index(ProductRepository $productRepository, $product_slug): Response
    {
        return $this->render('pages/product_details.html.twig', [
            'product' => $productRepository->findOneBy(['slug' => $product_slug])
        ]);
    }
}
