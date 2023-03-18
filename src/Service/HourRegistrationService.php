<?php

namespace App\Service;

use App\Entity\Company;
use App\Entity\Employee;
use App\Entity\HourRegistration;
use App\Entity\Project;
use App\Repository\ActivityRepository;
use App\Repository\CompanyRepository;
use App\Repository\EmployeeRepository;
use App\Repository\HourRegistrationRepository;
use App\Repository\ProjectRepository;
use App\Repository\UserRepository;
use Carbon\Carbon;
use Doctrine\ORM\EntityManagerInterface;
use http\Env\Response;
use phpDocumentor\Reflection\Types\Boolean;

class HourRegistrationService
{
    public function __construct(
        private readonly HourRegistrationRepository $hourRegistrationRepository,
        private readonly EmployeeRepository $employeeRepository,
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
            $totalDuration = $till->diff($from)->format('%h:%I'); //rekent tijdverschil uit
            return $totalDuration;
        }else{
            return 0;
        }
    }

    //haalt de companies op waar een user aan gekoppeld is
    public function GetCompanyPerUser($id):array
    {
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

    public function RegisterHour($parameters):Response
    {
        //haalt project op van de geselecteerde id anders zet var naar null
        if (!empty($parameters['Project'])){
            $project = $this->projectRepository->findOneBy(['id'=>$parameters['Project']]);
        }else{
            $project = null;
        }

//        //haalt $employee op van de geselecteerde id anders zet var naar null
//        if (!empty($parameters['Company'])){
//            $employee =
//        }else{
//            $employee = null;
//        }

        //temp hardcode
        $employee = $this->projectRepository->findOneBy(['id'=>1]);

        //haalt activity op en maakt nieuwe hourregistration object aan
        $activity = $this->activityRepository->findOneBy(['id'=>$parameters['Activity']]);
        $hourReg = new HourRegistration();

        $hourReg->setTime($parameters['hoursWorked']);
        $hourReg->setActivity($activity);
        $hourReg->setDescription($parameters['Description']);
        $hourReg->setDeleted(false);
        $hourReg->setHourlyCost('3');
        dd($employee);
        $hourReg->setEmployee($employee);
        $hourReg->setDate($parameters['Date']);
        //$hourReg->setProject($project);



        $this->em->persist($hourReg);
        $this->em->flush();
        return new Response('Uren zijn succesvol geregistreerd.');
    }
}

//            Date: $('#hourRegDate').val(),
//            hoursWorked: $('#hoursAmt').text(),
//            Company: $('#hourRegCompanies').val(),
//            Project: $('#hourRegProjects').val(),
//            Activity: $('#hourRegActivity').val(),
//            Description: $('#hourDescription').text(),