<?php
use PHPUnit\Framework\TestCase;
require_once 'public/include/model_gen.php';
require_once 'public/modules/module_signin/model_signin.php';

class signinModelTest extends TestCase
{
    public function testSignIn()
    {
        $dsn = 'mysql:host=mysql;dbname=projet';
        $user = 'root';
        $password = 'ensiie';

        $model = new ModeleSignin($dsn, $user, $password);

        $this->assertSame($model->connection(), 'Please provide a username or email address');

        $_POST["pseudo"] = 'test';
        $this->assertSame($model->connection(), 'Please enter your password');

        $_POST["password"] = 'test';
        $this->assertSame($model->connection(), 'Wrong username, email address or password !');

        
        $_POST["pseudo"] = 'fookinpelican';
        $_POST["password"] = 'test1234';

        $this->assertSame($model->connection(), NULL);

        $this->assertSame($_SESSION['isAdmin'], true);
    }
}
?>
