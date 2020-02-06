<?php


namespace Organization;

use Exception;
use \Organization\Organization as OrganizationEntity;

class OrganizationHydrator
{
    /**
     * @param $data
     * @return Organization
     * @throws Exception
     */
    public function hydrate($data): OrganizationEntity
    {
        $organization = new OrganizationEntity();
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
    public function hydrateObj($data): OrganizationEntity
    {
        $organization = new OrganizationEntity();
        $organization
            ->setId($data->id)
            ->setName($data->name)
            ->setCreationdate(new \DateTimeImmutable($data->creationdate));
        return $organization;
    }
}