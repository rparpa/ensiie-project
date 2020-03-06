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

    /**
     * Fonction permettant de supprimer une image d'une annonce dans la base de données
     * 
     * @param $id_annonce Id de l'annonce
     * 
     */
    public function delete($id_annonce){
      $this->db->delete('image', array('id_annonce' => $id_annonce));

    }

    /**
     * Fonction permettant de mettre une image dans la base de données
     * 
     * @param $id_annonce Id de l'annonce
     * 
     */
    public function update($id_annonce,$image){
      $this->db->where('id_annonce', $id_annonce);
      $this->db->update('image',array('url'=>$image));
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
