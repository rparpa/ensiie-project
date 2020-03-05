<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tags extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    /*
    *
    */
    public function index() {

    }


    public function ajouter(){
      $user_id=$this->auth->check_is_user();
      $tags=$this->input->post('select_tags');
      $tag_user=$this->user_tags_model->get_many_by(array("id_user" => $user_id));
      $data["tags"]=array();
      foreach($tag_user as $tag) {
        $data["tags"][]=$tag->id_tags;
      }
      foreach ($tags as $tag) {
        if(!in_array($tag,$data["tags"])){
          $this->user_tags_model->insert(array("id_tags" => $tag,"id_user" => $user_id));
          $this->session->set_flashdata('success_message', 'Tag(s) ajouté(s) !');
        }else{
          $this->session->set_flashdata('error_message', 'Tag(s) déjà présent(s) !');
        }
      }
      redirect("/user/profil");
    }


    public function supprimer_user($tag_id){
      $user_id=$this->auth->check_is_user();
      $this->user_tags_model->delete_by(array("id_tags" => $tag_id,"id_user" => $user_id));
      $this->session->set_flashdata('success_message', 'Tag supprimé !');
      redirect("/user/profil");
    }

    public function supprimer($tag_id){
      $this->tags_model->delete_by(array("id" => $tag_id));
      $this->session->set_flashdata('success_message', 'Tag supprimé !');
      redirect("/site");
    }

    public function soumettre(){
      $user_id=$this->auth->check_is_user();
      $tag=$this->input->post('s');
      $this->tags_model->insert(array("nom" => $tag,"est_valide" => 0, "soumetteur" => $user_id));
      $this->session->set_flashdata('success_message', 'Proposition envoyée !');
      redirect("/user/profil");
    }

    public function valider($tag_id){
      $tag = $this->tags_model->get_by(array("id"=>$tag_id));
      $tag->est_valide = 1;
      $this->tags_model->update($tag_id, $tag);
      $this->session->set_flashdata('success_message', "Tag validé.");
      redirect("/site");
    }

    public function modifier($tag_id){
      $tag = $this->tags_model->get_by(array("id"=>$tag_id));
      $tag->est_valide = 1;
      $tag_text=$this->input->post('s');
      $tag->nom=$tag_text;
      $this->tags_model->update($tag_id, $tag);
      $this->session->set_flashdata('success_message', "Tag modifié et validé.");
      redirect("/site");
    }

}
