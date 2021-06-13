<?php
ob_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../src/PHPMailer/src/Exception.php';
require '../src/PHPMailer/src/PHPMailer.php';
require '../src/PHPMailer/src/SMTP.php';

$username = $_POST['username'];
$email = $_POST['email'];

include 'template/mail_template.html';
$html = ob_get_clean();
$html = str_replace("%%LINK%%", "http://".$_SERVER['HTTP_HOST']."/validation_email.php?username=".$username, $html);
$html = str_replace("%%USERNAME%%", $username, $html);
$html = str_replace("%%LOGO%%", "cid:my-attach", $html);

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = "smtp";
$mail->SMTPDebug  = 1;  
$mail->SMTPAuth   = TRUE;
$mail->SMTPSecure = "tls";
$mail->Port       = 587;
$mail->Host       = "smtp.gmail.com";
$mail->Username   = "envoimailpython@gmail.com";
$mail->Password   = "python1Mail";

$mail->IsHTML(true);
$mail->AddAddress($email, "recipient-name");
$mail->SetFrom("envoimailpython@gmail.com", "WikipedIIE");
$mail->Subject = "Inscription";
$mail->AddEmbeddedImage("logo/icon.png", "my-attach", "logo/icon.png");
$mail->MsgHTML($html);

if(!$mail->Send()) {
    file_put_contents('php://stderr', print_r("Error during confirmation inscription sending mail in mail.php\n", TRUE));
}

?>