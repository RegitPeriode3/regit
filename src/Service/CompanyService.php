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
        private readonly CompanyRepository          $companyRepository,
        private readonly EntityManagerInterface     $em
    ){
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
                'address' => $company->getAddress(),
                'Inovices' => $this->GetCompanyInvoices($company)
            ];
        }
        return $allCompanies;
    }

    private function GetCompanyInvoices($company):array{
        //$company = $this->companyRepository->findOneBy(['id' => $companyId, 'Deleted' => 0]);
        $companyHourRegs = $company->getHourRegistrations();
        $invoices = [];

        foreach ($companyHourRegs as $companyHourReg){
            if(!is_null($companyHourReg->getInvoice())){
                $invoices[] = ['id' => $companyHourReg->getInvoice()->getId(), 'link' => $companyHourReg->getInvoice()->getDocLink(),
                    'invoiceNumber' => $companyHourReg->getInvoice()->getInvoiceNumber(), 'date' => $companyHourReg->getInvoice()->getDate()];
            }
        }
        return   $this->unique_multidim_array($invoices, 'id');
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

    private function unique_multidim_array($array, $key) {

        $temp_array = array();

        $i = 0;

        $key_array = array();



        foreach($array as $val) {

            if (!in_array($val[$key], $key_array)) {

                $key_array[$i] = $val[$key];

                $temp_array[$i] = $val;

            }

            $i++;

        }

        return $temp_array;

    }

//    public function getLastCompanydata(): array
//    {
//        $lastCompany = $this->companyRepository->findBy(array(), array('id' => 'DESC'), 1, 0);
//       //$lastCompany = $this->companyRepository->findBy(['Deleted' => false]);
//        $lastCompanyData = [];
//
//
//        $lastCompanyData[] = [
//            'id' => $lastCompany->getId(),
//            'name' => $lastCompany->getName(),
//            'phoneNr' => $lastCompany->getPhoneNr(),
//            'country' => $lastCompany->getCountry(),
//            'zipcode' => $lastCompany->getZipcode(),
//            'location' => $lastCompany->getLocation(),
//            'active' => $lastCompany->isActive(),
//            'invoiceAdress' => $lastCompany->getInvoiceAddress(),
//            'address' => $lastCompany->getAddress()
//        ];
//
//        return $lastCompanyData;
//    }
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