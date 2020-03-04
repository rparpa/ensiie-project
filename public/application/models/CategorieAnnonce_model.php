<?php

class CategorieAnnonce_model extends CI_Model
{
    public $idAnnonce;
    public $idCategorie;


    /**
     * Fonction permettant d'inserer plusieurs catégories associé à une annonce
     * 
     * @param $id_annonce id de l'annonce
     * @param $categories ensemble de catégories sous forme d'un array
     */
    public function insert($id_annonce,$categories){


        foreach($categories as $key=>$value){
            if(is_numeric($value)){
                $value=$value+1;
                $this->db->insert('categorie_annonce',array('id_annonce'=>$id_annonce,'id_categorie'=>$value));
            }
            else{
                $id_categorie=$this->categorie->getCategorieByName($value)[0]['id_categorie'];
                $this->db->insert('categorie_annonce',array('id_annonce'=>$id_annonce,'id_categorie'=>$id_categorie));
            }

        }

    }

    /**
     * Fonction permettant de supprimer les catégories d'une annonce
     * 
     * @param $id_annonce id de l'annonce
     * 
     */
    public function delete($id_annonce){
		$this->db->delete('categorie_annonce', array('id_annonce' => $id_annonce));
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