<?php

namespace GenericRepositoryDB;

class GenericRepository
{
    /** @var DBInterface */
    private $mysql;

    public function __construct(DBInterface $mysql)
    {
        $this->mysql = $mysql;
    }

    protected function getMySql(): DBInterface
    {
        return $this->mysql;
    }

    // ...
}