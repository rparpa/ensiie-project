<?php
use PHPUnit\Framework\TestCase;
require_once 'public/include/model_gen.php';
require_once 'public/modules/module_join/model_join.php';


class joinModelTest extends TestCase
{

    public function testRegisterAdmin()
    {
        $dsn = 'mysql:host=mysql;dbname=projet';
        $user = 'root';
        $password = 'ensiie';

        $model = new ModeleJoin($dsn, $user, $password);

        $_POST = array();
        $this->assertSame("Please provide your key", $model->joinConversation());
        
        $_POST['key'] = 'randomValue'; 
        $this->assertSame("Wrong key, please check your key !", $model->joinConversation());


        $_SESSION['id'] = '1';
        $_POST['key'] = 'InjrpM5OHIW2mQwuFMvb3';
               
        $this->assertSame("You're already in that room !", $model->joinConversation());



        $_SESSION['id'] = '2';
        $_POST['key'] = 'InjrpM5OHIW2mQwuFMvb3';
               
        $this->assertSame(NULL, $model->joinConversation());

    }
}
?>