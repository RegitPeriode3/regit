<?php

namespace App\Controller;

use App\Service\HourRegistrationService;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/hourRegistration', name: 'app_hour_registration')]
class HourRegistrationController extends AbstractController
{
    #[Route('/calcHours/{from}/{till}', name: 'calcHours', methods: ['GET'])]
    public function calcHours($from, $till, HourRegistrationService $hourRegistrationService): Response
    {
        return $this->json($hourRegistrationService->calcHours($from, $till));
    }

    #[Route('/GetCompanyPerUser/{userId}', name: 'GetCompanyPerUser', methods: ['GET'])]
    public function GetCompanyPerUser($userId, HourRegistrationService $hourRegistrationService): Response
    {
        return $this->json($hourRegistrationService->GetCompanyPerUser($userId));
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
        $parameters = json_decode($request->getContent(), true);
        return $this->json($hourRegistrationService->RegisterHour($parameters));
    }
}
