<?php

class Annonce extends CI_Controller {

	private $data=array();

	function __construct() {
		parent::__construct();

		if ($this->session->userdata('logged_in') == null && $this->uri->ruri_string() != 'authentificiation/login') {
            redirect('authentification/login');
        } elseif ($this->uri->ruri_string() != 'authentificiation/login') {
			$this->data+=array('id_user' => $this->session->userdata('logged_in')['id_user']);
			$this->data+=array('nom_user' => $this->session->userdata('logged_in')['nom']);
			$this->data+=array('prenom_user' => $this->session->userdata('logged_in')['prenom']);
			$this->data+=array('email_user' => $this->session->userdata('logged_in')['email']);
			$this->data+=array('tel_user' => $this->session->userdata('logged_in')['telephone']);
			$this->data+=array('promo' => $this->session->userdata('logged_in')['promo']);
			$this->data+=array('nb_signal_user' => $this->session->userdata('logged_in')['nb_signal_user']);
			$this->data+=array('admin_user' => $this->session->userdata('logged_in')['admin']);
		}
	}

	function index(){
		$this->liste_annonces();
	}

	public function liste_annonces(){
		$min = $this->annonce->minPrice();
		$max = $this->annonce->maxPrice();
		$annonces = $this->annonce->getAllAnnonce();
		$this->data += array('annonces'=>$annonces, 'min'=>$min, 'max'=>$max);

		$this->load->view('elements/header',$this->data);
		$this->load->view('annonces_view', $this->data);
		$this->load->view('elements/footer');
	}

	/**
	 * Fonction permettant d'afficher les annonces de l'utilisateur connecté
	 */
	public function mes_annonces(){

		$min = $this->annonce->minPrice();
		$max = $this->annonce->maxPrice();
		$this->data += array('min'=>$min, 'max'=>$max);
		$mes_annonces=$this->annonce->getUserAnnonce($this->data['id_user']);
		$this->data+=array('mes_annonces'=>$mes_annonces);
		$this->load->view('elements/header',$this->data);
		$this->load->view('mes_annonces_view',$this->data);
		$this->load->view('elements/footer');
	}

	public function filter(){

		$minPrice = $this->input->post('min');
		$maxPrice = $this->input->post('max');
		if($minPrice<=$maxPrice){
			$annonces = $this->annonce->getFilteredAnnonce($minPrice, $maxPrice);
			$this->data += array('annonces'=>$annonces, 'min'=>$minPrice, 'max'=>$maxPrice);

			$this->load->view('elements/header',$this->data);
			$this->load->view('annonces_view', $this->data);
			$this->load->view('elements/footer');
		}
		else {?>.<script type=text/javascript>alert("Le prix minimum doit être inférieur au prix maximum!");</script>.<?php
			$this->liste_annonces();
		}
	}

	public function ajouter_annonce(){
  
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_rules('titre', 'Titre', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('prix', 'Prix', 'required|numeric');

		$etats=array_column($this->etat->getAllEtat(), 'etat');
		$this->data+=array("etats"=>$etats);

		if($this->input->post('titre')){
			if ($this->form_validation->run() == TRUE) {

				//TODO : mettre l'id de l'utilisation
				$this->annonce->insertAnnonce(
								2,
								$this->input->post('titre'),
								$this->input->post('description'),
								$this->input->post('prix'),
								$this->input->post('etat'));

				redirect('Annonce/liste_annonces');
				$this->session->set_flashdata('message', 'Annonce ajoutée');
	
			}else{
				$this->session->set_flashdata('error', 'Annonce non ajoutée, veuillez réessayer');
				$this->load->view('elements/header',$this->data);
				$this->load->view('gestion_annonce_view',$this->data);
				$this->load->view('elements/footer');
			}
		}
		else{
			$this->load->view('elements/header',$this->data);
			$this->load->view('gestion_annonce_view',$this->data);
			$this->load->view('elements/footer');			
		}

	}

	/**
	 * Fonction permettant de modifier une annonce
	 * 
	 * @param $id_annonce Id de l'annonce à modifier
	 */
	public function modifier_annonce($id_annonce){

		$this->form_validation->set_error_delimiters('<p class="form_erreur">', '</p>');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_rules('titre', 'Titre', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('prix', 'Prix', 'required|numeric');

		$etats=array_column($this->etat->getAllEtat(), 'etat');
		$etats=array_combine(range(1, count($etats)), array_values($etats));
		$this->data+=array("etats"=>$etats);

		if($this->form_validation->run()){
			
			$this->annonce->updateAnnonce($id_annonce,
				$this->data['id_user'],
				$this->input->post('titre'),
				$this->input->post('description'),
				$this->input->post('prix'),
				$this->input->post('etat'));

			redirect('Annonce/liste_annonces');
			$this->session->set_flashdata('message', 'Annonce modifiée');		  
		}
		else{
		 $annonce=$this->annonce->getAnnonce($id_annonce);
		 $this->data+=array("annonce_modif"=>$annonce[0]);
		 $this->load->view("elements/header",$this->data);
		 $this->load->view('gestion_annonce_view',$this->data);
		 $this->load->view("elements/footer");
	   }
 
	 }

	/**
	 * Fonction permettant d'afficher le détail d'une annonce
	 * 
	 * @param $id Id de l'annonce
	 */
	public function details_annonce($id){

		$annonce = $this->annonce->getAnnonce($id);
		$image = $this->image->getImage($id);
		$user_annonce = $this->utilisateur->getUser($annonce[0]['id_user']);
		$etat_annonce = $this->etat->getEtat($annonce[0]['id_etat']);

		$this->data+=array('details_annonce'=>$annonce);
		$this->data+=array('image'=>$image);
		$this->data+=array('user_annonce'=>$user_annonce);
		$this->data+=array('etat_annonce'=>$etat_annonce);

		$this->load->view('elements/header',$this->data);
		$this->load->view('details_annonce_view.php',$this->data);
		$this->load->view('elements/footer');	
	}

	function delete(){
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('annonces_view');
			//display js error pop-up
		}
		else
		{
			$id = $_GET['id'];

			//Transfering data to Model
			$this->annonce_model->delete($id);
			$data['message'] = 'Annonce supprimée avec succès';

			//Loading View
			$this->load->view('annonces_view');
		}
	}

	// File upload
	public function fileUpload(){

		if(!empty($_FILES['file']['name'])){
	 
		  // Set preference
		  $config['upload_path'] = 'assets/images/'; 
		  $config['allowed_types'] = 'jpg|jpeg|png|gif';
		  //$config['max_size'] = '2024'; // max_size in kb
		  $config['file_name'] = $_FILES['file']['name'];
		  $this->data+=array('files'=>$_FILES['file']['name']);
	 
		  //Load upload library
		  $this->load->library('upload',$config); 
	 
		  // File upload
		  if($this->upload->do_upload('file')){
			// Get data about the file
			$uploadData = $this->upload->data();
			$this->data+=array('data_img'=>$uploadData);
		  }
		  print_r($this->data);
		}
	}

}
?>
