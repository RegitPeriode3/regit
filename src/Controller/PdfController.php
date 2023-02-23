<?php

namespace App\Controller;

use App\Service\PdfService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

#[Route('/pdf')]
class PdfController extends AbstractController
{
    #[Route('/{PdfId}', name: 'GetPdf', methods: ['GET'])]
    public function GetPdf($PdfId,PdfService $pdfService): Response
    {
        return $this->json($pdfService->GetPdf());
    }

    #[Route('/CreatePdf/', name: 'CreatePdf', methods: ['POST'])]
    public function CreatePdf(PdfService $pdfService, Request $request): Response
    {
        $id = $request->request->get('id');
        return $this->json($pdfService->CreatePdf());
    }

    #[Route('/SavePdf/', name: 'SavePdf', methods: ['POST'])]
    public function SavePdf(PdfService $pdfService): Response
    {
        return $this->json($pdfService->SavePdf());
    }
}
