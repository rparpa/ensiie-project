<?php
use Db\Connection;
use Project\ProjectHydrator;
use Project\ProjectRepository;


require_once '../src/Bootstrap.php';
include_once '../src/View/template.php';

$projectrepository =
    new ProjectRepository(Connection::get(), new ProjectHydrator());


$idproject =  !empty($data['idproject']) ? $data['idproject'] : null;


?>

<div class="container-fluid">
    <legende>Project</legende>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="row">
                    <h2>Collaborateurs</h2>
                </div>
                <div class="row">
                    <div class="col">
                        <select >
                            <option>Collaborateur test</option>
                        </select>
                    </div>
                    <div class="col">
                        <button>Ajouter</button>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <h2>Taches</h2>
                </div>
                <div class="row">
                    <div class="col">
                        <select >
                            <option>Tache test</option>
                        </select>
                    </div>
                    <div class="col">
                        <button>Ajouter</button>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <h2>Réunions</h2>
                </div>
                <div class="row">
                    <div class="col">
                        <select >
                            <option>Reunion test</option>
                        </select>
                    </div>
                    <div class="col">
                        <button>Ajouter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
