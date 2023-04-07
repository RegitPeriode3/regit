<?php

namespace App\Controller;

use App\Service\ProjectService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

#[Route('/project', name: 'app_project')]
class ProjectController extends AbstractController
{



    #[Route('/getproject', name: 'getProjectDataByCompany', methods: ['GET'])]
    public function getProjectByCompany(ProjectService $projectService, Request $request): Response
    {
        $parameters = $request->query->get('id');
        //$parameters = json_decode($request->getContent(), true);
        return $this->json($projectService->getProjectDataByCompany($parameters));
    }

    #[Route('/createProject', name: 'createProject', methods: ['post'])]
    public function createProject(ProjectService $projectService, Request $request): Response
    {

        $parameters = json_decode($request->getContent(), true);

        return $this->json($projectService->CreateProject($parameters));
    }

    #[Route('/updateProject', name: 'updateProject', methods: ['POST'])]
    public function updateProject(ProjectService $projectService, Request $request): Response
    {
        $parameters = json_decode($request->getContent(), true);
        return $this->json($projectService->updateProject($parameters));
    }

    #[Route('/deleteProject', name: 'deleteProject', methods: ['put'])]
    public function deleteProject(ProjectService $projectService, Request $request): Response
    {
        $parameters = json_decode($request->getContent(), true);
        return $this->json($projectService->deleteProject($parameters));
    }

//    #[Route('/lastProject', name: 'getLastProjectData', methods: ['GET'])]
//    public function getLastProjectData(ProjectService $ProjectService): Response
//    {
//        return $this->json($ProjectService->getLastProjectData());
//    }

    #[Route('/LoadLastProject', name: 'LoadLastProject', methods: ['GET'])]
    public function LoadProjectsByCompany(ProjectService $ProjectService, Request $request): Response
    {
        $parameters = $request->query->get('id');
        //$parameters = json_decode($request->getContent(), true);
        return $this->json($ProjectService->getLastProjectData($parameters));
    }
}
