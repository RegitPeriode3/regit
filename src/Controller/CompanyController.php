<?php

namespace App\Controller;

use App\Service\CompanyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header("Location: http://localhost/regit/pages/login.php");
    exit;
}
else {
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

        #[Route('/deleteCompany', name: 'deleteCompany', methods: ['POST'])]
        public function deleteCompany(CompanyService $companyService, Request $request): Response
        {
            $parameters = json_decode($request->getContent(), true);
            return $this->json($companyService->deleteCompany($parameters));
        }

        #[Route('/update', name: 'deleteCompany', methods: ['POST'])]
        public function UpdateCompany(CompanyService $companyService, Request $request): Response
        {
            $parameters = json_decode($request->getContent(), true);
            return $this->json($companyService->UpdateCompany($parameters));
        }


    }
}