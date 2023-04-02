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
        private readonly EmployeeRepository         $employeeRepository,
        private readonly UserRepository             $userRepository,
        private readonly CompanyRepository          $companyRepository,
        private readonly ActivityRepository         $activityRepository,
        private readonly ProjectRepository          $projectRepository,
        private readonly EntityManagerInterface     $em
    )
    {
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
        $company->setLocation($parameters['location']);
        $company->setInvoiceAddress($parameters['invoiceAddress']);
        $company->setAddress($parameters['address']);
        $company->setActive(True);
        $company->setDeleted(False);

        $this->em->persist($company);
        $this->em->flush();
        return new Response('Nieuwe klant opgeslagen');
    }

    public function UpdateCompany($parameters): string
    {
        $company = $this->companyRepository->findOneBy(['id' => $parameters['id']]);

        //$Clearance = $this->clearenceRepository->findOneBy(['id' => $parameters['clearence']]);
        // dd($user);
        if (!empty($company)) {
            $company->setName($parameters['name']);
            $company->setCountry($parameters['country']);
            $company->setActive($parameters['active']);
            $company->setPhoneNr($parameters['phoneNr']);
            $company->setZipcode($parameters['zipcode']);
            $company->setLocation($parameters['location']);
            $company->setAddress($parameters['address']);
            $company->setInvoiceAddress($parameters['invoiceAddress']);

            $this->em->persist($company);
            $this->em->flush();
            return new Response('klant opgeslagen');
        }
        return 'Er is iets fout gegaan probeer opnieuw';
    }

    public function deleteCompany($parameters): string
    {
        $company = $this->companyRepository->findOneBy(['id' => $parameters['id']]);
        //$Clearance = $this->clearenceRepository->findOneBy(['id' => $parameters['clearence']]);
        // dd($user);
        if (!empty($company)) {
            $company->setDeleted(true);

            $this->em->persist($company);
            $this->em->flush();
            return new Response('klant is verwijderd');
        }
        return 'Er is iets fout gegaan probeer opnieuw';
    }

    public function getLastCompanydata(): array
    {
        $lastCompany = $this->companyRepository->findBy(array(), array('id' => 'DESC'), 1, 0);
        $lastCompanyData = [];

        foreach ($lastCompany as $company) {
            $lastCompanyData[] = [
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
        return $lastCompanyData;
    }




}