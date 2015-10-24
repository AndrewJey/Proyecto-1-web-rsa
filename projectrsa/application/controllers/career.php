<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Career extends CI_CONTROLLER
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
		$this->load->model('career_model', 'career');

	}

	//cargamos la vista y pasamos el título y las carreras a
	//través del array data a la misma
	public function index()
	{
        $user = $this->session->userdata('user');
        if(!$user) {
            redirect("login");
        }
         $rows = $this->career->get_careers();
         if (sizeof($rows) > 0) {
              $data = array('titulo' => 'Carreras',
                      'careers' => $rows);
         } else{
             $data = array('titulo' => 'Carreras',
                      'careers' => null);
         }
       
        $tipo = array('tipo' => 'Carreras',
            'user_info' => $user,
            'url' => base_url()."career");
        $this->load->view('inicio');
        
        $this->load->view('body',$tipo);
        $this->load->view('career/career_view',$data);
        $this->load->view('career/career-js');
        $this->load->view('footer');
	}
 
 	//función para eliminar carreras
    public function delete_career()
    {
        
        //comprobamos si es una petición ajax y existe la variable post id
        if($this->input->is_ajax_request() && $this->input->post('id'))
        {

        	$id = $this->input->post('id');

			$this->career->delete_career($id);

        }

    }
 
 	//con esta función añadimos y editamos carreras dependiendo 
 	//si llega la variable post id, en ese caso editamos
    public function multi_career()
    {

    	//comprobamos si es una petición ajax
    	if($this->input->is_ajax_request())
        {

            $this->form_validation->set_rules('code', 'codigo', 'required');
            $this->form_validation->set_rules('name', 'nombre', 'required');
            $this->form_validation->set_message('required','El %s es obligatorio');
            

            if($this->form_validation->run() == FALSE)
            {

            	//de esta forma devolvemos los errores de formularios
            	//con ajax desde codeigniter, aunque con php es lo mismo
            	$errors = array(
				    'code' => form_error('code'),
                    'name' => form_error('name'),
				    'respuesta' => 'error'
				);
            	//y lo devolvemos así para parsearlo con JSON.parse
				echo json_encode($errors);

				return FALSE;

            }else{

            	$code = $this->input->post('code');
	        	$name = $this->input->post('name');

	        	//si estamos editando
            	if($this->input->post('id'))
            	{
            		$id = $this->input->post('id');
            		$this->career->edit_career($id,$code,$name);

            	//si estamos agregando una carrera
            	}else{

            		$this->career->new_career($code,$name);

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
 
}

/*
*Location: application/controllers/user.php
*/