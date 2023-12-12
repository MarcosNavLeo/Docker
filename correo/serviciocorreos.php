<?php
use PHPMailer\PHPMailer\PHPMailer;

require "vendor/autoload.php";

use GuzzleHttp\Client;

class serviciocorreos
{
    
    public function enviarCorreoConAdjunto($correo)
    {
        $client = new Client(); 
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->Username = "mnavleo2312@g.educaand.es";
        $mail->Password = "uwml cmga luyd htpf";
        $mail->SetFrom('mnavleo2312@g.educaand.es', 'Test');
        $mail->Subject = "Hola";
        $html_message = "Su cesta de navidad ha sido enviada";
        $mail->MsgHTML($html_message);
        $address = $correo;
        $mail->AddAddress($address, "Test");

        $pdfResponse = $client->request('GET', 'http://pdf/apipdf.php');
        $pdfContent = $pdfResponse->getBody();
        file_put_contents('archivo.pdf', $pdfContent);
        // Adjuntar el archivo
        $mail->addAttachment('archivo.pdf');

        // Enviar el correo
        $resul = $mail->Send();
        if (!$resul) {
            return "Error: " . $mail->ErrorInfo;
        } else {
            return "Enviado";
        }
    }
}
