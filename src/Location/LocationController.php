<?php

namespace Location;

use PDO;
use Exception;

class LocationController
{
    private LocationRepository $locationRepository;

    public function __construct(PDO $connection)
    {
        $this->locationRepository = new LocationRepository($connection);
    }

    public function CreateLocation($post)
    {
        try {
            $this->locationRepository->create($post);
        } catch (Exception $e) {
            $this->userView->vueErreur($e->getMessage());
        }
    }

    public function DeleteLocation($post)
    {
        try {
            $this->locationRepository->delete($post);
        } catch (Exception $e) {
            $this->userView->vueErreur($e->getMessage());
        }
    }
}
