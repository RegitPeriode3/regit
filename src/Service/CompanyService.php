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

class CompanyService
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

    public function GetAllCompanyInfo(): array
    {
        $companies = $this->companyRepository->findBy(['Deleted' => false]);
        $allCompanies = [];

        foreach ($companies as $company) {

            $allCompanies[] = [
                'id' => $company->getId(),
                'name' => $company->getName(),
                'phoneNr' => $company->getPhoneNr(),
                'country' => $company->getCountry(),
                'zipcode' => $company->getZipcode(),
                'location' => $company->getLocation(),
                'active' => $company->isActive(),
                'invoiceAdress' => $company->getInvoiceAddress(),
                'address' => $company->getAddress()
            ];
        }
        return $allCompanies;
    }


        public function CreateCompany($parameters)
        {

            $company = new Company();
            $company->setName($parameters['name']);
            $company->setPhoneNr($parameters['phoneNr']);
            $company->setCountry($parameters['country']);
            $company->setZipcode($parameters['zipcode']);
            $company->getLocation($parameters['location']);
            $company->getInvoiceAddress($parameters['invoiceAddress']);
            $company->setAddress($parameters['address']);
            $company->setActive(True);
            $company->setDeleted(False);
    
            $this->em->persist($company);
            $this->em->flush();
            return new Response('Nieuwe klant opgeslagen');
        }


}