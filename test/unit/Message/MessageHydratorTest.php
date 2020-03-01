<?php


namespace Message;

use DateTimeInterface;
use phpDocumentor\Reflection\Types\Object_;
use PHPUnit\Framework\TestCase;

class MessageHydratorTest extends TestCase
{
    /**
     * @test
     */
    public function messageIsAJson()
    {
        $hydrator = new MessageHydrator();

        $data = ["id"=>1, "iduser"=>1, "source"=>"", "idsource"=>1, "message"=>"", "creationdate"=>"1999-11-22"];
        
        $messageRef = new Message();
        $messageRef->setId(1);
        $messageRef->setIduser(1);
        $messageRef->setSource("");
        $messageRef->setIdsource(1);
        $messageRef->setMessage("");
        $messageRef->setCreationdate(new \DateTimeImmutable('1999-11-22'));

        $message = $hydrator->hydrate($data);
        self::assertEquals($messageRef,$message);
    }

    /**
     * @test
     */
    // public function messageIsAObjet()
    // {
    //     $hydrator = new MessageHydrator();

    //     $data = new Object_();
    //     $data->id = 1;
    //     $data->iduser = 1;
    //     $data->source = "";
    //     $data->idsource = 1;
    //     $data->message = "";
    //     $data->creationDate = '1999-11-22';

    //     $messageRef = new Message();
    //     $messageRef->setId(1);
    //     $messageRef->setIduser(1);
    //     $messageRef->setSource("");
    //     $messageRef->setIdsource(1);
    //     $messageRef->setMessage("");
    //     $messageRef->setCreationdate(new \DateTimeImmutable('1999-11-22'));

    //     $message = $hydrator->hydrateObj($data);
    //     self::assertEquals($messageRef,$message);
    // }
}