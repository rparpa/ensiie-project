<?php

class Utilisateur_model extends CI_Model {

    //Recupere l'ensemble des trigrammes
    public function getAllUser(){

      return $this->db->select('*')
               ->from('user')
               ->get()
               ->result_array();
    }
}