<?php

namespace Db;

use PDO;
use models;


class ObjectManager
{


    private $pdo;
    private $pdoStatement;




    public function __construct()
    {



    }

    /**
     *
     * inserer un objet dans la base en mettant à jour l'objet en lui précisant un id
     * @param ObjectU passage de objet par reference
     * @return boolean
     *
     *
     */
    public function create(ObjectU &$objet){


    }


    /**
     *
     * recupere un objet a partir de son identifiant
     * @param ObjectU $id
     * @return bool|ObjectU\null retourne objet si tout va bien, false si erreur, null si il n y a pas d'objet a retourner
     */

    public function select(ObjectU $id){

    }

    /**
     *
     * Met un jour un objet
     * @return bool
     */
    public function update(ObjectU $objet){

    }


    /**
     * Supprime un objet stocke en bdd
     * @param ObjectU $objet
     * @return bool
     */

    public function delete(ObjectU $objet){

    }

    /**
     * recupere ous les objets de la base
     * @return ObjectU[] qui est un tableau d'objet
     */
    public function selectAll(){


    }


}