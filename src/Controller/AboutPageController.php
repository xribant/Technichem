<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\CompanyDataRepository;

class AboutPageController extends AbstractController
{
    #[Route('/about', name: 'about_page')]
    public function index(CompanyDataRepository $companyDataRepository): Response
    {
        return $this->render('pages/about.html.twig', [
            'company_data' => $companyDataRepository->findOneBy(['id' => 1])
        ]);
    }
}
