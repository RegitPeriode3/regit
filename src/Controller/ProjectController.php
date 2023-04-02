<?php

namespace App\Controller;

use App\Service\ProjectService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/project', name: 'app_project')]
class ProjectController extends AbstractController
{
    #[Route('/', name: 'getAllProjects', methods: ['GET'])]
    public function getAllProjects(ProjectService $projectService): Response
    {
        return $this->json($projectService->getAllProjectData());
    }

    #[Route('/createProject', name: 'createProject', methods: ['POST'])]
    public function createProject(ProjectService $projectService, Request $request): Response
    {
//        $parameters = json_decode($request->getContent(), true);
//        return $this->json($projectService->CreateCompany($parameters));
    }
}
