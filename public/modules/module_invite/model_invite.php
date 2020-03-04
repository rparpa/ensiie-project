<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ModeleInvite extends ModeleGenerique {

    function sendEmail() {
        $message = null;

        $emails = array();
        
        if (isset($_POST["email1"]) && !empty($_POST["email1"])) 
            array_push($emails, $_POST["email1"]); 
        
        if (isset($_POST["email2"]) && !empty($_POST["email2"])) 
            array_push($emails, $_POST["email2"]);  
        
        if (isset($_POST["email3"]) && !empty($_POST["email3"])) 
            array_push($emails, $_POST["email3"]);
        
        if (!empty($emails)) {
            if (!isset($_SESSION['pseudo']) || !isset($_COOKIE['conversationID']))
                return 'Error, some variables are not set';

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
                $mail->setFrom( 'insaneinteractions.ii@gmail.com', 'Insane Interactions');

                foreach ($emails as &$value) {
                    $mail->addAddress($value); 
                }

                //Content
                $mail->isHTML(true);                                    // Set email format to HTML
                $mail->Subject = 'Join ' . $_SESSION['pseudo'] . ' on Insane Interactions' ;
                $mail->Body = 'Hi,<br>' . $_SESSION['pseudo'] . ' invited you to join them on Insane Interactions, here is the key to talk to them : <b>' . $_COOKIE['conversationID'] . '</b>';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
            } catch (phpmailerException $e) {
                return  $e->errorMessage();                         //Pretty error messages from PHPMailer
            } catch (Exception $e) {
                return 'Mailer Error: ' . $mail->ErrorInfo;
            }
        }

        return $message;
    }
}

?>
