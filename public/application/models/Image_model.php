<?php

class Image_model extends CI_Model
{
    public $idImage;
    public $url;
    
    public function insert()
    {

    }

    public function delete()
    {

    }

    public function update()
    {

    }

    public function getAllImage()
    {


    }
    public function getImage($id_annonce)
    {
		return $this->db->get_where('image',array('id_annonce' => $id_annonce))->result_array();
    }

}
