<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ModeleContact extends ModeleGenerique {

    function sendEmail() {
        if (empty($_POST['name']))
            return "Please enter your name";
        else if (empty($_POST['email']))
            return "Please enter your email";
        else if (empty($_POST['content']))
            return "Your message is empty!";

        // require_once 'PHPMailer/src/Exception.php';
        // require_once 'PHPMailer/src/PHPMailer.php';
        // require_once 'PHPMailer/src/SMTP.php';

        $mail = new PHPMailer(true);                                // Passing `true` enables exceptions
        try {

            $mail->isSMTP();                                        // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                                 // Enable SMTP authentication
            $mail->Username = 'insaneinteractions.ii@gmail.com';         // SMTP username
            $mail->Password = 'Jodieowi';                        // SMTP password
            $mail->SMTPSecure = 'ssl';                              // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 465;                                      // TCP port to connect to

            //Recipients
            $mail->setFrom( $_POST['email'], 'Insane Interactions');
            $mail->addAddress('insaneinteractions.ii@gmail.com'); 

            //Content
            $mail->isHTML(true);                                    // Set email format to HTML
            $mail->Subject = 'Request from ' . $_POST['name'] . ' - Insane Interactions' ;
            $mail->Body    = $_POST['name'] . ' sent the following message : : <br>' . $_POST['content'] . '. <br> Answer them at this address ' . $_POST['email'];
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();  
        } catch (phpmailerException $e) {
            return $e->errorMessage();                         //Pretty error messages from PHPMailer
        } catch (Exception $e) {
            return 'Mailer Error: ' . $mail->ErrorInfo;
        }
        return NULL; 
    }
}

?>
