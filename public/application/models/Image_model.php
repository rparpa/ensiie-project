<?php

class Image_model extends CI_Model
{

    /**
     * Fonction permettant d'inserer le lien d'une image dans la base de données
     * 
     * @param $id_annonce Id de l'annonce
     * @param $lien_image Lien de l'image string
     *
     */
    public function insert($id_annonce,$lien_image){
      $this->db->insert('image', array('id_annonce'=>$id_annonce,'url'=>$lien_image));
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

    /**
     * Fonction permettant de récupérer le lien de l'image
     * 
     * @param $id_annonce Id de l'annonce de l'image
     * @return 
     * lien de l'image de l'annonce sous forme d'un array
     */
    public function getImage($id_annonce){

      return $this->db->get_where('image',array('id_annonce' => $id_annonce))->result_array();
      
    }

}
