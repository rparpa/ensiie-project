<?php
use PHPUnit\Framework\TestCase;
require_once 'public/include/model_gen.php';
require_once 'public/modules/module_register/model_register.php';

class registerModelTest extends TestCase
{
    public function testRegisterUser()
    {
        $dsn = 'mysql:host=mysql;dbname=projet';
        $user = 'root';
        $password = 'ensiie';

        $model = new ModeleRegister($dsn, $user, $password);

        $this->assertSame($model->registerUser(), 'Please enter your pseudo');

        $_POST["pseudo"] = 'test_ci';
        $this->assertSame($model->registerUser(), 'Please enter a valid password');

        $_POST["password"] = 'test_ci';
        $this->assertSame($model->registerUser(), NULL);

        $this->assertSame($model->registerUser(), 'Email or username already taken');
    }
}
?>
