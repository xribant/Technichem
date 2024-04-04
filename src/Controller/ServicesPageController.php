<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\PageRepository;

class ServicesPageController extends AbstractController
{
    #[Route('/nos-services', name: 'our_services_page')]
    public function index(PageRepository $pageRepository): Response
    {
        return $this->render('pages/our_services.html.twig', [
            'page' => $pageRepository->findOneBy(['slug' => 'nos-services'])
        ]);
    }
}
