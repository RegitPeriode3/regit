<?php

namespace App\Controller;

use App\Service\CompanyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/company', name: 'app_company')]
class CompanyController extends AbstractController
{

    #[Route('/', name: 'GetAllCompanyInfo', methods: ['GET'])]
    public function GetAllCompanyInfo(CompanyService $companyService): Response
    {
        return $this->json($companyService->GetAllCompanyInfo());
    }

    #[Route('/Create', name: 'CreateCompany', methods: ['POST'])]
    public function CreateCompany(CompanyService $companyService, Request $request): Response
    {
        $parameters = json_decode($request->getContent(), true);
        return $this->json($companyService->CreateCompany($parameters));
    }

}
