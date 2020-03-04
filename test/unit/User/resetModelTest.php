<?php

use PHPMailer\src\PHPMailer;
use PHPMailer\src\Exception;
use PHPUnit\Framework\TestCase;

require_once 'public/include/model_gen.php';
require_once 'public/modules/module_reset/model_reset.php';

class resetModelTest extends TestCase
{
    public function testChangePassword()
    {
        $dsn = 'mysql:host=mysql;dbname=projet';
        $user = 'root';
        $password = 'ensiie';

        $model = new ModeleReset($dsn, $user, $password);

        $this->assertSame('Please enter the passwords', $model->changePassword());
        $_POST["newPassword"] = "test";
        $this->assertSame('Please enter the passwords', $model->changePassword());
        $_POST["newPasswordRepeat"] = "test1";

        $_GET['p'] = "fakesha512";
        $this->assertSame('Something went wrong !', $model->changePassword());

        $_GET['p'] = "03e5eca7bca6b5a1981020b60301918577e7d8d7990fd93693da74249acee489324328ddef689408af3eea8d546e35bacae5ec5d54e6fceed4b531d7b5ee9065";
        $this->assertSame('The two passwords do not match !', $model->changePassword());

        $_POST["newPasswordRepeat"] = "test";
        $this->assertSame(NULL, $model->changePassword());
    }
}
?>
