<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Site extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    /*
    * Page d'accueil du site
    */
    public function index() {
        $data=array();
    	  $this->load->view('layout/header', $data);
        $user_id=$this->auth->check_is_user();
          if($this->auth->is_admin()){
            $data['users']=$this->user_model->get_all();
            $data['groupes']=$this->groupe_model->get_all();
            $data['events']=$this->event_model->get_all();
            $data['tags']=$this->tags_model->get_all();
            $data['page_title']='Gestion';
            $this->load->view('site/index_admin', $data);

          }
          else {
            $this->load->view('site/index', $data);
          }
        $this->load->view('layout/footer', $data);
    }
}
