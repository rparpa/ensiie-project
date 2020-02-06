<?php


namespace Meeting;


use Exception;

class MeetingHydrator
{
    /**
     * @param $data
     * @return Meeting
     * @throws Exception
     */
    public function hydrate($data)
    {
        $meeting = new Meeting();
        $meeting
            ->setId($data['id'])
            ->setSource($data['source'])
            ->setIdsource($data['idsource'])
            ->setName($data['name'])
            ->setPlace($data['place'])
            ->setDescription($data['description'])
            ->setCreationdate(new \DateTimeImmutable($data['creationdate']));
        return $meeting;
    }

    /**
     * @param $data
     * @return Meeting
     * @throws Exception
     */
    public function hydrateObj($data)
    {
        $meeting = new Meeting();
        $meeting
            ->setId($data->id)
            ->setSource($data->source)
            ->setIdsource($data->idsource)
            ->setName($data->name)
            ->setPlace($data->place)
            ->setDescription($data->description)
            ->setCreationdate(new \DateTimeImmutable($data->creationdate));
        return $meeting;
    }

}