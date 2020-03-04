<?php

class Categorie_model extends CI_Model
{
    public $idCategorie;
    public $nom;

	public function insert($categ_titre)
	{
		$data=array('categorie'=>$categ_titre);
		$this->db->insert('categorie', $data);
	}

    public function delete($id)
    {
		return $this->db->delete('categorie',array('id_categorie'=>$id));
    }

	public function updateCategorie($id_categ, $value)
	{
		$data = array('categorie' => $value);
		$this->db->where('id_categorie', $id_categ);
		$this->db->update('categorie',$data);
	}

    public function getAllCategorie()
    {
		$this->db->select('*');
		$this->db->from('categorie');
		$this->db->order_by('categorie', 'ASC');
		return $this->db->get()->result_array();
    }
    public function getCategorie($id_categ)
    {
		return $this->db->get_where('categorie',array('id_categorie' => $id_categ))->result_array();
    }
}
