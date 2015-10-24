<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Student extends CI_CONTROLLER
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
		//cargamos el modelo career_model
		$this->load->model('student_model', 'student');

	}

	//cargamos la vista y pasamos el título y los estudiantes a
	//través del array data a la misma
	public function index()
	{
        $user = $this->session->userdata('user');
        if(!$user) {
            redirect("login");
        }
         $rows = $this->student->get_students();
         for ($i=0; $i < sizeof($rows); $i++) { 
            $career = $this->student->get_career_by_id($rows[$i]->career_id);
            $rows[$i]->career_id = $career[0]->name;
         }
         if (sizeof($rows) > 0) {
              $data = array('titulo' => 'Estudiantes',
                      'students' => $rows);
         } else{
             $data = array('titulo' => 'Estudiantes',
                      'students' => null);
         }

        $tipo = array('tipo' => 'Estudiantes',
            'user_info' => $user,
            'url' => base_url()."student");
        
        $this->load->view('inicio');
        
        $this->load->view('body',$tipo);
        $this->load->view('student/student_view',$data);
        $this->load->view('student/student-js');
        $this->load->view('footer');
       
	}

    public function get_student($id){

        //comprobamos si es una petición ajax
        if($this->input->is_ajax_request())
        {

            $variable = $this->student->get_student_by_id($id);
            if ($variable!= null) {
                foreach ($variable as $value) {
                $response = "<img style=\"width: 200px; height: 200px;\" src=\"".$value->photo."\" title='img'/><br/>".
                "<label>Cedula</label><br/><input type='text' name='idn' class='idn' value=".$value->idn." id='idn' readonly/><br/>".
                "<label>Nombre</label><br/><input type='text' name='name' class='name' value=".$value->name." id='name' readonly/><br/>";
                }
            }
            echo json_encode($response);
        }
    }

    public function get_tecnologias(){

        //comprobamos si es una petición ajax
        if($this->input->is_ajax_request())
        {

            $variable = $this->student->get_tecnologias();
            $response = "";
            foreach ($variable as $value) {
                $response .= "<input type='checkbox' name='check_list[]' value=\"". $value->id ."\">$value->name"."   ";
            }

            echo json_encode($response);
        }
    }
    public function get_careers(){

        //comprobamos si es una petición ajax
        if($this->input->is_ajax_request())
        {

            $variable = $this->student->get_careers();
            $response = "";
            foreach ($variable as $value) {
                $response .= "<option value=\"". $value->id ."\">$value->name</option>";
            }

            echo json_encode($response);
        }
    }
    public function get_cursos(){

        //comprobamos si es una petición ajax
        if($this->input->is_ajax_request())
        {

            $variable = $this->student->get_cursos();
            $response = "";
            foreach ($variable as $value) {
                $response .= "<option value=\"". $value->id ."\">$value->name</option>";
            }

            echo json_encode($response);
        }
    }

    public function get_skills($id){

            $variable = $this->student->get_skills();
            $skills = $this->student->get_skills_by_id($id);
            $response = "";
            $index = 0;
            foreach ($variable as $value) {
                if (! $skills) {
                    $response .= "<input name='check[]' type=\"checkbox\" value=\"". $value->id ."\">$value->name</option> &nbsp;&nbsp;";
                }
                else{

                    if ($skills[$index]->skill_id == $value->id) {
                    $response .= "<input name='check[]' type=\"checkbox\" value=\"". $value->id ."\" checked>$value->name</option> &nbsp;&nbsp;";        
                    }
                    else{
                        $response .= "<input name='check[]' type=\"checkbox\" value=\"". $value->id ."\">$value->name</option> &nbsp;&nbsp;";
                    }
                }
                
                if ($index < sizeof($skills)-1) {
                    $index++;
                }
                
            }

            return $response;               
    }
 
 	//función para eliminar estudiantes
    public function delete_student()
    {
        
        //comprobamos si es una petición ajax y existe la variable post id
        if($this->input->is_ajax_request() && $this->input->post('id'))
        {

        	$id = $this->input->post('id');

			$this->student->delete_student($id);

        }

    }
    //función para eliminar proyectos
    public function delete_proyecto()
    {
        
        //comprobamos si es una petición ajax y existe la variable post id
        if($this->input->is_ajax_request() && $this->input->post('id'))
        {

            $id = $this->input->post('id');
            $student = $this->input->post('student');

            $this->student->delete_proyecto($id,$student);

        }

    }

    //se usa para traer los comentarios
    public function loadcomments(){
        //comprobamos si es una petición ajax
            $variable = $this->student->get_comments();
            $response = "";
            foreach ($variable as $value) {
                $response .= "<div class='alert alert-info'>".$value->comment."<br/><span class='label-info label label-default'>".$value->user."</span></div>";
            }
            var_dump($response);
            return $response;
    }
    public function edit_student($id){
        $user = $this->session->userdata('user');
        if(!$user) {
            redirect("login");
        }
        $student = $this->student->get_student_by_id($id);
            $career = $this->student->get_career_by_id($student[0]->career_id);
            $student[0]->career_id = $career[0]->name;
        $data['student'] = $student[0];
        $data['skills'] = $this->get_skills($id);

        $variable = $this->student->get_careers();
        $careers = "";
        foreach ($variable as $value) {
            if ($student[0]->career_id == $value->id) {
             $careers .= "<option value=\"". $value->id ."\" selected>$value->name</option>";
            }
            else{
                $careers .= "<option value=\"". $value->id ."\">$value->name</option>";
            }
        }
        $variable2 = $this->student->get_projects_by_id($id);

        $projects = "";
        foreach ($variable2 as $value2) {
            $projects .= "<option value=\"". $value2['id'] ."\">$value2[descripcion]</option>";
        }
        $data['projects'] = $projects;
        $data['careers'] = $careers;

        $variable3 = $this->student->get_comments();
        $comentarios ="";
        if ($variable3!= null) {
            foreach ($variable3 as $value3) {
                $comentarios .= "<div class='alert alert-info'>".$value3->comment."</div><div style='text-align: right; padding-bottom: 1%' ><span class='label-default label'>".$value3->user." : ".$value3->date."</span></div>";
            }
        }
        $data['comments'] = $comentarios;
        $tipo = array('tipo' => 'Estudiantes',
            'user_info' => $user,
            'url' => base_url()."student",
            'ext' => "<li><a href=\"".base_url()."student/edit/".$id."\">".$student[0]->name."</a></li>");
        $user2 = $this->session->userdata('user');
        $this->load->view('inicio');
        $this->load->view('body',$tipo);
        $this->load->view('student/edit_student_view',$data);
        $this->load->view('student/edit_student-js.php');
        $this->load->view('footer'); 
    }
    //con esto se agregan comentarios
    public function comment($comment){
       $user = $this->session->userdata('user');
       $username = $user->name;
       $id_student = $user->id;
       $fecha = date('Y-m-d');
       $this->student->comment($id_student,$comment,$username, $fecha);

    }
 

 	//con esta función añadimos y editamos estudiantes dependiendo 
 	//si llega la variable post id, en ese caso editamos
    public function multi_student()
    {

    	//comprobamos si es una petición ajax
    	if($this->input->is_ajax_request())
        {

            $this->form_validation->set_rules('name', 'nombre', 'required');
            $this->form_validation->set_rules('cedula', 'cedula', 'required');

            $this->form_validation->set_message('required','El %s es obligatorio');
            

            if($this->form_validation->run() == FALSE)
            {

            	//de esta forma devolvemos los errores de formularios
            	//con ajax desde codeigniter, aunque con php es lo mismo
            	$errors = array(
				    'name' => form_error('name'),
                    'cedula' => form_error('cedula'),
				    'respuesta' => 'error'
				);
            	//y lo devolvemos así para parsearlo con JSON.parse
				echo json_encode($errors);

				return FALSE;

            }else{

            	$cedula = $this->input->post('cedula');
	        	$name = $this->input->post('name');
                $photo = $this->input->post('photo');
                $career = $this->input->post('career');
                $english = $this->input->post('english');
                $skills = $this->input->post('skills');

	        	//si estamos editando
            	if($this->input->post('id'))
            	{
            		$id = $this->input->post('id');
            		$this->student->edit_student($id,$cedula,$name,$photo,$career,$english, $skills);

            	//si estamos agregando un estudiante
            	}else{

            		$this->student->new_student($cedula,$name,$photo,$english, $career);

            	}
	        	
	        	//en cualquier caso damos ok porque todo ha salido bien
	        	//habría que hacer la comprobación de la respuesta del modelo

	        	$response = array(
				    'respuesta'	=>	'ok'
				);
            	
                echo json_encode($response);

            }
 
        }
        
    }
    //con esta función añadimos y editamos estudiantes dependiendo 
    //si llega la variable post id, en ese caso editamos
    public function multi_project()
    {

        //comprobamos si es una petición ajax
        if($this->input->is_ajax_request())
        {

            $this->form_validation->set_rules('descripcion', 'descripcion', 'required');
            $this->form_validation->set_rules('duracion', 'duracion', 'required');
            $this->form_validation->set_rules('calificacion', 'calificacion', 'required');

            $this->form_validation->set_message('required','La %s es obligatoria');
            

            if($this->form_validation->run() == FALSE)
            {

                //de esta forma devolvemos los errores de formularios
                //con ajax desde codeigniter, aunque con php es lo mismo
                $errors = array(
                    'descripcion' => form_error('descripcion'),
                    'duracion' => form_error('duracion'),
                    'calificacion' => form_error('calificacion'),
                    'respuesta' => 'error'
                );
                //y lo devolvemos así para parsearlo con JSON.parse
                echo json_encode($errors);

                return FALSE;

            }else{

                $descripcion = $this->input->post('descripcion');
                $duracion = $this->input->post('duracion');
                $calificacion = $this->input->post('calificacion');
                $cursos = $this->input->post('curso');
                $date = $this->input->post('fecha');
                $tecnologias = $_POST['check_list'];
                $id_student = $this->input->post('student_id');
                //si estamos editando
                if($this->input->post('id'))
                {
                    $id = $this->input->post('id');
                    $this->student->edit_project($id,$descripcion,$duracion,$calificacion,$cursos,$date,$tecnologias);

                //si estamos agregando un estudiante
                }else{

                    $this->student->new_project($descripcion,$duracion,$calificacion,$cursos,$date,$id_student,$tecnologias);

                }
                
                //en cualquier caso damos ok porque todo ha salido bien
                //habría que hacer la comprobación de la respuesta del modelo

                $response = array(
                    'respuesta' =>  'ok'
                );
                
                echo json_encode($response);

            }
 
        }
        
    }
}

/*
*Location: application/controllers/user.php
*/