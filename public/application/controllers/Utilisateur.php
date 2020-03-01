<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilisateur extends CI_Controller
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
        if(isset($this->session->userdata['logged_in'])){

            $annonce=$infos=$this->annonce->getAnnonceByUser($this->session->userdata('logged_in')['id_user']);
            $infos=$this->utilisateur->getUser($this->session->userdata('logged_in')['id_user']);
            $promo=$infos[0]['promo'];
            $telephone=$infos[0]['telephone'];
            $pseudo=$infos[0]['pseudo'];
            $data = ["nom"=>$infos[0]['nom'],"prenom"=>$infos[0]['prenom'],"nbAnnonces" => $this->annonce->totalAnnonces(),"promo"=>$promo,"pseudo"=>$pseudo,"telephone"=>$telephone,"annonces"=>$annonce];
            $this->load->view('elements/header',$this->data);
            $this->load->view('profil',$data);
            $this->load->view('elements/footer');
        }
    }
}
