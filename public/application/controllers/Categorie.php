<?php

/**
 * Created by PhpStorm.
 * User: standard
 * Date: 19/02/20
 * Time: 00:09
 */
class Categorie extends CI_Controller
{
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

    public function index()
    {
		$categ=$this->categorie->getAllCategorie();
		print_r($categ);
    }
    /**
     * Displays a single Categorie model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function view()
    {
		$id = $_GET['id'];
		$categ = $this->categorie->getCategorie($id);
		print_r($categ);
    }

    /**
     * Creates a new Categorie model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function ajouter_categorie()
	{
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_rules('categ', 'categ', 'required');

		if ($this->input->post('categ')) {
			if ($this->form_validation->run() == TRUE) {

				$this->categorie->insert($this->input->post('categ'));
				redirect('Categorie/getAllCategories');
				$this->session->set_flashdata('message', 'Catégorie créée avec succès');

			} else {
				$this->session->set_flashdata('error', 'Catégorie non ajoutée, veuillez réessayer');
				$this->load->view('elements/header', $this->data);
				$this->load->view('ajout_categorie_view', $this->data);
				$this->load->view('elements/footer');
			}
		} else {
			$this->load->view('elements/header', $this->data);
			$this->load->view('ajout_categorie_view', $this->data);
			$this->load->view('elements/footer');
		}
	}

    /**
     * Updates an existing Categorie model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

	public function update()
	{
		if($this->input->method()=="post")
		{
			if($this->categorie->update($this->input->post(NULL, TRUE))) // returns all POST items with XSS filter
			{
				die("Catégorie mise-à-jour!");
			}
			else
			{
				die ("La mise-à-jour de la catégorie a échoué!");
			}
		}

		$model = $this->categorie->getCategorie($_GET['id']);
		$this->load->view('categorie',['model'=>$model]);
	}

    /**
     * Deletes an existing Categorie model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function delete($id_categ)
    {
		$this->categorie->delete($id_categ);
		redirect('Categorie/getAllCategories');
    }

	public function getAllCategories()
	{
		$categories=$this->categorie->getAllCategorie();
		$this->load->view('elements/header',$this->data);
		$this->load->view('categorieTable',['categories'=>$categories]);
		$this->load->view('elements/footer');
	}
}
