<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\PageRepository;

class TechnicalDocPageController extends AbstractController
{
    #[Route('/documentation-technique', name: 'technical_doc_page')]
    public function index(PageRepository $pageRepository): Response
    {
        return $this->render('pages/technical_doc.html.twig', [
            'page' => $pageRepository->findOneBy(['slug' => 'documentation-technique'])
        ]);
    }
}
