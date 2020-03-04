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

    public function getAllCategorie($sort=null)
    {
		$this->db->select('*');
		$this->db->from('categorie');
		if($sort!=null)
			$this->db->order_by('categorie', $sort);
		return $this->db->get()->result_array();
    }
    public function getCategorie($id_categ)
    {
		return $this->db->get_where('categorie',array('id_categorie' => $id_categ))->result_array();
	}
	
	public function getCategorieByName($name_categ)
    {
		return $this->db->get_where('categorie',array('categorie' => $name_categ))->result_array();
    }
}
