<?php

/**
 * Created by PhpStorm.
 * User: standard
 * Date: 19/02/20
 * Time: 00:09
 */
class Categorie extends CI_Controller
{

	function __construct() {
		parent::__construct();
		$this->load->model('Categorie_model');
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

    public function create($categ)
    {
		if($this->categorie->insert($categ))
		{
			die("Categorie créée");
		}
		else
		{
			die("La création de la catégorie a échoué!");
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

    public function delete()
    {
		$id = $_GET['id'];
		if($this->categorie->delete($id))
		{
			die("Catégorie supprimée");
		}
		else
		{
			die ("La catégorie existe encore");
		}
    }


}
