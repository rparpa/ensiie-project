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

	public function update($model)
	{
		$this->db->where('id_categorie', $model['id_categorie']);
		return $this->db->update('categorie',$model);
	}

    public function getAllCategorie()
    {
		return $this->db->select('*')
			->from('categorie')
			->get()
			->result_array();
    }
    public function getCategorie($id_categ)
    {
		return $this->db->get_where('categorie',array('id_categorie' => $id_categ))->result_array();
    }
}
