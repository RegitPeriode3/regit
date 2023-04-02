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
use Symfony\Component\HttpFoundation\Response;

class ProjectService
{
    public function __construct(
        private readonly HourRegistrationRepository $hourRegistrationRepository,
        private readonly EmployeeRepository         $employeeRepository,
        private readonly UserRepository             $userRepository,
        private readonly CompanyRepository          $companyRepository,
        private readonly ActivityRepository         $activityRepository,
        private readonly ProjectRepository          $projectRepository,
        private readonly EntityManagerInterface     $em
    )
    {
    }

    public function getAllProjectData(): array
    {

        $projectData = $this->projectRepository->findBy(['Deleted' => false]);
        $allProjects = [];

        foreach ($projectData as $project) {

            $allProjects[] = [
                'id' => $project->getId(),
                'name' => $project->getName(),
                'description' => $project->getDescription(),

            ];
        }
        return $allProjects;
    }



}