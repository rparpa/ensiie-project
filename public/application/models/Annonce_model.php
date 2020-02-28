<?php

class Annonce_model extends CI_Model
{

  public function insert($data){
		return $this->db->insert('annonce',$data);
  }

  public function delete($id){
		  return $this->db->delete('annonce',array('id_annonce'=>$id));
  }


  //La fonction update prend en paramètre un tableau contenant les valeurs remplaçantes des données actuelles
  public function update($model){
		$this->db->where('id_annonce', $model['id_annonce']);
		return $this->db->update('annonce',$model);
  }

  /**
  *	Fonction permettant de recupérer toutes les annonces
  *
  * @return
  *   Retourne un array contenant les annonces
  */
  public function getAllAnnonce(){

	  $this->db->select('*')
             ->from('annonce');
      
    return $this->db->get()->result_array();
  }

  public function getAnnonce($idAnnonce){
		  return $this->db->get_where('annonce',array('id_annonce' => $idAnnonce))->result_array();
  }

}
