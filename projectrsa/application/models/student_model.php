<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Student_model extends CI_MODEL
{
	public function __construct()
	{

		parent::__construct();

	}

	//obtenemos los estudiantes
	public function get_students()
	{

		$query = $this->db->get('students');
		if($query->num_rows() > 0)
		{
			return $query->result();
		}

	}

//eliminamos foranea proyectos
	public function delete_proyecto($id,$student)
	{
		$this->db->delete('project_technologies', array('project_id' => $id)); 
		$query = $this->db->delete('students_projects', array('student_id' => $student , 'project_id' => $id)); 
		$this->db->delete('projects', array('id' => $id)); 
		return $query;

	}

	//eliminamos estudiantes
	public function delete_student($id)
	{

		$this->db->where('id',$id);
		return $this->db->delete('students');

	}

			//obtenemos tegnologias
	public function get_tecnologias(){
		$query = $this->db->get('technologies');
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
	}

		//obtenemos cursos
	public function get_cursos(){
		$query = $this->db->get('courses');
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
	}

	//obtenemos carreras
	public function get_careers(){
		$query = $this->db->get('careers');
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
	}
	//obtenemos los proyectos por id
	public function get_projects_by_id($id)
	{
		$object = new stdClass();
		$this->db->where('student_id',$id);
		$variable = $this->db->get('students_projects');
		$response = array();
		if($variable->num_rows() > 0)
		{
			$variable = $variable->result();
			foreach ($variable as $value) {
				$aux = $this->db->get_where('projects', array('id' => $value->project_id));
				$aux = $aux->result();
				$project = $aux;
				$cont = 0;
				foreach ($project as $value2) {
					$cont++;
					array_push($response, array('descripcion'=> $value2->description , 'id'=> $value2->id));
				}
			}
		}
		foreach ($response as $key => $value)
		{
			$object->$key = $value;
		}	
		return $response;
	}
	//obtenemos las carreras por id
	public function get_career_by_id($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('careers');
		return $query->result();
	}

	//obtenemos habilidades
	public function get_skills(){
		$query = $this->db->get('skills');
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
	}

	//obtenemos comentarios
	public function get_comments(){
		$query = $this->db->get('comments');
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
	}

	public function get_skills_by_id($id){
		$this->db->where('student_id',$id);
		$query = $this->db->get('students_skills');
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
	}

	//obtenemos estudiantes por id
	public function get_student_by_id($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('students');
		return $query->result();
	}
//agregamos comentarios
	public function comment($id_student,$comment,$username, $fecha){

		$data = array(
			'id_student' => $id_student,
			'date'    => $fecha,
			'comment' => $comment,
			'user' => $username );

		$this->db->insert('comments', $data);
	}

	//editamos estudiantes
	public function edit_student($id,$cedula,$name,$photo,$career,$english, $skills)
	{
		$this->db->delete('students_skills', array('student_id' => $id)); 
		foreach ($skills as $value) {
			$data1 = array(
				'student_id' => $id, 
				'skill_id' => $value
				);
			$this->db->insert('students_skills', $data1);
		}

		$data = array(

			'idn'			=>		$cedula,
			'name'			=>		$name,
			'photo'			=>		$photo,
			'career_id'		=>		$career,
			'englishlvl'	=>		$english
			);

		$this->db->where('id',$id);
		$this->db->update('students',$data);


	}

	//añadimos estudiantes
	public function new_student($cedula,$name,$photo,$english, $career)
	{

		$data = array(

			'name'			=>		$name,
			'idn'			=>		$cedula,
			'photo'			=>		$photo,
			'englishlvl'	=>		$english,
			'career_id'		=>		$career
			);

		$this->db->insert('students',$data);

	}

//editamos proyectos
	public function edit_project($id,$descripcion,$duracion,$calificacion,$cursos,$fecha,$tecnologias)
	{

		$data = array(
			'description'		=>		$descripcion,
			'duration'		=>		$duracion,
			'grade'		=>		$calificacion,
			'course_id'	=>		$cursos,
			'date'	=>		$fecha
			);
		$this->db->delete('project_technologies', array('project_id' => $id)); 
		$this->db->update('projects',$data , array('id' => $id));
		foreach ($tecnologias as $value) {
		$data3 = array(

			'project_id'		=>		$id,
			'technology_id'		=>		$value
		);

		$this->db->insert('project_technologies',$data3);
		}

	}

	//añadimos proyectos
	public function new_project($descripcion,$duracion,$calificacion,$cursos,$fecha,$id_student,$tecnologias)
	{

		$data = array(

			'description'		=>		$descripcion,
			'duration'		=>		$duracion,
			'grade'		=>		$calificacion,
			'course_id'	=>		$cursos,
			'date'	=>		$fecha
			);

		$this->db->insert('projects',$data);
		$insert_id = $this->db->insert_id();
		$data2 = array(

			'student_id'		=>		$id_student,
			'project_id'		=>		$insert_id
		);

		$this->db->insert('students_projects',$data2);
		foreach ($tecnologias as $value) {
		$data3 = array(

			'project_id'		=>		$insert_id,
			'technology_id'		=>		$value
		);

		$this->db->insert('project_technologies',$data3);
		}
	}

}

/*
*Location: application/models/user_model.php
*/