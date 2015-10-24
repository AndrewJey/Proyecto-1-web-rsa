<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Career_model extends CI_MODEL
{
	public function __construct()
	{

		parent::__construct();

	}

	//obtenemos las carreras
	public function get_careers()
	{

		$query = $this->db->get('careers');
		if($query->num_rows() > 0)
		{
			return $query->result();
		}

	}

	//eliminamos carreras
	public function delete_career($id)
	{

		$this->db->where('id',$id);
		return $this->db->delete('careers');

	}

	//editamos carreras
	public function edit_career($id,$code,$name)
	{

		$data = array(

			'code'		=>		$code,
			'name'		=>		$name

			);

		$this->db->where('id',$id);
		$this->db->update('careers',$data);

	}

	//añadimos carreras
	public function new_career($code,$name)
	{

		$data = array(

			'code'		=>		$code,
			'name'		=>		$name

			);

		$this->db->insert('careers',$data);

	}

}

/*
*Location: application/models/user_model.php
*/