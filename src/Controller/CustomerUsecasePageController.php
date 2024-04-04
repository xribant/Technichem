<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\CompanyDataRepository;

class CustomerUsecasePageController extends AbstractController
{
    #[Route('/realisations-clients', name: 'customer_usecase_page')]
    public function index(CompanyDataRepository $companyDataRepository): Response
    {
        return $this->render('pages/customer_usecases.html.twig', [
            'company_data' => $companyDataRepository->findOneBy(['id' => 1])
        ]);
    }
}
