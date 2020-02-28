<?php

class Annonce_model extends CI_Model
{
    public $idAnnonce;
    public $titre;
    public $description;
    public $prix;
    public $vendu;
    public $nbSignaler;
    public $datePublication;

    public function insert($data)
    {
		return $this->db->insert('annonce',$data);
    }

    public function delete($id)
    {
		return $this->db->delete('annonce',array('id_annonce'=>$id));
    }


    //La fonction update prend en paramètre un tableau contenant les valeurs remplaçantes des données actuelles
    public function update($model)
    {
		$this->db->where('id_annonce', $model['id_annonce']);
		return $this->db->update('annonce',$model);
    }

    public function getAllAnnonce()
    {
		return $this->db->select('*')
			->from('annonce')
			->get()
			->result_array();
    }
    public function getAnnonce($idAnnonce)
    {
		return $this->db->get_where('annonce',array('id_annonce' => $idAnnonce))->result_array();
    }
}
