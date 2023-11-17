<?php
require_once(APPPATH.'libraries/PHPMailer/src/PHPMailer.php');
require_once(APPPATH.'libraries/PHPMailer/src/SMTP.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Email extends CI_Controller{
    public function index(){
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Host = 'smtp.elasticemail.com';
        $mail->Port = 2525;
        $mail->SMTPAuth = true;
        $mail->Username = 'miraculouscommercial@outlook.com';
        $mail->Password = 'F1CD6D971EBD3531FB7D919135DAF18D67B0';
        $mail->setFrom('miraculouscommercial@outlook.com', 'Miraculous');
        $mail->addAddress('yoanrazafinjaka@gmail.com', 'Ralph');
        $mail->Subject = 'Essai de PHPMailer';
        // $mail->msgHTML(file_get_contents('message.html'), __DIR__);
        $mail->Body = 'Ceci est le contenu du message en texte clair';
        $mail->addAttachment('/var/www/html/SI-Commerce/assets/docs/BE3.pdf');
        if (!$mail->send()) {
            echo 'Erreur de Mailer : ' . $mail->ErrorInfo;
        } else {
            echo 'Le message a été envoyé.';
        }
    }
    // public function index(){
    //     $this->load->library('email');
    //     $config['protocol'] = 'smtp';
    //     $config['smtp_host'] = 'smtp.elasticemail.com'; 
    //     $config['smtp_port'] = 2525; 
    //     $config['smtp_user'] = 'miraculouscommercial@outlook.com
    //     ';
    //     $config['smtp_pass'] = 'F1CD6D971EBD3531FB7D919135DAF18D67B0';
    //     $this->email->initialize($config);
    //     $this->email->from('miraculouscommercial@outlook.com
    //     ', 'Tiavina');
    //     $this->email->to('yoanrazafinjaka@gmail.com');
    //     $this->email->subject('Demande de proforma MIraculous');
    //     $this->email->message('Contenu de l\'e-mail');
    //     $this->email->attach('/var/www/html/SI-Commerce/assets/docs/BE3.pdf');

    //     if ($this->email->send()) {
    //         echo 'E-mail envoyé avec succès.';
    //     } else {
    //         show_error($this->email->print_debugger());
    //     }

    //         }
}