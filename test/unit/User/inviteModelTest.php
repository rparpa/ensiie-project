<?php

use PHPMailer\src\PHPMailer;
use PHPMailer\src\Exception;
use PHPUnit\Framework\TestCase;

require_once 'PHPMailer/src/Exception.php';
require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';

require_once 'public/include/model_gen.php';
require_once 'public/modules/module_invite/model_invite.php';

class inviteModelTest extends TestCase
{
    public function testSendMail()
    {
        $dsn = 'mysql:host=mysql;dbname=projet';
        $user = 'root';
        $password = 'ensiie';

        $model = new ModeleInvite($dsn, $user, $password);

        $this->assertSame($model->sendEmail(), NULL);

        $_POST["email1"] = 'insaneinteractions.ii@gmail.com';

        $this->assertSame($model->sendEmail(), 'Error, some variables are not set');

        $_SESSION['pseudo'] = 'test';
        $_COOKIE['conversationID'] = 'test';
        
        $this->assertEquals($model->sendEmail(), NULL);
    }
}
?>
