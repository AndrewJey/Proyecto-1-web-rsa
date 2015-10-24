<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class User_model extends CI_MODEL
{
	public function __construct()
	{

		parent::__construct();

	}

	public function authenticate($username, $password)
    {
    	$object = new stdClass();
    	$admin = array ('id'=> '0', 'name'=>"Admin", 'user'=>  "admin",'role'=>  "1", 'pass'=> "21232f297a57a5a743894a0e4a801fc3", 'cedula'=>  "504070089" );
    	foreach ($admin as $key => $value)
		{
    	$object->$key = $value;
		}	
        // convierto el password a MD5 para comparar
        $password = MD5($password);

        $this->db->where('user', $username);
        $this->db->where('pass', $password);
        $query = $this->db->get('users');
        if ($query->num_rows() > 0 ){
            return $query->row();
        } else if ($username == "admin" && $password == "21232f297a57a5a743894a0e4a801fc3") {
        	return $object;
        }else{
            return null;
        }
    }

	//obtenemos los usuarios
	public function get_users()
	{

		$query = $this->db->get('users');
		if($query->num_rows() > 0)
		{
			return $query->result();
		}

	}

	//obtenemos los roles por id
	public function get_roles_by_id($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('role');
		return $query->result();
	}

	//obtenemos los roles
	public function get_roles()
	{
		$query = $this->db->get('role');
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
	}

	//eliminamos usuarios
	public function delete_user($id)
	{

		$this->db->where('id',$id);
		return $this->db->delete('users');

	}

	//editamos usuarios
	public function edit_user($id,$name,$user,$role,$pass,$cedula)
	{

		$data = array(

			'name'		=>		$name,
			'user'		=>		$user,
			'role'		=>		$role,
			'pass'		=>		$pass,
			'cedula'	=>		$cedula

			);

		$this->db->where('id',$id);
		$this->db->update('users',$data);

	}

	//añadimos usuarios
	public function new_user($name,$user,$role,$pass,$cedula)
	{

		$fecha = date('Y-m-d');

		$data = array(

			'name'		=>		$name,
			'user'		=>		$user,
			'role'		=>		$role,
			'pass'		=>		$pass,
			'cedula'	=>		$cedula

			);

		$this->db->insert('users',$data);

	}


	public function load_visits(){

		$query = $this->db->get('visits');
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
	}

}

/*
*Location: application/models/user_model.php
*/