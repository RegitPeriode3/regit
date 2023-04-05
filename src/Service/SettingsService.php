<?php

namespace App\Service;

use App\Entity\Configuration;
use App\Entity\Activity;
use App\Repository\ConfigurationRepository;
use App\Repository\ActivityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\True_;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;

class SettingsService
{
    public function __construct(
        private readonly ActivityRepository $ActivityRepository,
        private readonly ConfigurationRepository $ConfigurationRepository,
        private readonly EntityManagerInterface $em
    ) {
    }

    public function GetSettingsInfo(): array
    {
        $settings = $this->ConfigurationRepository->findOneBy(['id' => 1]);
        if (!empty($settings)) {
            return [
                'SettingsName' => $settings->getNameSender(),
                'SettingsEmail' => $settings->getEmailSender(),
                'SettingsServer' => $settings->getSmtpServer(),
                'SettingsPort' => $settings->getSmtpPort(),
                'SettingsUserName' => $settings->getUserName(),
                'SettingsPassword' => $settings->getPassword()
            ];
        }
        return [];
    }

    public function UpdateSettings($parameters): string
    {
        $settings = $this->ConfigurationRepository->findOneBy(['id' => $parameters['id']]);
        if (!empty($settings)) {

            $settings->setNameSender($parameters['Name']);
            $settings->setEmailSender($parameters['Email']);
            $settings->setSmtpServer($parameters['Server']);
            $settings->setSmtpPort($parameters['Port']);
            $settings->setUserName($parameters['UserName']);
            $settings->setPassword($parameters['Password']);

            $this->em->persist($settings);
            $this->em->flush();
            return new Response('settings zijn aangepast');
        }
        return 'Er is iets fout gegaan probeer opnieuw';
    }


    //activity

    public function GetActivities(): array
    {
        $activities = $this->ActivityRepository->findBy(['Deleted' => false]);
        $allActivity = [];

        foreach ($activities as $activity) {
            $allActivity[] = [
                'id' => $activity->getId(),
                'activityName' => $activity->getActivity(),
                'activityDescr' => $activity->getInvoiceDescription(),
            ];
        }
        return $allActivity;
    }

    public function CreateActivity($parameters)
    {
        $activity = new Activity();
        $activity->setActivity($parameters['activityName']);
        $activity->setInvoiceDescription($parameters['activityDescr']);
        $activity->setDeleted(False);

        $this->em->persist($activity);
        $this->em->flush();
        return new Response('Nieuwe activiteit opgeslagen');
    }

}
