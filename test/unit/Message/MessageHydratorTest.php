<?php


namespace Message;


use PHPUnit\Framework\TestCase;

class MessageHydratorTest extends TestCase
{

    public function messageIsAJson()
    {
        $hydrator = new MessageHydrator();
        $data = '{"id":1, "iduser":1, "source":"", "idsource":1, "message":"", "creationdate":"1999-11-22"}';
        $message = $hydrator->hydrate($data);
        self::assertSame(json_decode($data),$message);
    }


    public function messageIsAObjet()
    {
        $hydrator = new MessageHydrator();
        $data = '{"id":1, "iduser":1, "source":"", "idsource":1, "message":"", "creationdate":"1999-11-22"}';
        $message = $hydrator->hydrateObj($data);
        self::assertSame(json_decode($data),$message);
    }
}