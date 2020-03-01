<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilisateur extends CI_Controller
{
    /**
     * Lists all Utilisateur models.
     * @return mixed
     */
    function __construct() {
        parent::__construct();
    }

    public function index()
	{
        
	}
    /**
     * Displays a single Utilisateur model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function view($id)
    {

    }

    /**
     * Creates a new Utilisateur model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function create()
    {

    }

    /**
     * Updates an existing Utilisateur model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function update($id)
    {

    }

    /**
     * Deletes an existing Utilisateur model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function delete($id)
    {

    }
    
    public function login($data)
    {
        
    }
    public function profil()
    {
        if(isset($this->session->userdata['logged_in']))
        {
            $annonce=$infos=$this->annonce->getAnnonceByUser($this->session->userdata('logged_in')['id']);
            $infos=$this->utilisateur->getUser($this->session->userdata('logged_in')['id']);
            $promo=$infos[0]['promo'];
            $telephone=$infos[0]['telephone'];
            $pseudo=$infos[0]['pseudo'];
            $data = ["nbAnnonces" => $this->annonce->totalAnnonces(),"promo"=>$promo,"pseudo"=>$pseudo,"telephone"=>$telephone,"annonces"=>$annonce];
            $this->load->view('elements/header');
            $this->load->view('profil',$data);
            $this->load->view('elements/footer');
        }
    }
}
