<?php
use PHPUnit\Framework\TestCase;
require_once 'public/include/model_gen.php';
require_once 'public/modules/module_addadmin/model_addadmin.php';


class addAdminModelTest extends TestCase
{

    public function testRegisterAdmin()
    {
        $dsn = 'mysql:host=mysql;dbname=projet';
        $user = 'root';
        $password = 'ensiie';

        $model = new ModeleAddadmin($dsn, $user, $password);
        // no username given 
        $_POST = array();
        $this->assertSame("Please enter a username", $model->registerAdmin());
        // no username given 
        $_POST['pseudo'] = ''; 
        $this->assertSame("Please enter a username", $model->registerAdmin());
        // user not existing
        $_POST['pseudo'] = 'notExisting';
        $this->assertSame("The username doesn't exist !", $model->registerAdmin());
        // user with no email 
        $_POST['pseudo'] = 'canadiens';
        $this->assertSame("Sorry, an administrator must have an email address", $model->registerAdmin());
        // user already admin 
        $_POST['pseudo'] = 'fookinpelican';
        $this->assertSame("Sorry, something went wrong", $model->registerAdmin());
        // evrything's okay
        $_POST['pseudo'] = 'testidsession';
        $this->assertSame(NULL, $model->registerAdmin());        




    }
}
?>
