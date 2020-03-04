<?php

use PHPMailer\src\PHPMailer;
use PHPMailer\src\Exception;
use PHPUnit\Framework\TestCase;

require_once 'PHPMailer/src/Exception.php';
require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';

require_once 'public/include/model_gen.php';
require_once 'public/modules/module_forgot/model_forgot.php';

class forgotModelTest extends TestCase
{
    public function testSendMail()
    {
        $dsn = 'mysql:host=mysql;dbname=projet';
        $user = 'root';
        $password = 'ensiie';

        $model = new ModeleForgot($dsn, $user, $password);

        $this->assertSame($model->sendEmail(), 'Please provide a valid email address');

        $_POST["email"] = 'fakeemail@fake.com';
        $this->assertSame($model->sendEmail(), 'The email address does not belong to any account !');

        $_POST["email"] = 'insaneinteractions.ii@gmail.com';
        $this->assertSame($model->sendEmail(), NULL);
    }
}
?>
