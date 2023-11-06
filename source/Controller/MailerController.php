<?php

namespace Controller;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

abstract class MailerController extends PHPMailer
{
    public static function SetSTMP() : void{
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail = new \PHPMailer\PHPMailer\PHPMailer();
            $mail->IsSMTP(); // enable SMTP
            $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
            $mail->SMTPAuth = true; // authentication enabled
            $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
            $mail->Host = "tls://smtp.gmail.com";
            $mail->Port = 587; // or 587
            $mail->IsHTML(true);
            $mail->Username = "tester.devprojects@gmail.com";
            $mail->Password = "qemcew-rysbop-1Waxmu";
            $mail->SetFrom("tester-devprojects@gmail.com");
            $mail->Subject = "Application for Programmer Registration";
            $mail->Body = 'coucou';
            $mail->AddAddress("nz.projekts.dev@gmail.com", "HR");

            if (!$mail->Send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            } else {
                echo "Message has been sent";
            }
        } catch(Exception $e){
            echo $e;        
        }
    }
}