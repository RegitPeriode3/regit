<?php

namespace App\Service;

use App\Entity\HourRegistration;
use App\Repository\ActivityRepository;
use App\Repository\CompanyRepository;
use App\Repository\HourRegistrationRepository;
use App\Repository\ProjectRepository;
use App\Repository\UserRepository;
use Carbon\Carbon;
use Doctrine\ORM\EntityManagerInterface;
if(session_status() === PHP_SESSION_NONE) session_start();
class HourRegistrationService
{
    public function __construct(
        private readonly HourRegistrationRepository $hourRegistrationRepository,
        private readonly UserRepository $userRepository,
        private readonly CompanyRepository $companyRepository,
        private readonly ActivityRepository $activityRepository,
        private readonly ProjectRepository $projectRepository,
        private readonly EntityManagerInterface $em
    ) {
    }

    public  function calcHours($from, $till){
        //kijkt of de ingevoerde waardes leeg zijn
        if(!empty($from) && !empty($till)){
            $from = Carbon::parse($from);//convert string naar carbon datetime
            $till = Carbon::parse($till);
            $totalDuration = $till->diff($from)->format('%h.%I'); //rekent tijdverschil uit
            return $totalDuration;
        }else{
            return 0;
        }
    }

    //haalt de companies op waar een user aan gekoppeld is
    public function GetCompanyPerUser():array
    {

        $id = $_SESSION['id'];
        $user = $this->userRepository->findOneBy(['id' => $id, 'Active' => true, 'Deleted' => false]);//haalt de user op
        $userEmployees = $user->getEmployees();//haalt alle employees op van deze user
        $userCompanies = [];
        foreach ($userEmployees as $userEmployee) {
            if(!$userEmployee->isDeleted()){//kijkt of de employee op verwijderd staat
                $currentUserEmployee = $userEmployee->getCompany();//maakt current company object
                //vult array met company info
                $userCompanies[] = [
                    "companyId" => $currentUserEmployee->getId(),
                    "companyName" => $currentUserEmployee->getName()
                ];
            }
        }
        return $userCompanies;
    }

    //haalt de Project op van deze companies
    public function GetProjectPerCompany($id):array
    {
        $company = $this->companyRepository->findOneBy(['id' => $id, 'Deleted' => false]);//haalt de company op
dd($company);
        $companyProjects = $company->getProjects();
        $project = [];
        foreach ($companyProjects as $companyProject){
            //vult array met company info
            if(!$companyProject->isDeleted()){
                $project[] = ["projectId" => $companyProject->getId(),
                    "projectName"=> $companyProject->getName()
                ] ;
            }
        }
        return $project;
    }

    //haalt de activiteiten op
    public function GetActivities():array
    {
        $activityList = $this->activityRepository->findAll();
        //$company = $this->companyRepository->findOneBy(['id' => $id, 'Deleted' => false]);//haalt de company op

        //$companyProjects = $company->getProjects();
        $activity = [];
        foreach ($activityList as $currentActivity){
            //vult array met company info
            if(!$currentActivity->isDeleted()){

                $activity[] = ["activityId" => $currentActivity->getId(),
                    "activityName"=> $currentActivity->getActivity()
                ] ;
            }
        }
        return $activity;
    }

    public function RegisterHour($parameters): string
    {
        //haalt project op van de geselecteerde id anders zet var naar null
        if (!empty($parameters['Project'])){
            $project = $this->projectRepository->findOneBy(['id'=>$parameters['Project']]);
        }else{
            $project = null;
        }

        $hourReg = new HourRegistration();

        $Date = Carbon::parse($parameters['Date']);
        if (empty($parameters['hoursWorked'])){
            return 'Er zijn geen uren ingevuld';
        }

        $activity = $this->activityRepository->findOneBy(['id'=>$parameters['Activity']]);
        $user = $this->userRepository->findOneBy(['id'=>$_SESSION['id']]);
        $company = $this->companyRepository->findOneBy(['id'=>$parameters['Company']]);

        //Deze check is in principe niet nodig omdat dit niet mogenlijk zou moeten zijn,
        //maar voor de zekerheid wordt die uitgevoerd.
        if(empty($user) || empty($company)){
            return 'er is iets misgegaan, probeer opnieuw';
        }

        $hourReg->setActivity($activity);
        $hourReg->setDeleted(false);
        $hourReg->setHourlyCost('3');
        $hourReg->setTime($parameters['hoursWorked']);
        $hourReg->setDescription($parameters['Description']);
        $hourReg->setDate($Date);
        $hourReg->setUser($user);
        $hourReg->setCompany($company);
        $hourReg->setProject($project);

        $this->em->persist($hourReg);
        $this->em->flush();
        return 'Uren zijn succesvol geregistreerd.';
    }

    public function getInvoiceRows(){
        $invoiceRowsList = $this->hourRegistrationRepository->findAll();

        $invoiceRows = [];
        foreach ($invoiceRowsList as $currentInvoiceRow){
            //zorgt ervoor dat als project leeg is er geen error komt
            if(!empty($currentInvoiceRow->getProject())){
                $project = $currentInvoiceRow->getProject()->getName();
            }else{
                $project = '';
            }

            //zorgt ervoor dat InvoiceNr niet errort als die niet bestaat
            if(!empty($currentInvoiceRow->getInvoice())){
                $invoiceNr = $currentInvoiceRow->getInvoice()->getInvoiceNumber();
            }else{
                $invoiceNr = '';
            }

            if(!$currentInvoiceRow->isDeleted() && $currentInvoiceRow->getUser()->getId() == $_SESSION['id'] && empty($invoiceNr)){

                $invoiceRows[] = [
                    "Id" => $currentInvoiceRow->getId(),
                    "InvoiceNr" => $invoiceNr,
                    "Date" => $currentInvoiceRow->getDate()->format('Y-m-d'),
                    "HoursWorked" => $currentInvoiceRow->getTime(),
                    "Project" => $project,
                    "Activity" => $currentInvoiceRow->getActivity()->getActivity(),
                    "Description" => $currentInvoiceRow->getDescription()
                ] ;
            }
        }
        return $invoiceRows;
    }

    public function DeleteHourReg($parameters){
        $hourReg = $this->hourRegistrationRepository->findOneBy(['id'=>$parameters['Id']]);
        $hourReg->setDeleted(true);
        $this->em->persist($hourReg);
        $this->em->flush();
        return 'Row deleted';
    }
}