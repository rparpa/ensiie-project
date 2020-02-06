<?php


namespace Info;

use Exception;

class InfoHydrator
{
    /**
     * @param $data
     * @return Info
     * @throws Exception
     */
    public function hydrate($data)
    {
        $info = new Info();
        $info
            ->setId($data['id'])
            ->setSource($data['source'])
            ->setIdsource($data['idsource'])
            ->setIdcreator($data['idcreator'])
            ->setTitle($data['title'])
            ->setContent($data['content'])
            ->setCreationdate(new \DateTimeImmutable($data['creationdate']));
        return $info;
    }

    /**
     * @param $data
     * @return Info
     * @throws Exception
     */
    public function hydrateObj($data)
    {
        $info = new Info();
        $info
            ->setId($data->id)
            ->setSource($data->source)
            ->setIdsource($data->idsource)
            ->setIdcreator($data->idcreator)
            ->setTitle($data->title)
            ->setContent($data->content)
            ->setCreationdate(new \DateTimeImmutable($data->creationdate));
        return $info;
    }
}