<?php

namespace App\Service;

use App\Repository\ClearenceRepository;
use App\Repository\UserRepository;
use http\Env\Response;
use Symfony\Bridge\Doctrine\ManagerRegistry;

class UserService
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly ClearenceRepository $clearenceRepository,
        private readonly ManagerRegistry $doctrine
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

    public function CreateUser($displayName, $UserName, $password, $email, $phoneNr, $country, $location, $zipcode, $address, $active, $deleted,$clearence): Response
    {
        $entityManager = $this->doctrine->getManager();
        $user = new User();

        $user->setDisplayName($displayName);
        $user->setUserName($UserName);
        $user->setPassword($password);
        $user->setEmail($email);
        $user->setPhoneNr($phoneNr);
        $user->setCountry($country);
        $user->setLocation($location);
        $user->setZipcode($zipcode);
        $user->setAddress($address);
        $user->setActive($active);
        $user->setDeleted($deleted);
        $user->setClearence($clearence);

        $entityManager->persist($user);
        $entityManager->flush();
        return new Response('Nieuwe Gerbruiker opgeslagen');
    }
}