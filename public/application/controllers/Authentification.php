<?php

/**
 * Created by PhpStorm.
 * User: standard
 * Date: 26/02/20
 * Time: 22:47
 */
include_once (dirname(__FILE__) . "/Utilisateur.php");

class Authentification extends CI_Controller
{
    public function __construct() {

        parent::__construct();


        $this->load->helper('form');

        $this->load->helper('url');

        $this->load->library('form_validation');

        $this->load->library('session');

        $this->load->model('utilisateur');
    }

    public function index() {
        $this->load->view('login_form');
    }

    public function registration() {
        $this->form_validation->set_rules('nom', 'nom', 'trim|required');
        $this->form_validation->set_rules('prenom', 'prenom', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'trim|required');
        $this->form_validation->set_rules('promo', 'promo', 'trim|required');
        $this->form_validation->set_rules('telephone', 'telephone', 'trim|required');
        $this->form_validation->set_rules('pseudo', 'pseudo', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('inscription_view');
        }else
        {
            $data = array(
                'nom' => $this->input->post('nom'),
                'prenom' => $this->input->post('prenom'),
                'email' => $this->input->post('email'),
                'promo' => $this->input->post('promo'),
                'telephone' => $this->input->post('telephone'),
                'pseudo' => $this->input->post('pseudo'),
                'password' => $this->input->post('password'),
                'admin' => false,
            );
            if($this->utilisateur->insert($data))
            {
                $data['message_display'] = 'Inscription Réussie : Vous pouvez maintenant vous connecter à notre site';
                $this->load->view('login_form', $data);

            } else
            {
                $data['message_display'] = 'L\'utilisateur existe déjà !';
                $this->load->view('registration_form', $data);
            }

        }
    }

    public function login() {
        $this->form_validation->set_rules('email', 'email', 'trim|required');

        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            if(isset($this->session->userdata['logged_in'])){

                $this->load->view('utilisateur_view');
            } else {
                $this->load->view('login_form');
            }

        } else
        {
            $data = array(
                'mail' => $this->input->post('email'),
                'password' => $this->input->post('password')
            );
            if($this->utilisateur->login($data))
            {
                $mail = $this->input->post('email');

                $result = $this->utilisateur->userByEmail($mail);
                if ($result != false) {
                    $session_data = array(
                        'nom' => $result[0]['nom'],
                        'prenom' => $result[0]['prenom'],
                        'email' => $result[0]['email'],
                        'id' => $result[0]['id_user']
                    );

                    $this->session->set_userdata('logged_in', $session_data);
                    $this->load->view('utilisateur_view');
                }
            } else
            {
                $data = array('error_message' => 'Nom de compte/mot de passe incorrect');
                $this->load->view('login_form', $data);
            }
        }
    }

    public function logout()
    {
        $sess_array = array(
            'email' => '','prenom'=>'','nom'=>''
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        $data['message_display'] = 'Déconnexion réussie';
        $this->load->view('login_form', $data);
    }
    public function profil()
    {
        $this->load->view('utilisateur_view');
    }

}
