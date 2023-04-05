<?php

namespace App\Controller;

use App\Service\SettingsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header("Location: http://localhost/regit/pages/login.php");
    exit;

} else {

    #[Route('/settings', name: 'app_settings')]
    class SettingsController extends AbstractController
    {
        
        #[Route('/Update', name: 'UpdateSettings', methods: ['PUT'])]
        public function UpdateSettings(SettingsService $SettingsService, Request $request): Response
        {
            $parameters = json_decode($request->getContent(), true);
            return $this->json($SettingsService->UpdateSettings($parameters));
        }

    }


    }
