<?php

class Annonce_model extends CI_Model
{

  public function insert(){

	  /*$format = "%Y-%M-%d %H:%i";
	  $date = "echo @mdate($format)"*/
	  //Setting values for table columns

	  //$id_user = $this->session->userdata('id_user');
	  $data = array(
	  	 //'id_user' => $id_user,
		  'titre' => $this->input->post('titre'),
		  'description' => $this->input->post('descri'),
		  'prix' => $this->input->post('prix'),
		  'vendu' => false,
		  'nb_signal' => 0
	  );
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

	  $this->db->select('*');
	  $this->db->from("annonce");
	  $this->db->order_by("date_publication", "ASC");
	  return $this->db->get()->result_array();
  }

  public function getAnnonce($idAnnonce){
		  return $this->db->get_where('annonce',array('id_annonce' => $idAnnonce))->result_array();
  }

  public function minPrice(){
  		$this->db->select_min('prix');
  		return $this->db->get('annonce')->row()->prix;
  }

	public function maxPrice(){
  		$this->db->select_max('prix');
		return $this->db->get('annonce')->row()->prix;
	}

}
