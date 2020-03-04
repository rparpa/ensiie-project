<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ModeleForgot extends ModeleGenerique {

    function sendEmail() {
        if (empty($_POST["email"]))
            return 'Please provide a valid email address';
        else
            $email = htmlspecialchars($_POST["email"]);

        $req = $this->connexion->prepare('SELECT * FROM Utilisateur WHERE email = ?');
        $req->execute(array($email));

        $p = $req->fetch(PDO::FETCH_ASSOC); 
        if (!$p) {
            return 'The email address does not belong to any account !';
        } else {
            // require_once 'PHPMailer/src/Exception.php';
            // require_once 'PHPMailer/src/PHPMailer.php';
            // require_once 'PHPMailer/src/SMTP.php';

            $mail = new PHPMailer(true);                                // Passing `true` enables exceptions
            try {
                //Server settings

                $mail->isSMTP();                                        // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                                 // Enable SMTP authentication
                $mail->Username = 'insaneinteractions.ii@gmail.com';         // SMTP username
                $mail->Password = 'Jodieowi';                        // SMTP password
                $mail->SMTPSecure = 'ssl';                              // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 465;                                      // TCP port to connect to

                //Recipients
                $mail->setFrom( 'insaneinteractions.ii@gmail.com', 'Insane Interactions');
                $mail->addAddress($_POST['email']);      // Name is optional

                //Content
                $mail->isHTML(true);                                    // Set email format to HTML
                $mail->Subject = 'Reset your password';

                //
                // /!\ ATTENTION: Link a changé pour l'IUT
                //
                $mail->Body    = 'Link: http://localhost:8080/index.php?module=module_reset&p=' . $p['password'];
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
            } catch (phpmailerException $e) {
                return  $e->errorMessage();                         //Pretty error messages from PHPMailer
            } catch (Exception $e) {
                return 'Mailer Error: ' . $mail->ErrorInfo;
            }
        }

        return NULL; 
    }
}

?>
