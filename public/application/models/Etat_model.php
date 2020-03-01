<?php

class Etat_model extends CI_Model
{
    public $idEtat;
    public $nom;
    public function insert($etat)
    {
		$arr=array('etat'=>$etat);
		return $this->db->insert('etat',$arr);
    }

    public function delete($id)
    {
		return $this->db->delete('etat',array('id_etat'=>$id));
    }

    public function update($model)
    {
		$this->db->where('id_etat', $model['id_etat']);
		return $this->db->update('etat',$model);
    }

    public function getAllEtat()
    {
		return $this->db->select('*')
			->from('etat')
			->get()
			->result_array();
    }

    /**
     * Fonction permettant de recupérer un etat
     * 
     * @param $id_etat Id de l'état
     * 
     * @return
     * etat sous forme d'un array
     */
    public function getEtat($id_etat){

      return $this->db->get_where('etat',array('id_etat' => $id_etat))->result_array();
      
    }
}
