<?php

namespace App\Service;

use App\Repository\InvoiceRepository;
use PhpParser\Node\Expr\Array_;

class PdfService
{
    public function __construct(
        private readonly InvoiceRepository $invoiceRepository
    ) {
    }

    public function GetPdf(): array
    {
        return [];
    }

    public function CreatePdf()
    {
        $this->CreateContent($this->GetInvoiceData());
//        $this->FillContent();
    }

    private function GetInvoiceData()
    {
        return 0;
    }

    private function CreateContent($Data)
    {
        return 0;
    }

//    private function FillContent(){
//
//    }

    public function SavePdf()
    {
        return 0;
    }
}