<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\CompanyDataRepository;
use App\Repository\LabelRepository;
use App\Repository\PageRepository;
use App\Repository\ProductCategoryRepository;

class HomepageController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(CompanyDataRepository $companyDataRepository, PageRepository $pageRepository, ProductCategoryRepository $productCategoryRepository, LabelRepository $labelRepository): Response
    {
        $page = $pageRepository->findOneBy(['title' => 'Accueil']);
        $categories = $productCategoryRepository->findAll();
        $labels = $labelRepository->findAll();

        return $this->render('homepage.html.twig', [
            'company_data' => $companyDataRepository->findOneBy(['id' => 1]),
            'page' => $page,
            'categories' => $categories,
            'labels' => $labels
        ]);
    }
}
