<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ami extends CI_Controller
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

    /*
    * Demander en ami un autre user
    */
    public function ajouter($user_id) {
      $data["demandeur_id"]=$this->auth->check_is_user();
      $data["receveur_id"]=$user_id;
      $data["accept"]=false;
      $data["created_at"]=date('Y-m-d H:i');
      $this->ami_model->insert($data);
      $this->session->set_flashdata('success_message', 'Demande en ami envoyée !');
      redirect("user/profil/".$user_id);
    }

    /*
    * Liste des amis de l'user connecté
    */
    public function liste() {
      $user_id=$this->auth->check_is_user();

      //liste des demandes d'ami
      $demandes=$this->ami_model->get_many_by(array("receveur_id" => $user_id, 'accept' => false));
      $data["demandes_ami"]=array();
      foreach($demandes as $demande) {
        $data["demandes_ami"][]=$this->user_model->get($demande->demandeur_id);
      }

      $amis=$this->ami_model->get_many_by(array("receveur_id" => $user_id, 'accept' => true));
      $amis2=$this->ami_model->get_many_by(array("demandeur_id" => $user_id, 'accept' => true));
      $data["amis"]=array();
      foreach($amis as $ami) {
        $data["amis"][]=$this->user_model->get($ami->demandeur_id);
      }
      foreach($amis2 as $ami) {
        $data["amis"][]=$this->user_model->get($ami->receveur_id);
      }

      $data['page_title'] = "Liste de vos amis";
      $this->load->view('layout/header', $data);
      $this->load->view('ami/liste', $data);
      $this->load->view('layout/footer', $data);
    }

    /*
    * Acceptation/Refus de l'invitation d'un autre user
    */
    public function reponse($user_id, $accept) {
      $user_id2=$this->auth->check_is_user();
      $ami=$this->ami_model->get_by(array("demandeur_id" => $user_id, "receveur_id" => $user_id2));
      if ($accept) {
        $ami->accept=true;
        $ami->updated_at=date("Y-m-d H:i");
        $this->ami_model->update($ami->id, $ami);
        $this->session->set_flashdata('success_message', "Ajout à votre liste d'amis");

      } else {
        $this->ami_model->delete_by(array('id' => $ami->id));
        $this->session->set_flashdata('success_message', "Refus de cet ami !");
      }
      redirect("ami/liste");
    }

}
