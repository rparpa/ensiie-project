<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tags_model extends MY_Model
{
    public $_table       = 'tags';
    public $has_many     = array(
            '' => array('model' => '_model', 'primary_key' => '_id'),
    );
    public $belongs_to   = array(
            '' => array('model' => '_model', 'primary_key' => '_id'),
    );

    /* Sauvegarde des users dans la partie front */

    public function save_user_tag($user_id = null,$tags_id = null)
    {

        $postdata['nom']      = $this->input->post('nom');
        $postdata['is_valide'] = 0;
        $postdata['soumetteur'] = 0;
        $userdata['id_user'] = 0;
        $userdata['id_tags'] = 0;

        if ($user_id != null)
        {
          $userdata['id_user'] = $user_id;
          if ($tags_id == null){
            $postdata['soumetteur'] = $user_id;
            $this->tags_model->insert($postdata);
          }
          else{
            $userdata['id_tags'] = $tags_id;
            $this->user_tags_model->insert($userdata);
          }
        }
        return $user_id;
    }

    public function save_event_tag($event_id = null,$tags_id = null)
    {
        $postdata['id_event'] = 0;
        $postdata['id_tags'] = 0;

        if ($event_id != null)
        {
          $postdata['id_event'] = $event_id;
          if (!$tags_id == null){
            $postdata['id_tags'] = $tags_id;
            $this->event_tags_model->insert($postdata);
          }
        }
        return $event_id;
    }


    public function supprimer($tags_id){
      $this->tags_model->delete($tags_id);
      $this->user_tags_model->delete($tags_id);
      $this->event_tags_model->delete($tags_id);
    }
    
}
