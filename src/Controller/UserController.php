<?php

namespace App\Controller;

use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user', name: 'app_user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'GetAllUsersInfo', methods: ['GET'])]
    public function GetAllUsersInfo(UserService $userService): Response
    {
        return $this->json($userService->GetAllUsersInfo());
    }

    #[Route('/GetSingleUser/{id}/{active}', name: 'GetUserInfo', methods: ['GET'])]
    public function GetUserInfo($id, UserService $userService, $active=true): Response
    {
        return $this->json($userService->GetUserInfo($id, $active));
    }

    #[Route('/Clearence/{role}', name: 'GetAdmins', methods: ['GET'])]
    public function GetAdmins($role, UserService $userService): Response
    {
        return $this->json($userService->GetAdmins($role));
    }
}
