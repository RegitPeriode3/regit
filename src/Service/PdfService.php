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

        //factuur adres
        $html .= "<div class=\"adres\" style='margin-top: 13%'>" . nl2br($Data['invoicedata'][0]['invoice_address']) . "</div>";

        //datum, verval datum en factuurnummer
        $html .= "<div style='margin-left: 65%; margin-top: -8%'>";
        $html .= "<div class=\"Datum\">Factuurdatum: " . date("d-m-Y") . "</div>";
        $html .= "<div class=\"Datum\">Vervaldatum: " . date('d-m-Y', strtotime(date('d-m-Y'). ' + 14 days')) . "</div><br>";
        $html .= "<div class=\"Datum\">Factuurnummer: " . sprintf("%08d", $invoiceNr) . " </div><br>";
        $html .= "</div>";

        $html .= "<div style='margin-top: 5%'><b>Factuur</b></div><br><br>";

        //overzicht tabel headers
        $html .= "<div class=\"table\"><table class=\"bestelling\" border=\"0\" cellpadding=\"0px\" cellspacing=\"0px\" width=\"730\" float=\"right\">";
        $html .= "<tr>
            <td width=\"100\"><strong>Activiteit</strong></td>
            <td width=\"100\"><strong>Datum</strong></td>
            <td width=\"100\"><strong>Medewerker</strong></td>
            <td width=\"160\"><strong>Omschrijving</strong></td>
            <td width=\"70\"><strong>Aantal</strong></td>
            <td width=\"70\"><strong>Bedrag</strong></td>
            <td width=\"100\" align='right'><strong>Totaal Bedrag Excl. Btw</strong></td>
            </tr>";
        $html .= "<tr><td colspan=\"8\"><hr/></td></tr>";

        //vult de tabel met de nodige regels
        $tableInfo = $this->FillTable($Data);
        $html .= $tableInfo['html'];

        //eindbedragen onder de tabel
        $fmt = numfmt_create('nl_NL', NumberFormatter::CURRENCY);

        //zet de prijs om naar een fijne format voor euros
        $PriceExVAT = numfmt_format_currency($fmt, $tableInfo['totExBtw'], "EUR");

        //bepaal en conver de prijs incl btw
        $PriceInclVAt = floatval($tableInfo['totExBtw']) * 1.21;
        $PriceInclVAt = numfmt_format_currency($fmt, $PriceInclVAt, "EUR");

        //bepaal en conert btw prijs
        $VatPrice = floatval($tableInfo['totExBtw']) * 0.21;
        $VatPrice = numfmt_format_currency($fmt, $VatPrice, "EUR");

        $html .= "<tr><td colspan=\"8\"><hr/></td></tr>";
        $html .= "<tr><td colspan=\"4\"></td><td align=\"right\" colspan=\"2\"><strong>" . 'Totaal ex BTW: ' . "</strong></td><td width=\"50\" align=\"right\" colspan=\"2\"><strong>" . $PriceExVAT . "</strong></td></tr>";
        $html .= "<tr><td colspan=\"4\"></td><td align=\"right\" colspan=\"2\"><strong>" . 'BTW Bedrag: ' . "</strong></td><td width=\"50\" align=\"right\" colspan=\"2\"><strong>" . $VatPrice . "</strong></td></tr>";
        $html .= "<tr><td colspan=\"4\"></td><td align=\"right\" colspan=\"2\"><strong>" . 'Totaal incl. BTW: ' . "</strong></td><td width=\"50\" align=\"right\" colspan=\"2\"><strong>" . $PriceInclVAt . "</strong></td></tr>";
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
        $image = "C:/wamp64/www/regit/assets/img/CoppenInvoiceBackground.png";
        $pdf->SetDefaultBodyCSS('background', "url('$image')");
        $pdf->SetDefaultBodyCSS('background-image-resize', 6);

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


//            <td width=\"100\"><strong>Activiteit</strong></td>
//            <td width=\"100\"><strong>Datum</strong></td>
//            <td width=\"100\"><strong>Medewerker</strong></td>
//            <td width=\"100\"><strong>Omschrijving</strong></td>
//            <td width=\"100\"><strong>Aantal</strong></td>
//            <td width=\"30\"><strong>Bedrag</strong></td>
//            <td width=\"100\"><strong>Totaal Bedrag Excl. Btw</strong></td>
            //hr.*, us.display_name, ac.activity, ac.invoice_description, pr.name, pr.description
            //dd($invoiceRow);

            $html .= "<tr>
              <td width=\"100\"> $invoiceRow[activity] </td>
              <td width=\"100\">$invoiceRow[date]</td>
              <td width=\"100\">$invoiceRow[display_name]</td>
              <td width=\"160\">$invoiceRow[invoice_description]</td>
              <td width=\"70\">$invoiceRow[time]</td>
              <td width=\"70\">$invoiceRow[hourly_cost]</td>
              <td width=\"30\" align='right'> $Price </td>
            </tr>";
        }

        $tableInfo = array("html" => "$html", "totExBtw" => "$totExBtw");
        return $tableInfo;
    }
}