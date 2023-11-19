<?php
require_once(APPPATH.'libraries/PHPMailer/src/PHPMailer.php');
require_once(APPPATH.'libraries/PHPMailer/src/SMTP.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
class EmailModel extends CI_Model{
    public function send($destination,$namedestination,$path,$date,$user){
        // $destination = 'rakotonirinairintsoa0@gmail.com';
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Host = 'smtp.elasticemail.com';
        $mail->Port = 2525;
        $mail->SMTPAuth = true;
        $mail->Username = 'miraculouscommercial@outlook.com';
        $mail->Password = 'F1CD6D971EBD3531FB7D919135DAF18D67B0';
        $mail->setFrom('miraculouscommercial@outlook.com', 'Miraculous');
        $mail->addAddress($destination, $namedestination);
        $mail->Subject = 'Demande de proforma';
        // $mail->msgHTML(file_get_contents('message.html'), __DIR__);
        $mail->Body = "Cher ".$namedestination.",

        En tant que client potentiel, nous sommes intéressés par vos produits. Veuillez trouver ci-joint une liste d'articles pour lesquels nous sollicitons des proformas.

        Merci de nous envoyer des proformas détaillées, y compris les coûts unitaires hors taxe, quantités disponibles,, et toute information pertinente d'ici ".$date.".

        Cordialement,

        ".$user['nompersonnel']."
        Responsable des achats
        Miraculous
        miraculouscommercial@outlook.com";

        $mail->addAttachment($path);
        if (!$mail->send()) {
            echo 'Erreur de Mailer : ' . $mail->ErrorInfo;
        } else {
            echo 'Le message a été envoyé.';
        }
    }
}