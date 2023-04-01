<?php

namespace App\Service;

use App\Entity\HourRegistration;
use App\Entity\Invoice;
use App\Repository\CompanyRepository;
use App\Repository\HourRegistrationRepository;
use App\Repository\InvoiceRepository;
use App\Repository\UserRepository;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use Carbon\Carbon;

class invoiceService
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly CompanyRepository $companyRepository,
        private readonly HourRegistrationRepository $hourRegistrationRepository,
        private readonly InvoiceRepository $invoiceRepository,
        private readonly HourRegistrationService $hourRegistrationService,
        private readonly EntityManagerInterface $em
    ){
    }

    public function SetCompaniesInvoice():array
    {
        $id = $_SESSION['id'];
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

    public function GetCompanyInvoiceRows(int $companyId):array
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

        $invoiceRow = $this->hourRegistrationRepository->findOneBy(['id' => $rowID, 'Deleted' => false]);
        $invoiceRow->setAddToInvoice($bool);
        $this->em->persist($invoiceRow);
        $this->em->flush();
        return "row is geupdate";
    }


    public function createInvoice($ids):array{
        $invoice = new Invoice();

        //get max fact nr +1 als nieuwe factnr
        $connection = $this->em->getConnection();
        $invoiceNr = $connection->executeQuery("SELECT MAX(invoice_number)+1 FROM invoice");
        $invoiceNr = $invoiceNr->fetchOne();

        //set values for new invoice
        $invoice->setInvoiceNumber($invoiceNr);
        $invoice->setBTW(21);
        $invoice->setDate(Carbon::parse(date("Y-m-d")));
        $invoice->setDeleted(0);

        $this->em->persist($invoice);
        $this->em->flush();

        //returns id of invoice just created
        $invoiceId = $invoice->getId();

        //sets the new invoice id to the corresponding invoice rows
        return  $this->AssignInvoiceRows($ids, $invoiceId);
        //return '';
    }

    private function AssignInvoiceRows($ids, $invoiceId):array{
        //turns the array into a string seperated by ,
        $idString = implode(',', $ids['invoiceRowIds']);

        //updates the invoice rows with the invoice id
        $connection = $this->em->getConnection();
        $connection->executeQuery("UPDATE hour_registration SET invoice_id = " . $invoiceId . " WHERE id IN ($idString) AND deleted = 0 AND add_to_Invoice = 1 AND invoice_id IS NULL");

        //$idList = $connection->executeQuery("SELECT company_id FROM hour_registration WHERE id");
        $companyId = $this->hourRegistrationRepository->findOneBy(["id" => $ids['invoiceRowIds'][0]])->getCompany()->getId();
        //$companyId = $singleInvoiceRow->getCompany()->getId();

        return $this->GetCompanyInvoiceRows($companyId);
    }
}