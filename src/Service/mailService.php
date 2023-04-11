<?php

namespace App\Service;

use App\Repository\CompanyRepository;
use Doctrine\ORM\EntityManagerInterface;
use PHPMailer\PHPMailer\PHPMailer;

class mailService
{



    public function __construct(
        private readonly CompanyRepository $companyRepository,
        private readonly EntityManagerInterface $em
    ) {



    }

    public function email($filename){
        $mail = new PHPMailer();

        $mail->isSMTP();                                        //Send using SMTP
        $mail->Host       = 'smtp-relay.sendinblue.com';        //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                               //Enable SMTP authentication
        $mail->Username   = 'regitmailfacturatie@gmail.com';      //SMTP username
        $mail->Password   = 'xw3X8m5NLBsKtyOp';                 //SMTP password
        //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 587;
        //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->setFrom('regitmailfacturatie@gmail.com', 'Regit');
//        $doclink = 'http://127.0.0.1:8887/' . $filename . '.pdf';
//        dd($doclink);
        $doclink  = "../temp/Invoices/" . $filename .  '.pdf';
        //$targetEmail  = GetTargetEmail($companyID);
        $targetEmail = "stef@zogroep.nl";
        $subject  =  "Factuur";
        $body  = "Beste klant," . "\n" . "In de bijlage vind u de bijgeleverde factuur";
        //Recipients
        $mail->addAddress($targetEmail); //Add a recipient

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = strip_tags($body);
        //$mail->AddStringAttachment($doclink,$filename);
        $mail->addAttachment($doclink, $filename);

        return $mail->send();;
    }



    private function GetTargetEmail($companyID)
    {
        $company = $this->companyRepository->findOneBy(['id' => $companyID, 'Deleted' => false]);
//        return  $company->get
    }



}


