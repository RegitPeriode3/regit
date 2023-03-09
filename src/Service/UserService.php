<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\ClearenceRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\True_;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;

class UserService
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly ClearenceRepository $clearenceRepository,
        private readonly EntityManagerInterface $em
    ) {
    }

    public function GetAllUsersInfo(): array
    {
        $users = $this->userRepository->findAll();
        $allUsers = [];

        foreach ($users as $user) {
            $allUsers[] = [
                'id' => $user->getId(),
                'displayName' => $user->getDisplayName(),
                'userName' => $user->getUserName(),
                'password' => $user->getPassword(),
                'email' => $user->getEmail(),
                'phoneNr' => $user->getPhoneNr(),
                'country' => $user->getCountry(),
                'location' => $user->getLocation(),
                'zipcode' => $user->getZipcode(),
                'address' => $user->getAddress()
            ];
        }
        return $allUsers;
    }

    public function GetUserInfo($id, $active): array
    {
        $user = $this->userRepository->findOneBy(['id' => $id, 'Active' => $active, 'Deleted' => false]);
        if (!empty($user)) {
            return [
                'id' => $user->getId(),
                'displayName' => $user->getDisplayName(),
                'userName' => $user->getUserName(),
                'password' => $user->getPassword(),
                'email' => $user->getEmail(),
                'phoneNr' => $user->getPhoneNr(),
                'country' => $user->getCountry(),
                'location' => $user->getLocation(),
                'zipcode' => $user->getZipcode(),
                'address' => $user->getAddress()
            ];
        }
        return [];
    }

    public function GetAdmins($role): array
    {
        $admins = $this->clearenceRepository->findOneBy(['Role'=>$role])->getUsers();
        $allAdmins = [];
        foreach ($admins as $user) {
            $allAdmins[] = [
                'id' => $user->getId(),
                'userName' => $user->getUserName()
            ];
        }
        return $allAdmins;
    }

    //public function CreateUser($displayName, $UserName, $password, $email, $phoneNr, $country, $location, $zipcode, $address, $active, $deleted,$clearence): Response
    public function  CreateUser($parameters)
    {
        $Clearance = $this->clearenceRepository->findOneBy(['id'=>$parameters['clearence']]);
        $user = new User();

        $parameters['EmployeeId'] = 1;
        $user->setDisplayName($parameters['displayName']);
        $user->setUserName($parameters['UserName']);
        $user->setPassword($parameters['password']);
        $user->setEmployeeID($parameters['EmployeeId']);
        $user->setEmail($parameters['email']);
        $user->setPhoneNr($parameters['phoneNr']);
        $user->setCountry($parameters['country']);
        //$user->setLocation($parameters['location']);
        $user->setZipcode($parameters['zipcode']);
        $user->setAddress($parameters['address']);
        $user->setActive(True);
        $user->setDeleted(False);
        $user->setClearence($Clearance);

        $this->em->persist($user);
        $this->em->flush();
        return new Response('Nieuwe Gerbruiker opgeslagen');
    }
}