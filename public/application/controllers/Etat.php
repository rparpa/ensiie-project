<?php

/**
 * Created by PhpStorm.
 * User: standard
 * Date: 19/02/20
 * Time: 00:45
 */
class Etat extends CI_Controller
{

	function __construct() {
		parent::__construct();
		$this->load->model('Etat_model');
	}

    /**
     * Lists all Etat models.
     * @return mixed
     */

    public function index()
    {
		$etat=$this->etat->getAllEtat();
		print_r($etat);
    }
    /**
     * Displays a single Etat model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function view()
    {
		$id = $_GET['id'];
		$etat = $this->etat->getEtat($id);
		print_r($etat);
    }

    /**
     * Creates a new Etat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function create($etat)
    {
		if($this->etat->insert($etat))
		{
			die("Etat créé");
		}
		else
		{
			die("La création de l'état a échoué!");
		}
    }

    /**
     * Updates an existing Etat model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function update()
    {
		if($this->input->method()=="post")
		{
			if($this->etat->update($this->input->post(NULL, TRUE))) // returns all POST items with XSS filter
			{
				die("Etat mis-à-jour!");
			}
			else
			{
				die ("La mise-à-jour de l'état a échoué!");
			}
		}

		$model = $this->etat->getEtat($_GET['id']);
		$this->load->view('etat',['model'=>$model]);
    }

    /**
     * Deletes an existing Etat model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function delete()
    {
		$id = $_GET['id'];
		if($this->etat->delete($id))
		{
			die("Etat supprimé");
		}
		else
		{
			die ("L'état existe encore");
		}
    }
}
