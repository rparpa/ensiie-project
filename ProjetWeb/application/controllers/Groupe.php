<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Groupe extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    /*
    * Page d'accueil du site
    */
    public function index() {

    }

    public function liste() {
      $user_id=$this->auth->check_is_user();

      $user_groupes=$this->user_groupe_model->get_many_by(array("user_id" => $user_id, 'est_valide' => true));
      $data["groupes"]=array();
      foreach($user_groupes as $user_groupe)
        $data["groupes"][]=$this->groupe_model->get($user_groupe->groupe_id);

      $data['page_title'] = "Liste de vos amis";
      $this->load->view('layout/header', $data);
      $this->load->view('groupe/liste', $data);
      $this->load->view('layout/footer', $data);

    }
}
