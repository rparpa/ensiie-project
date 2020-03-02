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
     * Updates an existing Utilisateur model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function update()
    {
        if($this->input->post())
        {
            unset($_POST['submit']);
            if($this->utilisateur->update($this->input->post()))
            {
                //echo "<script>alert(\"Modification réussie\")</script>";
                redirect('utilisateur/update?id='.$this->input->post('id_user'));
            } else
            {
                //echo "<script>alert(\"modification failed\")</script>";
                redirect('utilisateur/update?id='.$this->input->post('id_user'));
            }
        } else
        if(isset($_GET['id']))
        {
            $user=$this->utilisateur->getUser($_GET['id']);
            $this->load->view('elements/header',$this->data);
            $this->load->view('update_view',['user'=>$user]);
            $this->load->view('elements/footer');
        }
    }

    /**
     * Deletes an existing Utilisateur model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function delete($id_user)
    {
		$this->utilisateur->delete($id_user);
		redirect('Annonce/liste_annonces');
    }
    
    public function AllUsers()
    {
        $users=$this->utilisateur->getAllUser();
        //print_r($users);
        //die();
        $this->load->view('elements/header',$this->data);
        $this->load->view('userTable',['users'=>$users]);
        $this->load->view('elements/footer');
    }
    public function profil()
    {
        if(isset($this->session->userdata['logged_in'])){

            $annonce=$infos=$this->annonce->getAnnonceByUser($this->session->userdata('logged_in')['id_user']);
			$annonces_sig=$this->annonce->get_annonces_signalees();
			$delusers=$this->utilisateur->getAllUser();
            $infos=$this->utilisateur->getUser($this->session->userdata('logged_in')['id_user']);
            $promo=$infos[0]['promo'];
            $telephone=$infos[0]['telephone'];
            $pseudo=$infos[0]['pseudo'];
			$admin=$infos[0]['admin'];
			$data = ["nom"=>$infos[0]['nom'],"prenom"=>$infos[0]['prenom'],"nbAnnonces" => $this->annonce->totalAnnonces(),"promo"=>$promo,"pseudo"=>$pseudo,"telephone"=>$telephone,"annonces"=>$annonce, "admin"=>$admin, "annonces_sig"=>$annonces_sig, "delusers"=>$delusers];
            $this->load->view('elements/header',$this->data);
            $this->load->view('profil',$data);
            $this->load->view('elements/footer');
        }
    }
}
