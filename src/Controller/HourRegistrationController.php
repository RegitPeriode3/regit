<?php

namespace App\Controller;

use App\Service\HourRegistrationService;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header("Location: http://localhost/regit/pages/login.php");
    exit;
}
else {
    #[Route('/hourRegistration', name: 'app_hour_registration')]
    class HourRegistrationController extends AbstractController
    {
        #[Route('/calcHours/{from}/{till}', name: 'calcHours', methods: ['GET'])]
        public function calcHours($from, $till, HourRegistrationService $hourRegistrationService): Response
        {
            return $this->json($hourRegistrationService->calcHours($from, $till));
        }

        #[Route('/GetCompanyPerUser', name: 'GetCompanyPerUser', methods: ['GET'])]
        public function GetCompanyPerUser(HourRegistrationService $hourRegistrationService): Response
        {
            return $this->json($hourRegistrationService->GetCompanyPerUser());
        }

        #[Route('/GetProjectPerCompany/{companyId}', name: 'GetProjectPerCompany', methods: ['GET'])]
        public function GetProjectPerCompany($companyId, HourRegistrationService $hourRegistrationService): Response
        {
            return $this->json($hourRegistrationService->GetProjectPerCompany($companyId));
        }

        #[Route('/GetActivities', name: 'GetActivities', methods: ['GET'])]
        public function GetActivities(HourRegistrationService $hourRegistrationService): Response
        {
            return $this->json($hourRegistrationService->GetActivities());
        }

        #[Route('/RegisterHour', name: 'RegisterHour', methods: ['POST'])]
        public function RegisterHour(HourRegistrationService $hourRegistrationService, \Symfony\Component\HttpFoundation\Request $request): Response
        {
            //$parameters = $request->get('Date');
            $parameters = json_decode($request->getContent(), true);
            return $this->json($hourRegistrationService->RegisterHour($parameters));
        }

        #[Route('/getInvoiceRows/', name: 'getInvoiceRows', methods: ['GET'])]
        public function getInvoiceRows(HourRegistrationService $hourRegistrationService): Response
        {
            return $this->json($hourRegistrationService->getInvoiceRows());
        }

        #[Route('/DeleteHourReg', name: 'DeleteHourReg', methods: ['POST'])]
        public function DeleteHourReg(HourRegistrationService $hourRegistrationService, \Symfony\Component\HttpFoundation\Request $request): Response
        {
            //$parameters = $request->get('Date');
            $parameters = json_decode($request->getContent(), true);
            return $this->json($hourRegistrationService->DeleteHourReg($parameters));
        }
    }
}