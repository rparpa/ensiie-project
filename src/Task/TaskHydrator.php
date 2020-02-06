<?php

namespace Task;

use Exception;

class TaskHydrator
{
    /**
     * @param $data
     * @return Task
     * @throws Exception
     */
    public function hydrate($data)
    {
        $task = new Task();
        $task
            ->setId($data['id'])
            ->setIdcreator($data['idcreator'])
            ->setIdassignee($data['idassignee'])
            ->setTitle($data['title'])
            ->setContent($data['content'])
            ->setState($data['state'])
            ->setCreationdate(new \DateTimeImmutable($data['creationdate']));
        return $task;
    }

    /**
     * @param $data
     * @return Task
     * @throws Exception
     */
    public function hydrateObj($data)
    {
        $task = new Task();
        $task
            ->setId($data->id)
            ->setIdcreator($data->idcreator)
            ->setIdassignee($data->idassignee)
            ->setTitle($data->title)
            ->setContent($data->content)
            ->setState($data->state)
            ->setCreationdate(new \DateTimeImmutable($data->creationdate));
        return $task;
    }
}