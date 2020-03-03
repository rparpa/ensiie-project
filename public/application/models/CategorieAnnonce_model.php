<?php

class CategorieAnnonce_model extends CI_Model
{
    public $idAnnonce;
    public $idCategorie;

    public function insert()
    {

    }

    public function delete()
    {

    }

    public function update()
    {

    }

    /**
     * Fonction permettant de récupérer l'ensemble des catégories d'une annonce
     * 
     * @param $id_annonce
     * 
     * @return
     * ensemble des catégories sous forme d'array
     */
    public function getAllCategorieAnnonce($id_annonce){
        $this->db->select('categorie');
        $this->db->from('categorie');
        $this->db->join('categorie_annonce', 'categorie.id_categorie = categorie_annonce.id_categorie');
        $this->db->where('id_annonce',$id_annonce);
        return $this->db->get()->result_array();

    }
    public function getCategorieAnnonce()
    {

    }
}