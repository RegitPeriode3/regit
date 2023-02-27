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

    #[Route('/Create', name: 'CreateUser', methods: ['POST'])]
    public function CreateUser(UserService $userService, Request $request): Response
    {
        $displayName = $request->request->get('displayName');
        $UserName = $request->request->get('UserName');
        $password = $request->request->get('password');
        $email = $request->request->get('email');
        $phoneNr = $request->request->get('phoneNr');
        $country = $request->request->get('country');
        $location = $request->request->get('location');
        $zipcode = $request->request->get('zipcode');
        $address = $request->request->get('address');
        $active = $request->request->get('active');
        $deleted = $request->request->get('deleted');
        $clearence = $request->request->get('clearence');

        return $this->json($userService->CreateUser($displayName,$UserName,$password,$email, $phoneNr, $country, $location, $zipcode, $address, $active, $deleted, $clearence));
    }
}