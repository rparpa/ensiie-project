<?php


namespace Message;


use Exception;
use Message\Message as MessageEntity;

class MessageHydrator
{
    /**
     * @param $data
     * @return Message
     * @throws Exception
     */
    public function hydrate($data): MessageEntity
    {
        $message = new MessageEntity();
        $message
            ->setId($data['id'])
            ->setIduser($data['iduser'])
            ->setSource($data['source'])
            ->setIdsource($data['idsource'])
            ->setMessage($data['message'])
            ->setCreationdate(new \DateTimeImmutable($data['creationdate']));
        return $message;
    }

    /**
     * @param $data
     * @return Message
     * @throws Exception
     */
    public function hydrateObj($data): MessageEntity
    {
        $message = new MessageEntity();
        $message
            ->setId($data->id)
            ->setIduser($data->iduser)
            ->setSource($data->source)
            ->setIdsource($data->idsource)
            ->setMessage($data->message)
            ->setCreationdate(new \DateTimeImmutable($data->creationdate));
        return $message;
    }
}