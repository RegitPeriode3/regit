<?php

namespace App\Service;

use App\Repository\ClearenceRepository;
use App\Repository\UserRepository;

class UserService
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly ClearenceRepository $clearenceRepository
    ) {
    }

    public function GetAllUsersInfo(): array
    {
        $users = $this->userRepository->findAll();
        $allUsers = [];

        foreach ($users as $user) {
            $allUsers[] = [
                'id' => $user->getId(),
                'userName' => $user->getUserName()
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
                'userName' => $user->getUserName(),
                'country' => $user->getCountry()
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
}