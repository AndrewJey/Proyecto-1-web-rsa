<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Front_end_model extends CI_MODEL
{
	public function __construct()
	{

		parent::__construct();

	}

	public function search($name,$type){

		if ($type == "technologies") {
		$query = $this->db->get_where('technologies', array('name' => $name));
		if ($query->num_rows() > 0) {
		$technology = $query->result();
		$query = $this->db->get_where('project_technologies', array('technology_id' => $technology[0]->id));
		if ($query->num_rows() > 0) {
		$query = $query->result();
		foreach ($query as $value) {
			$project = $this->db->get_where('students_projects',array('project_id' => $value->project_id));
			$projects[] = $project->result();
		}
		foreach ($projects as $value) {
			$student = $this->db->get_where('students',array('id' => $value[0]->student_id));
			$students[] = $student->result();
		};	

		$visit = $this->db->get_where('visits', array('name' => $technology[0]->name));
		$visit = $visit->result();
		$visit[0]->visits_number++;
		$data = array('visits_number' =>  $visit[0]->visits_number);
		$this->db->update('visits',$data, array('name' => $technology[0]->name));
		return $students;
		}
		}
		}
		else {
		$query = $this->db->get_where('skills', array('name' => $name));
		if ($query->num_rows() > 0) {
		$skill = $query->result();
		$query = $this->db->get_where('students_skills', array('skill_id' => $skill[0]->id));
		if ($query->num_rows() > 0) {
		$query = $query->result();
		foreach ($query as $value) {
			$student = $this->db->get_where('students',array('id' => $value->student_id));
			$students[] = $student->result();
		};	
		$visit = $this->db->get_where('visits', array('name' => $skill[0]->name));
		$visit = $visit->result();
		$visit[0]->visits_number++;
		$data = array('visits_number' =>  $visit[0]->visits_number);
		$this->db->update('visits',$data, array('name' => $skill[0]->name));
		return $students;
		}
		}
		
		}

		
	}

}

/*
*Location: application/models/user_model.php
*/