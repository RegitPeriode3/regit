<?php

namespace App\Controller;

use App\Service\invoiceService;
use App\Service\mailService;
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

    #[Route('/GetCompanyInvoiceRows/{companyId}/{dateFrom}/{dateTill}/', name: 'GetCompanyInvoiceRows', methods: ['GET'])]
    public function GetCompanyInvoiceRows($companyId, $dateFrom, $dateTill, invoiceService $invoiceService): Response
    {
        return $this->json($invoiceService->GetCompanyInvoiceRows($companyId, $dateFrom, $dateTill));
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

    #[Route('/sendMail', name: 'sendMail', methods: ['POST'])]
    public function sendMail(mailService $mailService, Request $request): Response
    {
//        $parameters = json_decode($request->getContent(), true);
        return $this->json($mailService->email());
    }

}
