<?php

namespace App\Controller;

use App\Service\invoiceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/invoice', name: 'app_invoice')]
class InvoiceController extends AbstractController
{

    #[Route('/SetCompaniesInvoice', name: 'SetCompaniesInvoice', methods: ['GET'])]
    public function SetCompaniesInvoice(invoiceService $invoiceService): Response
    {
        return $this->json($invoiceService->SetCompaniesInvoice());
    }

    #[Route('/GetCompanyInvoiceRows/{companyId}', name: 'GetCompanyInvoiceRows', methods: ['GET'])]
    public function GetCompanyInvoiceRows($companyId, invoiceService $invoiceService): Response
    {
        return $this->json($invoiceService->GetCompanyInvoiceRows($companyId));
    }

    #[Route('/toggleFactureren', name: 'toggleFactureren', methods: ['POST'])]
    public function toggleFactureren(invoiceService $invoiceService, Request $request): Response
    {
        //($request->getContent());
        $parameters = json_decode($request->getContent(), true);
        //return $this->json($invoiceService->toggleFactureren($request->get('invoiceRowId'), $request->get('bool')));
        return $this->json($invoiceService->toggleFactureren($parameters["invoiceRowId"], $parameters["bool"]));
    }

    #[Route('/createInvoice', name: 'createInvoice', methods: ['POST'])]
    public function createInvoice(invoiceService $invoiceService, Request $request): Response
    {

        $parameters = json_decode($request->getContent(), true);
        return $this->json($invoiceService->createInvoice($parameters));
    }

}
