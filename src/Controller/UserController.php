<?php

namespace App\Controller;

use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header("Location: http://localhost/regit/pages/login.php");
    exit;
}
else {

    #[Route('/GetSingleUser/{id}/{active}', name: 'GetUserInfo', methods: ['GET'])]
    public function GetUserInfo($id, UserService $userService, $active = false): Response
    {
        #[Route('/', name: 'GetAllUsersInfo', methods: ['GET'])]
        public function GetAllUsersInfo(UserService $userService): Response
        {
            return $this->json($userService->GetAllUsersInfo());
        }

        #[Route('/GetSingleUser/{id}/{active}', name: 'GetUserInfo', methods: ['GET'])]
        public function GetUserInfo($id, UserService $userService, $active = true): Response
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
            $parameters = json_decode($request->getContent(), true);
            return $this->json($userService->CreateUser($parameters));
            //return $this->json($userService->CreateUser($displayName,$UserName,$password,$email, $phoneNr, $country, $location, $zipcode, $address, $active, $deleted, $clearence));
        }


    #[Route('/Create', name: 'CreateUser', methods: ['POST'])]
    public function CreateUser(UserService $userService, Request $request): Response
    {
        $parameters = json_decode($request->getContent(), true);
        return $this->json($userService->CreateUser($parameters));
    }



    #[Route('/Update', name: 'UpdateUser', methods: ['PUT'])]
    public function UpdateUser(UserService $userService, Request $request): Response
    {
        $parameters = json_decode($request->getContent(), true);
        return $this->json($userService->UpdateUser($parameters));
    }


    #[Route('/Delete', name: 'DeleteUser', methods: ['PUT'])]
    public function DeleteUser(UserService $userService, Request $request): Response
    {
        $parameters = json_decode($request->getContent(), true);
        return $this->json($userService->DeleteUser($parameters));
    }
}
