<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\PageRepository;
use App\Repository\ProductCategoryRepository;
use App\Repository\ProductRepository;

class ProductsCategoryPageController extends AbstractController
{
    #[Route('/nos-produits/{category_slug}', name: 'products_category_page')]
    public function index(PageRepository $pageRepository, ProductRepository $productRepository, ProductCategoryRepository $productCategoryRepository, $category_slug): Response
    {
        $productCategory = $productCategoryRepository->findOneBy(['slug' => $category_slug]);
        $products = $productRepository->findBy(['category' => $productCategory]);

        return $this->render('pages/products_by_category.html.twig', [
            'products' => $products,
            'category' => $productCategory
        ]);
    }
}
