<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Event extends CI_Controller
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
    * Liste des event de l'user connecté
    */
    public function main($event = null) {
      $user_id=$this->auth->check_is_user();
      $data["user"]=$this->user_model->get($user_id);
      
      /* On récupère les événements dont l'utilisateur est l'organisateur */
      $events1=$this->event_model->get_many_by(array("organisateur_id" => $user_id));
      $data["events1"]=array();
      $data["id_tags"]=array();
      foreach($events1 as $event) {
        $data["events1"][]=$this->event_model->get($event->id);

        $data["id_tags"][$event->id]=array();
        $id_tags=$this->event_tags_model->get_many_by(array("id_event" => $event->id));
        foreach($id_tags as $tag) {
          $data["id_tags"][$event->id][]=$this->tags_model->get($tag->id_tags);
        }
      }

      /* On récupère les événements auxquels l'utilisateur participe (groupe) */
      $user_event = $this->user_event_model->get_many_by(array("id_user" => $user_id));
      $data["events2"]=array();
      foreach ($user_event as $ev) {
        $data["events2"][]=$this->event_model->get($ev->id_event);

        $data["id_tags"][$ev->id_event]=array();
        $id_tags=$this->event_tags_model->get_many_by(array("id_event" => $ev->id_event));
        foreach($id_tags as $tag) {
          $data["id_tags"][$ev->id_event][]=$this->tags_model->get($tag->id_tags);
        }
      }

      $data['active'] = "list";
      /* Vérification du formulaire et sauvegarde */
      if ($this->event_model->is_valid_form() !== FALSE) {

        $response = $this->event_model->save($this->id, $user_id);
        // Erreur lors de la sauvegarde
        if (is_array($response)){
        	redirect('event/main/?e='.$response['res']);
        }
        // Tout s'est bien passé
        else {
        	redirect('event/main?f=1');
        }

      } else {
      	if (!isset($_GET["f"]) || $_GET["f"] != 1){
      		$data['active'] = "form";
	        if (isset($_GET["e"])){
	      		$data['msg'] = $this->errors($_GET["e"]);
	      	}
      	}
      }

      $data["tags"]=$this->tags_model->get_all(array("est_valide" => 1));
      $data['page_title'] = "&Eacute;v&eacute;nements";
      $this->load->view('layout/header', $data);
      $this->load->view('event/main', $data);
      $this->load->view('layout/footer', $data);
    }


    /*
    * recherche d'event
    */
    public function rechercher($opt = Null) {
      $user_id=$this->auth->check_is_user();
      if ($opt == Null)
        $events=$this->event_model->rechercher($user_id);
      elseif ($opt = "quick")
        $events=$this->event_model->rechercher_rapide($user_id);

      $data["user"]=$this->user_model->get($user_id);

      /* On récupère les événements dont l'utilisateur est l'organisateur */
      $events1=$this->event_model->get_many_by(array("organisateur_id" => $user_id));
      $data["events1"]=array();
      $data["id_tags"]=array();
      foreach($events1 as $event) {
        $data["events1"][]=$this->event_model->get($event->id);

        $data["id_tags"][$event->id]=array();
        $id_tags=$this->event_tags_model->get_many_by(array("id_event" => $event->id));
        foreach($id_tags as $tag) {
          $data["id_tags"][$event->id][]=$this->tags_model->get($tag->id_tags);
        }
      }

      /* On récupère les événements auxquels l'utilisateur participe (groupe) */
      $user_event = $this->user_event_model->get_many_by(array("id_user" => $user_id));
      $data["events2"]=array();
      foreach ($user_event as $ev) {
        $data["events2"][]=$this->event_model->get($ev->id_event);

        $data["id_tags"][$ev->id_event]=array();
        $id_tags=$this->event_tags_model->get_many_by(array("id_event" => $ev->id_event));
        foreach($id_tags as $tag) {
          $data["id_tags"][$ev->id_event][]=$this->tags_model->get($tag->id_tags);
        }
      }

      $data['active'] = "search";
      /* Vérification du formulaire et sauvegarde */
      if ($this->event_model->is_valid_form() !== FALSE) {

        $response = $this->event_model->save($this->id, $user_id);
        // Erreur lors de la sauvegarde
        if (is_array($response)){
          redirect('event/main/?e='.$response['res']);
        }
        // Tout s'est bien passé
        else {
          redirect('event/main?f=1');
        }

      } else {
        if (!isset($_GET["f"]) || $_GET["f"] != 1){
          $data['active'] = "search";
          if (isset($_GET["e"])){
            $data['msg'] = $this->errors($_GET["e"]);
          }
        }
      }

      $data["tags"]=$this->tags_model->get_all(array("est_valide" => 1));
      
      if (isset($events) && $events != false)
        $data['events_found']=$events;

      $data['page_title'] = "Résultat de la recherche";
      $this->load->view('layout/header', $data);
      $this->load->view('event/main', $data);
      $this->load->view('layout/footer', $data);
    }

    public function ajouter($event_id){
      $user_id=$this->auth->check_is_user();
      $user_event=$this->user_event_model->get_many_by(array("id_user" => $user_id));

      $data["ev"]=array();
      foreach($user_event as $ev) {
        $data["ev"][]=$ev->id_event;
      }
    
      if(!in_array($event_id, $data["ev"])){
        $this->user_event_model->insert(array("id_event" => $event_id,"id_user" => $user_id));
        $this->session->set_flashdata('success_message', 'Evénement ajouté !');
      }else{
        $this->session->set_flashdata('error_message', 'Evénement déjà présent !');
      }
      
      redirect("/event/rechercher");
    }

    /*
    * Edition d'un event
    */
    public function edit($event_id = null) {
      if ($event_id == null) redirect('event/main?f=1');

      $user_id       = $this->auth->check_is_user();
      $data["event"] = $this->event_model->get($event_id);

      /* Vérification du formulaire et sauvegarde */
      if ($this->event_model->is_valid_form($event_id, $user_id) !== FALSE) {
        $response = $this->event_model->save($event_id, $user_id);
        // Erreur lors de la sauvegarde
        if (is_array($response)){
        	redirect('event/edit/'.$event_id.'?e='.$response['res']);
        }
        // Tout s'est bien passé
        else {
        	redirect('event/main?f=1');
        }
      } else {
      	if (isset($_GET["e"])){
      		$data['msg'] = $this->errors($_GET["e"]);
      	}
      }

      $data['page_title'] = "Modification de l'&eacute;v&eacute;nements - ".$data["event"]->titre;
      $data["id_tags"]=array();
      $id_tags=$this->event_tags_model->get_many_by(array("id_event" => $event_id));
      foreach($id_tags as $tag) {
        $data["id_tags"][]=$this->tags_model->get($tag->id_tags);
      }
      $data["tags"]=$this->tags_model->get_all(array("est_valide" => 1));

      $this->load->view('layout/header', $data);
      $this->load->view('event/edit', $data);
      $this->load->view('layout/footer', $data);
    }

    /*
    * Suppression d'un événement
    */
    public function delete($event_id) {
      $user_id = $this->auth->check_is_user();
      $organise = $this->event_model->count_by(array("id" => $event_id, "organisateur_id" => $user_id));

      var_dump($event_id);
      var_dump($organise);

      // L'utilisateur courant est l'organisateur de l'événement
      if ($organise == 1){
      	$event = $this->event_model->get($event_id);
      	
      	if (isset($event->img_url) && file_exists($event->img_url)){
      		unlink($event->img_url);
      	} 
        $this->event_model->delete($event_id);
      }
      // L'utilisateur participe à l'événement et on doit retirer ce dernier de sa liste
      else {
        $this->user_event_model->delete_by(array("id_event" => $event_id,"id_user" => $user_id));
        $this->session->set_flashdata('success_message', 'Evénement retiré !');
      }

      redirect('event/main?f=1');
    }

    private function errors($type){
    	$msg = array();
    	$offset = 0;
    	$tic = [8, 4, 2, 1];
    	$tic_msg = ["",
    				"Erreur - Date de fin doit être ultérieur à la date de début de l'événement",
    				"Erreur lors de l'upload de l'image pour la bannière de l'événement",
    				"Le champ \"Bannière de l'événement\" est invalide, le fichier choisi n'est pas une image."];

	    for ($i=0; $i < count($tic); $i++) { 
	    	if ($type + $tic[$i] <= 0){
	    		$msg[$offset] = $tic_msg[$i];
	    		$type = $type + $tic[$i];
	    		$offset++;
	    	}
	    }

    	return $msg;
    }
}
