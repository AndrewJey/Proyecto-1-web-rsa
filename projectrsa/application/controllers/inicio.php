<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		//cargamos el helper url y el helper form
		$this->load->helper(array('url','form'));
		$this->load->model('User_model', 'user');

	}
	//cargamos la vista y pasamos el título y los usuarios a
	//través del array data a la misma
	public function index()
	{
		$user = $this->session->userdata('user');
        if(!$user) {
            redirect("login");
        }
		$tipo = array('tipo' => 'DashBoard',
			'user_info' => $user);

		$result = $this->user->load_visits();
		foreach ($result as $inf) {
			$info[] = $inf;
		}
		$data = array(
			'info' => $info
		 );
		//var_dump($data);
		$user = $this->session->userdata('user');
		$this->load->view('inicio');
		$this->load->view('body',$tipo);
		$this->load->view('dashboard', $data);
		$this->load->view('dashboard-js');
		$this->load->view('footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */