<?php

namespace App\Service;

use App\Entity\Configuration;
use App\Repository\ConfigurationRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\True_;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;

class SettingsService
{
    public function __construct(
        private readonly ConfigurationRepository $ConfigurationRepository,
        private readonly EntityManagerInterface $em
    ) {
    }

    public function GetSettingsInfo($id): array
    {
        $settings = $this->ConfigurationRepository->findOneBy(['id' => $id]);
        if (!empty($settings)) {

            return [
                'userName' => $settings->getUserName(),
                'password' => $settings->getPassword(),
            ];
        }
        return [];
    }

    public function UpdateSettings($parameters): string
    {
        $settings = $this->ConfigurationRepository->findOneBy(['id' => $parameters['id']]);
       
        if (!empty($settings)) {
            $settings->setUserName($parameters['UserName']);
            $settings->setPassword($parameters['Password']);

            $this->em->persist($settings);
            $this->em->flush();
            return new Response('settings zijn aangepast');
        }
        return 'Er is iets fout gegaan probeer opnieuw';
    }


}
