<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class User extends CI_CONTROLLER
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
		//cargamos el modelo user_model
		$this->load->model('user_model', 'user');

	}

	//cargamos la vista y pasamos el título y los usuarios a
	//través del array data a la misma
	public function index()
	{
        $user = $this->session->userdata('user');
        if(!$user) {
            redirect("login");
        }
         $rows = $this->user->get_users();
         for ($i=0; $i < sizeof($rows); $i++) { 
            $rol = $this->user->get_roles_by_id($rows[$i]->role);
            $rows[$i]->role = $rol[0]->detail;
         }
         if (sizeof($rows) > 0) {
              $data = array('titulo' => 'Usuarios',
                      'users' => $rows);
         } else{
             $data = array('titulo' => 'Usuarios',
                      'users' => null);
         }
        $tipo = array('tipo' => 'Usuarios',
            'user_info' => $user,
            'url' => base_url()."user");
        $this->load->view('inicio');
        
        $this->load->view('body',$tipo);
        $this->load->view('user/user_view',$data);
        $this->load->view('user/user-js');
        $this->load->view('footer');
	}
 
    public function authenticate() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        // llamamos al modelo User y el método de authenticate
        $user = $this->user->authenticate($username, $password);
        if ($user) {
            $this->session->set_userdata('user', $user);
            redirect("index");
        } else {
            redirect("login");
        }
    }
    public function logout() {
        $this->session->sess_destroy();
        redirect("/login");
    }
    //función para obtener todos los roles
    public function get_roles()
    {
        
        //comprobamos si es una petición ajax
        if($this->input->is_ajax_request())
        {

            $variable = $this->user->get_roles();
            $response = "";
            foreach ($variable as $value) {
                $response .= "<option value=\"". $value->id ."\">$value->detail</option>";
            }

            echo json_encode($response);
        }

    }
 
 	//función para eliminar usuarios
    public function delete_user()
    {
        
        //comprobamos si es una petición ajax y existe la variable post id
        if($this->input->is_ajax_request() && $this->input->post('id'))
        {

        	$id = $this->input->post('id');

			$this->user->delete_user($id);

        }

    }
 
 	//con esta función añadimos y editamos usuarios dependiendo 
 	//si llega la variable post id, en ese caso editamos
    public function multi_user()
    {

    	//comprobamos si es una petición ajax
    	if($this->input->is_ajax_request())
        {

            $this->form_validation->set_rules('nombre', 'nombre', 'trim|min_length[2]|required|max_length[60]|xss_clean');
            $this->form_validation->set_rules('user', 'usuario', 'trim|min_length[2]|required|max_length[60]|xss_clean');
            $this->form_validation->set_rules('cedula', 'cedula', 'trim|min_length[2]|required|max_length[60]|xss_clean');
            $this->form_validation->set_rules('pass', 'password', 'trim|min_length[2]|required|max_length[60]|xss_clean');
            $this->form_validation->set_message('required','El %s es obligatorio');
            $this->form_validation->set_message('max_length', 'El %s no puede tener más de %s carácteres');
            $this->form_validation->set_message('min_length', 'El %s no puede tener menos de %s carácteres');

            if($this->form_validation->run() == FALSE)
            {

            	//de esta forma devolvemos los errores de formularios
            	//con ajax desde codeigniter, aunque con php es lo mismo
            	$errors = array(
				    'nombre' => form_error('nombre'),
                    'user' => form_error('user'),
                    'role' => form_error('role'),
                    'cedula' => form_error('cedula'),
                    'pass' => form_error('pass'),
				    'respuesta' => 'error'
				);
            	//y lo devolvemos así para parsearlo con JSON.parse
				echo json_encode($errors);

				return FALSE;

            }else{

            	$name = $this->input->post('nombre');
	        	$user = $this->input->post('user');
                $role = $this->input->post('role');
                $pass = $this->input->post('pass');
                $cedula = $this->input->post('cedula');
                $pass = md5($pass);
	        	//si estamos editando
            	if($this->input->post('id'))
            	{
            		$id = $this->input->post('id');
            		$this->user->edit_user($id,$name,$user,$role,$pass,$cedula);

            	//si estamos agregando un usuario
            	}else{

            		$this->user->new_user($name,$user,$role,$pass,$cedula);

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