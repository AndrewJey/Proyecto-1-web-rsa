<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Front_end extends CI_CONTROLLER
{

public function __construct()
    {
        parent::__construct();

        //cargamos la base de datos por defecto
        $this->load->database('default');
        //cargamos el helper url y el helper form
        $this->load->helper(array('url','form'));
        //cargamos la librería form_validation
        $this->load->library(array('form_validation'));
        //cargamos el modelo front_end_model
        $this->load->model('front_end_model', 'front');
        //cargamos el modelo student_model
        $this->load->model('student_model', 'student');

    }

    public function index(){
        $user = $this->session->userdata('user');
        if ($user) {
            $data = array(
                'user_info' => $user
                );
        $this->load->view('inicio');
        
        $this->load->view('front_end/body', $data);
        $this->load->view('front_end/js');
        $this->load->view('footer');    
        }
        else{
            $data = array(
                'user_info' => null
                );
        $this->load->view('inicio');
        
        $this->load->view('front_end/body', $data);
        $this->load->view('front_end/js');
        $this->load->view('footer');
        }
    }

    public function search($name = "",$type = ""){
      $result = $this->front->search($name,$type);
      if (sizeof($result) > 0) {
        foreach ($result as $student ) {
         $students[] = $student[0];
      };
      $data = array('students' => $students);
      }
      else{
       $data = array('students' => null); 
      }
      
        $this->load->view('inicio');
        $this->load->view('front_end/body');
        $this->load->view('front_end/results', $data);
        $this->load->view('front_end/js');
        $this->load->view('footer');
    }

    public function get_skills($id){

            $variable = $this->student->get_skills();
            $skills = $this->student->get_skills_by_id($id);
            $response = "";
            $index = 0;
            foreach ($variable as $value) {
                if (! $skills) {
                }
                else{
                    if ($skills[$index]->skill_id == $value->id) {
                    $response .= "<label>$value->name</label> &nbsp;&nbsp;";        
                    }
                }
                
                if ($index < sizeof($skills)-1) {
                    $index++;
                }
                
            }

            return $response;               
    }

    public function view($id){
        $student = $this->student->get_student_by_id($id);
        $career = $this->student->get_career_by_id($student[0]->career_id);
        $student[0]->career_id = $career[0]->name;
        $data['student'] = $student[0];
        $data['skills'] = $this->get_skills($id);
        $variable2 = $this->student->get_projects_by_id($id);
        $projects = "";
        foreach ($variable2 as $value2) {
            $projects .= "<option value=\"". $value2['id'] ."\">$value2[descripcion]</option>";
        }
        $data['projects'] = $projects;
        $variable3 = $this->student->get_comments();
        $comentarios ="";
        if ($variable3!= null) {
            foreach ($variable3 as $value3) {
                $comentarios .= "<div class='alert alert-info'>".$value3->comment."</div><div style='text-align: right; padding-bottom: 1%' ><span class='label-default label'>".$value3->user." : ".$value3->date."</span></div>";
            }
        }
        $data['comments'] = $comentarios;

        $this->load->view('inicio');
        $this->load->view('front_end/body');
        $this->load->view('front_end/view',$data);
        $this->load->view('front_end/js.php');
        $this->load->view('footer'); 
    }

 
}

/*
*Location: application/controllers/user.php
*/