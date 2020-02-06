<?php


namespace Message;


use Exception;

class MessageHydrator
{
    /**
     * @param $data
     * @return Message
     * @throws Exception
     */
    public function hydrate($data)
    {
        $message = new Message();
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
    public function hydrateObj($data)
    {
        $message = new Message();
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