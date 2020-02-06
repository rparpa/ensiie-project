<?php


namespace Organization;

use Exception;

class OrganizationHydrator
{
    /**
     * @param $data
     * @return Organization
     * @throws Exception
     */
    public function hydrate($data)
    {
        $organization = new Organization();
        $organization
            ->setId($data['id'])
            ->setName($data['name'])
            ->setCreationdate(new \DateTimeImmutable($data['creationdate']));
        return $organization;
    }

    /**
     * @param $data
     * @return Organization
     * @throws Exception
     */
    public function hydrateObj($data)
    {
        $organization = new Organization();
        $organization
            ->setId($data->id)
            ->setName($data->name)
            ->setCreationdate(new \DateTimeImmutable($data->creationdate));
        return $organization;
    }
}