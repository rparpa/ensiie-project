<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ami_model extends MY_Model
{
    public $_table       = 'ami';
    public $has_many     = array(
            '' => array('model' => '_model', 'primary_key' => '_id'),
    );
    public $belongs_to   = array(
            '' => array('model' => '_model', 'primary_key' => '_id'),
    );

   public function est_ami($user_id1, $user_id2, $accept=true) {
        $this->db->select('*');
        $this->db->where('demandeur_id', $user_id1);
        $this->db->where('receveur_id', $user_id2);
        $this->db->where('accept', $accept);
        $query   = $this->db->get('ami');
        $result1 = $query->result();

        $this->db->select('*');
        $this->db->where('demandeur_id', $user_id2);
        $this->db->where('receveur_id', $user_id1);
        $this->db->where('accept', $accept);
        $query   = $this->db->get('ami');
        $result2 = $query->result();

        $bool=false;
        if ($result1!=NULL || $result2!=NULL) {
            $bool=true;
        }
        return $bool;
    }

}
