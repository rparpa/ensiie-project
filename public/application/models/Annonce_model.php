<?php

class Annonce_model extends CI_Model
{

  public function delete($id){
		  return $this->db->delete('annonce',array('id_annonce'=>$id));
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
		$id= $this->session->userdata('logged_in')['id_user'];
		$this->db->where(['id_user'=> $id ]);
		$this->db->from('annonce');
		return $this->db->count_all_results();
	}

  public function getAnnonce($idAnnonce){
		  return $this->db->get_where('annonce',array('id_annonce' => $idAnnonce))->result_array();
  }

  	/**
	* Fonction permettant de récuperer les annonces d'un utilisateur
	* 
	* @param $id_user Id de l'utilisateur
	* @return
	* annonces de l'utilisateur sous forme d'un array
	*/
	public function getUserAnnonce($id_user){
		return $this->db->select('*')
						->from('annonce')
						->where('id_user', $id_user)
						->order_by("date_publication", "DESC")
						->get()
						->result_array();
	}
	
  public function getFilteredAnnonce($min, $max,$id_user=null){
		$this->db->select('*');
		$this->db->from("annonce");
		if($id_user!=null)
			$this->db->where('id_user', $id_user);
		
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
   * @param @image Image de l'annonce
   * @param @categories liste des catégories de l'annonce
   */
  public function insertAnnonce($user,$titre,$description,$prix,$etat,$image,$categories){

    $data = array('id_user' => $user,
            'id_etat'=>$etat,
            'titre' => $titre,
					  'description'=>$description,
					  'prix'=>$prix,
					  );

		$this->db->insert('annonce', $data);

		//Récupération de l'id de l'annonce ajouté
		$id_annonce = $this->db->insert_id();

		//Ajout du tuple dans la table image
		#TODO : NE PAS INSERER DANS BDD SI AUCUNE IMAGE UPLOAD
		//echo "ok ".$image;
		if($image!=""){
			echo "ok";
			$this->image->insert($id_annonce,$image);

		}
		
		//Ajout du tuple dans la table Categorie_annonce
		if($categories!=null){
			$this->categorieAnnonce->insert($id_annonce,$categories);
		}
  }


	/**
	 * Fonction permettant de mettre à jour une annonce dans la bdd
	 * 
	* @param $user Id de l'utilisateur
	* @param $titre Titre de l'annonce
	* @param $description Description de l'annonce
	* @param @prix Prix de l'annonce
  	* @param @image Image de l'annonce
   	* @param @categories liste des catégories de l'annonce
	 */
	public function updateAnnonce($id_annonce,$user,$titre,$description,$prix,$etat,$image,$categories){

		$data = array(
			'id_user' => $user,
			'id_etat'=>$etat,
			'titre' => $titre,
			'description'=>$description,
			'prix'=>$prix,
		);
		$this->db->where('id_annonce', $id_annonce);
		$this->db->update('annonce',$data);

		//Gestion de l'image de l'annonce
		$old_image=$this->image->getImage($id_annonce);
		if($old_image!=null){
			$this->image->delete($id_annonce);
			unlink('assets/images/'.$old_image[0]['url']);
			if($image!="")
				$this->image->insert($id_annonce,$image);			
		}else if($image!="")
			$this->image->insert($id_annonce,$image);

		//Ajout du tuple dans la table Categorie_annonce
		if($categories!=null){
			$this->categorieAnnonce->delete($id_annonce);
			$this->categorieAnnonce->insert($id_annonce,$categories);
		}
  }


	public function getAnnonceByUser($id)
	{
		return $this->db->get_where('annonce',array('id_user' => $id))->result_array();
	}

	public function get_annonces_signalees()
	{
		$this->db->select('*');
		$this->db->from('annonce');
		$this->db->where('nb_signal >', 0);
		$this->db->order_by('nb_signal', 'DESC');
		return $this->db->get()->result_array();
	}


	/**
	 * Fonction permettant de signaler une annonce dans la bdd
	 * en incrémentant l'attribut nb_signal
	 * @param $id_annonce Id de l'annonce
	 */
	public function signaler($id_annonce)
	{
		$this->db->where('id_annonce', $id_annonce);
		$this->db->set('nb_signal', 'nb_signal+1', FALSE);
		$this->db->update('annonce');
	}

	/**
	 * Fonction permettant de supprimer une annonce
	 * 
	 * @param $id_annonce Id de l'annonce
	 */
	public function deleteAnnonce($id_annonce){

		$this->db->delete('annonce', array('id_annonce' => $id_annonce));
	}
}
