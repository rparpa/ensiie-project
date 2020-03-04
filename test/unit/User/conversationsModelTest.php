<?php
use PHPUnit\Framework\TestCase;
require_once 'public/include/model_gen.php';
require_once 'public/modules/module_conversations/model_conversations.php';

class conversationsModelTest extends TestCase
{
    public function testGetConversations()
    {
        $dsn = 'mysql:host=mysql;dbname=projet';
        $user = 'root';
        $password = 'ensiie';

        $model = new ModeleConversations($dsn, $user, $password);

        $_SESSION['id'] = 1;
        $expected = array('InjrpM5OHIW2mQwuFMvb3' => 'test');
        $this->assertSame($expected, $model->getConversations());

        $_SESSION['id'] = -1;
        $expected = array();
        $this->assertSame($expected, $model->getConversations());
    }
}
?>
