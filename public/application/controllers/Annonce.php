<?php

class Annonce extends CI_Controller {

	private $data=array();

	function __construct() {
		parent::__construct();
	}

	function index()
	{
		$this->liste_annonces();
	}

	public function liste_annonces(){

		$min = $this->annonce->minPrice();
		$max = $this->annonce->maxPrice();
		$annonces = $this->annonce->getAllAnnonce();
		$this->data = array('annonces'=>$annonces, 'min'=>$min, 'max'=>$max);

		$this->load->view('elements/header');
		$this->load->view('annonces_view', $this->data);
		//$this->load->view('ajout_annonce_view');
		$this->load->view('elements/footer');
	}

	public function filter(){

		$minPrice = $this->input->post('min');
		$maxPrice = $this->input->post('max');
		if($minPrice<=$maxPrice){
			$annonces = $this->annonce->getFilteredAnnonce($minPrice, $maxPrice);
			$this->data = array('annonces'=>$annonces, 'min'=>$minPrice, 'max'=>$maxPrice);

			$this->load->view('elements/header');
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
				$this->load->view('elements/header');
				$this->load->view('ajout_annonce_view',$this->data);
				$this->load->view('elements/footer');
			}
		}
		else{
			$this->load->view('elements/header');
			$this->load->view('ajout_annonce_view',$this->data);
			$this->load->view('elements/footer');			
		}

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

	function update(){
		$id = $_GET['id'];
		$current_data = $this->annonce_model->getAnnonce($id);
		$this->load->view('annonceUpdate', $current_data);
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		//Validating Name Field
		$this->form_validation->set_rules('titre', 'Titre', 'required|min_length[5]|max_length[25]');

		//Validating Email Field
		$this->form_validation->set_rules('descri', 'Description', 'required|min_length[10]');

		//Validating Mobile no. Field
		$this->form_validation->set_rules('prix', 'prix', 'required|numeric');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('annonceUpdate', $current_data);
			//add js error pop-up
		}
		else
		{
			//Setting values for table columns
			$data = array(
				'id_annonce' => $id,
				'titre' => $this->input->post('titre'),
				'description' => $this->input->post('descri'),
				'prix' => $this->input->post('prix')
			);

			//Transfering data to Model
			$this->annonce_model->update($data);
			$data['message'] = 'Annonce créée avec succès';

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