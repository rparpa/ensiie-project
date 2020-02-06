<?php


namespace Project;

use Exception;
use \Project\Project as ProjectEntity;

class ProjectHydrator
{
    /**
     * @param $data
     * @return Project
     * @throws Exception
     */
    public function hydrate($data): ProjectEntity
    {
        $project = new ProjectEntity();
        $project
            ->setId($data['id'])
            ->setName($data['name'])
            ->setIdorganisation($data['idorganisation'])
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
        $project = new ProjectEntity();
        $project
            ->setId($data->id)
            ->setName($data->name)
            ->setIdorganisation($data->idorganisation)
            ->setCreationdate(new \DateTimeImmutable($data->creationdate));
        return $project;
    }
}