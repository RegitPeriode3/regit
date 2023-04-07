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




    public function getProjectDataByCompany($parameters): array
    {
         $connection = $this->em->getConnection();
         $companyProject= $connection->executeQuery("SELECT project.id,project.name,project.description FROM `project` inner join company on  project.company_id = company.id where project.deleted = 0 and company_id = $parameters");
         $companyProject = $companyProject->fetchAll();

        return $companyProject;
    }

    public function CreateProject($parameters): Response
    {

        $companyID = $this->companyRepository->findOneBy(['id' => $parameters['companyID']]);

        $project = new Project();
        $project->setName($parameters['name']);
        $project->setDescription($parameters['description']);
        $project->setDeleted(False);
        $project->setCompany($companyID);
        $this->em->persist($project);
        $this->em->flush();
        return new Response('Nieuw project aangemaakt');
    }

    public function updateProject($parameters): string
    {

        $project = $this->projectRepository->findOneBy(['id' => $parameters['id']]);

        if (!empty($project)) {
            $project->setName($parameters['name']);
            $project->setDescription($parameters['description']);

            $this->em->persist($project);
            $this->em->flush();
            return new Response('project opgeslagen');
        }
        return 'Er is iets fout gegaan probeer opnieuw';
    }

    public function deleteProject($parameters): string
    {
        $project = $this->projectRepository->findOneBy(['id' => $parameters['id']]);

        if (!empty($project)) {
            $project->setDeleted(true);

            $this->em->persist($project);
            $this->em->flush();
            return new Response('Het project is verwijderd');
        }
        return 'Er is iets fout gegaan probeer opnieuw';
    }

    public function getLastProjectData($parameters): array
    {

        //$companyID = $this->companyRepository->findOneBy(['id' => $parameters]);

        $lastProject = $this->projectRepository->findBy(['id' => $parameters]);

        $connection = $this->em->getConnection();
        $companyProject= $connection->executeQuery("SELECT project.id,project.name,project.description FROM `project` inner join company on  project.company_id = company.id where project.deleted = 0 and company_id = $parameters ORDER BY project.id ASC");
        $companyProject = $companyProject->fetchAll();


//        $lastProjectData = [];
//
//        foreach ($lastProject as $project) {
//            $lastProjectData[] = [
//                'id' => $project->getId(),
//                'name' => $project->getName(),
//                'description' => $project->getDescription(),
//
//            ];
//
//        }
        return $companyProject;
    }



}