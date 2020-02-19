<?php

use Organization\OrganizationHydrator;
use Organization\OrganizationRepository;

require_once '../src/Bootstrap.php';
include_once '../src/View/template.php';

$orgahydrator = new OrganizationHydrator();
$orgarepository = new OrganizationRepository(Db\Connection::get(),$orgahydrator);

$data = [
  'organizations' => $orgarepository->fetchAll()
];

loadView('organization', []);


