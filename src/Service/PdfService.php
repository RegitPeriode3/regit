<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Exception;
use App\Repository\InvoiceRepository;
use Mpdf\Mpdf;
use NumberFormatter;
use PhpParser\Node\Expr\Array_;
use Carbon\Carbon;


class PdfService
{
    public function __construct(
        private readonly InvoiceRepository $invoiceRepository,
        private readonly EntityManagerInterface $em
    ) {
    }

    public function GetPdf(): array
    {
        return [];
    }

    public function CreatePdf($ids, $invoiceNr)
    {
        //creates pdf and returns save location (doclink)
        $doclink = $this->CreateContent($this->GetInvoiceData($ids), $invoiceNr);

        //gets the invoice from which the pdf is created and sets the doclink for it
        $invoice = $this->invoiceRepository->findOneBy(["invoiceNumber" => $invoiceNr]);
        $invoice->setDocLink($doclink);
        $this->em->persist($invoice);
        $this->em->flush();
//        $this->FillContent();
    }

    public function SavePdf()
    {
        return 0;
    }

    private function getinvoicedata($ids): array
    {
        $test = implode(',', $ids['invoiceRowIds']);
        $connection = $this->em->getconnection();

        $invoicerowinfo = $connection->executequery(
            "select hr.*, us.display_name, ac.activity, ac.invoice_description, pr.name, pr.description
         from hour_registration hr
         inner join user us on hr.user_id = us.id
         inner join activity ac on hr.activity_id = ac.id
         left join project pr on hr.project_id = pr.id
         where hr.id in ($test) and hr.deleted = 0 and hr.add_to_invoice = 1"
         //where hr.id in ($test) and hr.deleted = 0 and hr.add_to_invoice = 1 and hr.invoice_id = $invoiceId"
        );

        $factdata['invoicerows'] = $invoicerowinfo->fetchallassociative();
        $companyinfo = $connection->executequery(
            "select * from company
         where id = " . $factdata['invoicerows'][0]['company_id'] . " and deleted = 0"
        );

        $factdata['invoicedata'] = $companyinfo->fetchallassociative();
        return $factdata;
    }

    private function CreateContent($Data, $invoiceNr)
    {
        $html = '';

        //css
        $html = "
            <head>
            <meta charset=\"utf-8\">
            </head>
              <style>
              body		{ color:#000;  font-family:\"Open Sans\", sans-serif; \"Times New Roman\", Georgia, Serif; font-size:12px; }
              div.ritOverzicht {margin-left: 40%}
              div.row {width:100%;}
              div.table	{ position:relative; float:left; left:20px; width:730px; }
                  table.bestelling { border:none!important; }
              </style>
              <body>";

        //adres naam en factuur adres
        $html .= "<div class=\"adres\"><h4>Factuuradres</h4></div>";
        $html .= "<div class=\"adres\">" . nl2br($Data['invoicedata'][0]['invoice_address']) . "</div>";

        //rit overzicht label en datum
        $html .= "<div class=\"Datum\">Factuurnummer: " . $invoiceNr . " </div><br>";
        $html .= "<div class=\"Datum\">Datum: " . date("d-m-Y") . "</div><br>";

        //overzicht tabel ()headers)
        $html .= "<div class=\"table\"><table class=\"bestelling\" border=\"0\" cellpadding=\"0px\" cellspacing=\"0px\" width=\"730\" float=\"right\">";
        $html .= "<tr>
            <td width=\"700\"><strong>Omschrijving</strong></td>
            <td width=\"30\"><strong>Bedrag</strong></td>
            </tr>";
        $html .= "<tr><td colspan=\"8\"><hr/></td></tr>";

        //vult de tabel met de nodige regels
        $tableInfo = $this->FillTable($Data);
        $html .= $tableInfo['html'];

        //eindbedragen onder de tabel
        $fmt = numfmt_create('nl_NL', NumberFormatter::CURRENCY);

        //$printPrice = numfmt_format_currency($fmt, $tableInfo['totExBtw'], "EUR");
        $printPrice = 0;
        $html .= "<tr><td colspan=\"8\"><hr/></td></tr>";
        $html .= "<tr><td colspan=\"4\"></td><td align=\"right\" colspan=\"2\"><strong>" . 'Totaal ex BTW: ' . "</strong></td><td width=\"50\" align=\"right\" colspan=\"2\"><strong>" . $printPrice . "</strong></td></tr>";
        $html .= "</table>";

        $html .= "</div>";
        $html .= "</body>";

        ob_start();

        $pdf = new mPDF([
            'margin_left' => 20,
            'margin_right' => 15,
            'margin_top' => 48,
            'margin_bottom' => 25,
            'margin_header' => 30,
            'margin_footer' => 10
        ]);

        $pdf->allow_charset_conversion = true;

        //achtegrond afbeelding instellen
        //$image = $_SERVER['DOCUMENT_ROOT'] . "/images/MaasregioBackground.jpg";
        //$pdf->SetDefaultBodyCSS('background', "url('$image')");
        //$pdf->SetDefaultBodyCSS('background-image-resize', 6);

        //html naar pdf omzetten
        $pdf->WriteHTML($html);

        //pad voor locale opslag
        $filename = "factuur-" . $invoiceNr;
        $savepath = "C:/wamp64/www/regit/temp/Invoices/". $filename . ".pdf";//path hardcoded needs change
        //$savepath = "../temp/Invoices";//path hardcoded needs change
        //$savepath = $_SERVER['DOCUMENT_ROOT'] . "/temp/Factuur/" . $filename . ".pdf";

        //schrijf de pdf naar de aangegeven locatie
        $pdf->Output($savepath, "F");
        ob_end_flush();

        return $savepath;
    }

    //vult de tabel met de ritten
    private function FillTable($Data)
    {
        $html = '';
        $totExBtw = 0;

        foreach ($Data['invoicerows'] as $invoiceRow) {
            $Price = ($invoiceRow['time'] * $invoiceRow['hourly_cost']);
            $totExBtw += $Price;

            $fmt = numfmt_create('nl_NL', NumberFormatter::CURRENCY);
            $Price = numfmt_format_currency($fmt, $Price, "EUR");
            //$data['BevestigdBedrag']= money_format("%.2n",$data['BevestigdBedrag']);

            $html .= "<tr>
              <td width=\"700\"> $invoiceRow[invoice_description] </td>
              <td width=\"30\" align='right'> $Price </td>
            </tr>";
        }

        $tableInfo = array("html" => "$html", "totExBtw" => "$totExBtw");
        return $tableInfo;
    }
}