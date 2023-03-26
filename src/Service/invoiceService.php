<?php

namespace App\Service;

use App\Entity\HourRegistration;
use App\Repository\CompanyRepository;
use App\Repository\HourRegistrationRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class invoiceService
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly CompanyRepository $companyRepository,
        private readonly HourRegistrationRepository $hourRegistrationRepository,
        private readonly EntityManagerInterface $em
    ){
    }

    public function SetCompaniesInvoice($id):array
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

    public function GetCompanyInvoiceRows($companyId):array
    {
        $company = $this->companyRepository->findOneBy(['id' => $companyId, 'Active' => true, 'Deleted' => false]);
        $invoiceRows = $company->getHourRegistrations();
        $companyInvoiceRows = [];

        foreach ($invoiceRows as $invoiceRow){
            if(!$invoiceRow->isDeleted() && empty($invoiceRow->getInvoice())){

                if(!empty($invoiceRow->getProject())){
                    $projectName = $invoiceRow->getProject()->getName();
                    $projectId = $invoiceRow->getProject()->getId();
                }else{
                    $projectName = "";
                    $projectId = 0;
                }

                $companyInvoiceRows[] = [
                    "hourRegId" => $invoiceRow->getId(),
                    "activityId" => $invoiceRow->getActivity()->getId(),
                    "activityName" => $invoiceRow->getActivity()->getActivity(),
                    "HourlyCost" => $invoiceRow->getHourlyCost(),
                    "date" => $invoiceRow->getDate()->format('Y-m-d'),
                    "description" => $invoiceRow->getDescription(),
                    "hourlyCost" => $invoiceRow->getHourlyCost(),
                    "companyId" => $invoiceRow->getCompany()->getId(),
                    "userId" => $invoiceRow->getUser()->getId(),
                    "Time" => $invoiceRow->getTime(),
                    "projectName" => $projectName,
                    "projectId" => $projectId,
                    "factureren" => $invoiceRow->isAddToInvoice()
                ];
            }
        }
        return $companyInvoiceRows;
    }

    public function toggleFactureren($rowID, $bool):string{
        //dd($rowID);
        $invoiceRow = $this->hourRegistrationRepository->findOneBy(['id' => $rowID, 'Deleted' => false]);
        //dd($invoiceRow);
        $invoiceRow->setAddToInvoice($bool);
        $this->em->persist($invoiceRow);
        $this->em->flush();
        return "row is geupdate";
    }
}