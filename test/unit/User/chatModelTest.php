<?php
use PHPUnit\Framework\TestCase;
require_once 'public/include/model_gen.php';
require_once 'public/modules/module_chat/model_chat.php';

class chatModelTest extends TestCase
{

    public function testGetConversations()
    {
        $dsn = 'mysql:host=mysql;dbname=projet';
        $user = 'root';
        $password = 'ensiie';

        $model = new ModeleChat($dsn, $user, $password);

        $_SESSION['id'] = 1;
        $expected = array('InjrpM5OHIW2mQwuFMvb3' => 'test');
        $this->assertSame($expected, $model->getConversations());

        $_SESSION['id'] = -1;
        $expected = array();
        $this->assertSame($expected, $model->getConversations());

        $_SESSION['id'] = '';
        $_COOKIE['idUser'] = '1';
        $expected = array('InjrpM5OHIW2mQwuFMvb3' => 'test');
        $this->assertSame($expected, $model->getConversations());

        $_SESSION['id'] = '';
        $_COOKIE['idUser'] = '';
        $this->assertSame('Error', $model->getConversations());
    }

    public function testGetRoomName()
    {
        $dsn = 'mysql:host=mysql;dbname=projet';
        $user = 'root';
        $password = 'ensiie';

        $model = new ModeleChat($dsn, $user, $password);

        $_GET['key'] = 'InjrpM5OHIW2mQwuFMvb3';
        $this->assertSame($model->getRoomName(), 'test');

        $_GET['key'] = NULL;
        $this->assertSame($model->getRoomName(), NULL);
    }

    public function testSendMessage()
    {
        $dsn = 'mysql:host=mysql;dbname=projet';
        $user = 'root';
        $password = 'ensiie';

        $model = new ModeleChat($dsn, $user, $password);

        $_SESSION['id'] = '';
        $_COOKIE['idUser'] = '';
        $_COOKIE['conversationKey'] = 'InjrpM5OHIW2mQwuFMvb3';
        $this->assertSame($model->sendMessage('test', 'InjrpM5OHIW2mQwuFMvb3'), 'Error');

        $_SESSION['id'] = '1';
        $_COOKIE['idUser'] = '';
        $_COOKIE['conversationKey'] = 'InjrpM5OHIW2mQwuFMvb3';
        $this->assertSame($model->sendMessage('test', 'InjrpM5OHIW2mQwuFMvb3'), NULL);

        $_SESSION['id'] = '';
        $_COOKIE['idUser'] = '1';
        $_COOKIE['conversationKey'] = 'InjrpM5OHIW2mQwuFMvb3';
        $this->assertSame($model->sendMessage('test', 'InjrpM5OHIW2mQwuFMvb3'), NULL);

        $_SESSION['id'] = '';
        $_COOKIE['idUser'] = '1';
        $_COOKIE['conversationKey'] = '';
        $this->assertSame($model->sendMessage('test', 'InjrpM5OHIW2mQwuFMvb3'), 'Error');

        $_SESSION['id'] = '';
        $_COOKIE['idUser'] = '1';
        $_COOKIE['conversationKey'] = 'anotherKeyThatTheUserDoesntHave';
        $this->assertSame($model->sendMessage('test', 'anotherKeyThatTheUserDoesntHave'), 'Error');
    }
}
?>
