<?php


namespace Project;

use Exception;

class ProjectHydrator
{
    /**
     * @param $data
     * @return Project
     * @throws Exception
     */
    public function hydrate($data)
    {
        $project = new Project();
        $project
            ->setId($data['id'])
            ->setName($data['name'])
            ->setIdorganization($data['idorganisation'])
            ->setCreationdate(new \DateTimeImmutable($data['creationdate']));
        return $project;
    }

    /**
     * @param $data
     * @return Project
     * @throws Exception
     */
    public function hydrateObj($data)
    {
        $project = new Project();
        $project
            ->setId($data->id)
            ->setName($data->name)
            ->setIdorganization($data->idorganisation)
            ->setCreationdate(new \DateTimeImmutable($data->creationdate));
        return $project;
    }
}