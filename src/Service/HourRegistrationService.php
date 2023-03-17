<?php

namespace App\Service;

use App\Entity\Company;
use App\Entity\Employee;
use App\Entity\Project;
use App\Repository\ActivityRepository;
use App\Repository\CompanyRepository;
use App\Repository\EmployeeRepository;
use App\Repository\HourRegistrationRepository;
use App\Repository\ProjectRepository;
use App\Repository\UserRepository;
use Carbon\Carbon;
use Doctrine\ORM\EntityManagerInterface;

class HourRegistrationService
{
    public function __construct(
        private readonly HourRegistrationRepository $hourRegistrationRepository,
        private readonly EmployeeRepository $employeeRepository,
        private readonly UserRepository $userRepository,
        private readonly CompanyRepository $companyRepository,
        private readonly ActivityRepository $activityRepository,
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
}