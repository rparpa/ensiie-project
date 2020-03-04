<?php
use PHPUnit\Framework\TestCase;
require_once 'public/include/model_gen.php';
require_once 'public/modules/module_create/model_create.php';


class createModelTest extends TestCase
{
    public function testGenerateKey()
    {
        $dsn = 'mysql:host=mysql;dbname=projet';
        $user = 'root';
        $password = 'ensiie';

        $model = new ModeleCreate($dsn, $user, $password);

        $key = $model->generateKey();

        $conversation = $model->getConversationsByKey($key);

        $this->assertSame($conversation, false);

        $conversation = $model->getConversationsByKey('InjrpM5OHIW2mQwuFMvb3');

        $expected = array(
            'cleConversation' => 'InjrpM5OHIW2mQwuFMvb3',
            'dateCreation' => '2020-02-29 22:05:36',
            'nomConv' => 'test',
            'idUser' => '1'
        );

        $this->assertSame($conversation, $expected);
    }

    public function testSaveConversation()
    {
        $dsn = 'mysql:host=mysql;dbname=projet';
        $user = 'root';
        $password = 'ensiie';

        $model = new ModeleCreate($dsn, $user, $password);

        $_POST['name'] = 'test-ci';
        $_SESSION['id'] = 2;
        $key = $model->generateKey();

        $this->assertSame($model->saveConversationID($key), NULL);
        $this->assertSame($model->saveConversationID($key), 'Sorry, this name is already taken');
    }
}
?>
