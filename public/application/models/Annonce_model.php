<?php

class Annonce_model extends CI_Model
{

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
	  $this->db->order_by("date_publication", "DESC");
	  return $this->db->get()->result_array();
  }

	public function totalAnnonces()
	{
		$id= $this->session->userdata('logged_in')['id'];
		$this->db->where(['id_user'=> $id ]);
		$this->db->from('annonce');
		return $this->db->count_all_results();
	}

  public function getAnnonce($idAnnonce){
		  return $this->db->get_where('annonce',array('id_annonce' => $idAnnonce))->result_array();
  }

  public function getFilteredAnnonce($min, $max){
		$this->db->select('*');
		$this->db->from("annonce");
		$this->db->where('prix >=', $min);
		$this->db->where('prix <=', $max);
		$this->db->order_by("date_publication", "DESC");
		return $this->db->get()->result_array();
  }

  public function minPrice(){
  		$this->db->select_min('prix');
  		return $this->db->get('annonce')->row()->prix;
  }

	public function maxPrice(){
  		$this->db->select_max('prix');
		return $this->db->get('annonce')->row()->prix;
	}

  /**
   * Fonction permettant d'ajouter une annonce dans la bdd
   * 
   * @param $user Id de l'utilisateur
   * @param $titre Titre de l'annonce
   * @param $description Description de l'annonce
   * @param @prix Prix de l'annonce
   */
  public function insertAnnonce($user,$titre,$description,$prix,$etat){

    $data = array('id_user' => $user,
            'id_etat'=>$etat,
            'titre' => $titre,
					  'description'=>$description,
					  'prix'=>$prix,
					  );

		$this->db->insert('annonce', $data);
  }
	public function getAnnonceByUser($id)
	{
		return $this->db->get_where('annonce',array('id_user' => $id))->result_array();
	}
}
