<?php

class annonce extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('annonce_model');
	}

	function index()
	{
		$this->load->view('annonces_view');
	}
	function create()
	{
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		//Validating Name Field
		$this->form_validation->set_rules('titre', 'Titre', 'required|min_length[5]|max_length[25]');

		//Validating Email Field
		$this->form_validation->set_rules('descri', 'Description', 'required|min_length[10]');

		//Validating Mobile no. Field
		$this->form_validation->set_rules('prix', 'prix', 'required|numeric');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('annonceCreate');
		}
		else
		{
			$format = "%Y-%M-%d %H:%i";
			$date = "echo @mdate($format)";
			//Setting values for table columns
			$data = array(
				'titre' => $this->input->post('titre'),
				'description' => $this->input->post('descri'),
				'prix' => $this->input->post('prix'),
				'vendu' => false,
				'nb_signal' => 0,
				'date_publication' => $date
			);

			//Transfering data to Model
			$this->annonce_model->insert($data);

			//Loading View
			$this->load->view('annonces_view');
		}
	}

	function delete()
	{
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

	function update()
	{
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

}
?>
