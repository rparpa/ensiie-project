<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller
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

    public function connexion() {
      if ($this->auth->is_user() == false)
      {
          $this->form_validation->set_rules('login', 'Login/Email', 'required|trim');
          $this->form_validation->set_rules('password', '"Mot de passe"', 'required|trim');

          if ($this->form_validation->run() !== FALSE)
          {
              $password = hash('sha256', $this->input->post('password'));
              $user=$user = $this->user_model->get_by(array('login' => $this->input->post('login'), 'password' => $password));
              if ($user == NULL) {
                $user=$user = $this->user_model->get_by(array('email' => $this->input->post('login'), 'password' => $password));
              }
              if ($user !== NULL)
              {
                  if ($user->email_valide == false)
                  {
                      $this->session->set_flashdata('error_message', "Votre compte n'est pas encore validé, veuillez vérifier vos emails");
                      redirect('user/connexion');
                  }
                  $this->session->set_userdata('user_id', $user->id);
                  if ($this->session->from_user != '')
                      redirect($this->session->from_user);
                  else
                      redirect('site');
              }
              else
              {
                  $this->session->set_flashdata('error_message', "Mauvais e-mail/login ou mot de passe");
              }
          }
          $data['page_title'] = "Connexion";
          $this->load->view('layout/header', $data);
          $this->load->view('user/connexion', $data);
          $this->load->view('layout/footer', $data);
      }
    }

    /*
    * Deconnexion de l'user
    */
    public function deconnexion()
    {
        if ($this->auth->is_user())
        {
            $this->session->unset_userdata('user_id');
            $this->session->unset_userdata('from_user');
        }
        redirect('user/connexion');
    }

    /*
    * Inscription d'un utilisateur au site
    */
    public function inscription() {
      if ($this->user_model->is_valid_form() !== FALSE) {

          $id           = $this->user_model->save();
          $data['user'] = $this->user_model->get($id);
          /* Message envoyé par mail avec le lien pour valider le compte */
          $this->session->set_flashdata('success_password_forgotten', 'Un e-mail a été envoyé pour changer votre mot de passe !');
          $this->email->from('no_reply@planing.com', "L'équipe Planning");

          $this->email->to('av77190@gmail.com');
          $this->email->subject('Validation de votre compte');
          $message      = $this->load->view('mail/inscription', $data, true);
          $this->email->message($message);
          if ($this->email->send())
          {
              $this->session->set_flashdata('success_message', "Enregsistrement effectué : un e-mail vous a été envoyé pour valider votre compte");
          }
          redirect('user/connexion');
      }
      $data['page_title'] = "Inscription";
      $this->load->view('layout/header', $data);
      $this->load->view('user/form', $data);
      $this->load->view('layout/footer', $data);
    }

    /* Validation de l'email du user correspondant au code en param en cliquant sur ce lien */

    public function valider_compte($code)
    {
        $user               = $this->user_model->get_by(array("hash" => $code));
        $user->email_valide = true;
        $user->hash         = null;
        $this->user_model->update($user->id, $user);
        $this->session->set_flashdata('success_message', "Validation de votre compte");
        redirect("user/connexion");
    }

    /*
    * Profil de l'utilisateur
    */
    public function profil($user_id = null) {
      $user_id2            = $this->auth->check_is_user();

      if ($user_id==$user_id2 || $user_id==null) {
        $data["my_profil"]=true;
        $data["user"] = $this->user_model->get($user_id2);
        $data['page_title'] = "Votre profil";
        $data["est_ami"]=true;

        $data["id_tags"]=array();
        $id_tags=$this->user_tags_model->get_many_by(array("id_user" => $user_id2));
        foreach($id_tags as $tag) {
          $data["id_tags"][]=$this->tags_model->get($tag->id_tags);
        }
        $data["tags"]=$this->tags_model->get_many_by(array("est_valide" => 1));

      } else {
        $data["my_profil"]=false;
        $data["user"] = $this->user_model->get($user_id);
        $data['page_title'] = "Profil de ".$data["user"]->login;
        $data["est_ami"]=$this->ami_model->est_ami($user_id, $user_id2);
        $data["est_demande"]=$this->ami_model->est_ami($user_id, $user_id2, false);
      }
      $this->load->view('layout/header', $data);
      $this->load->view('user/profil', $data);
      $this->load->view('layout/footer', $data);
    }

    /*
    * Edition du prof=il de l'user
    */
    public function modifier($user_id=false) {
        if(!$this->auth->is_admin()){
          $user_id      = $this->auth->check_is_user();
        }
        $data['user'] = $this->user_model->get($user_id);

        if ($this->user_model->is_valid_form($user_id) !== FALSE)
        {
            $this->user_model->save($user_id);
            $this->session->set_flashdata('success_message', 'Modification effectuée');
            if($this->auth->is_admin()){
              redirect('site/');
            }else{
              redirect('user/profil');
            }
        }
        $data['page_title'] = "Edition du profil";
        $this->load->view('layout/header', $data);
        $this->load->view('user/form', $data);
        $this->load->view('layout/footer', $data);
    }

    /*
    * recherche d'amis
    */
    public function rechercher() {
      $user_id=$this->auth->check_is_user();
      $users=$this->user_model->rechercher();
      $data["users"]=array();
      if ($users!=FALSE) {
        foreach ($users as $user) {
            if ($user_id==$user->id) {
              $user->{"est_ami"}=true;
            } else {
              $ami1=$this->ami_model->est_ami($user_id, $user->id);
              $ami2=$this->ami_model->est_ami($user_id, $user->id, false);
              if ($ami1 || $ami2)
                $user->{"est_ami"}=true;
            }
            $data["users"][]=$user;
        }
      } else {
        $this->session->set_flashdata('error_message', 'Recherche vide !');
        redirect('ami/liste');
      }
      $data['page_title'] = "Résultat de la recherche";
      $this->load->view('layout/header', $data);
      $this->load->view('user/rechercher', $data);
      $this->load->view('layout/footer', $data);
    }
}
