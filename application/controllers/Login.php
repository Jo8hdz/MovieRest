<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){// constructor login
		parent::__construct();
		//$this->load->model('Usuario');

		//$this->load->helper('usuario');// carga un helper llamado usuario que es el que se creo (helpers/usuario_helper.php)
		//$this->load->helper('url'); // carga base url
		//$this->load->library('session');// carga la libreria para el inicio de sesion llamada session
	}

	public function index()	{
		//echo hashPassword("hola");
		//echo verificarHashedPassword("hola",hashPassword("hola"));
		if (!isLoggedIn()){// si nuestro usuario no es valido
			// que el usuario no esta autenticado
			$this->login();
			$this->load->view("user/login"); // carga la vista del login.php
		}
		else{
			//el usuario esta autenticado
			redirect("/core/dashboard");
		}
	}

	private function isLoggedIn(){ // verifica si el usuario esta en una sesion 
		$idUsuario= $this->session->userdata('idUsuario');
		if (!isset($idUsuario)) {
			return false;
		}
		return true;
	}

	public function logout(){
		// preguntamos por la uri string
        if ($this->uri->uri_string() == "login/logout") {
            show_404();
        }
		// destruimos la session y redireccionamos a login
		$this->session->sess_destroy();
		redirect("/login");
	}

	private function login(){
		//$this->load->helper(array('form', 'url'));
		//$this->load->library('form_validation'); // carga la libreia incluida en codeigniter para las validaciones
		// reglas
		$this->form_validation->set_rules('password', 'Password', 'required|max_length[20]');
		$this->form_validation->set_rules('email', 'Email', 'required|max_length[30]|valid_email|trim');

		if ($this->form_validation->run() == FALSE) {
			//$this->load->view('myform');
		}
		else {
			$email= $this->input->post('email');
			$password= $this->input->post('password');
			$usuario= $this->Usuario->checkLogin($email, $password);

			if (is_object($usuario)) {
				$sessionUser= array('idUsuario'=>$usuario->idUsuario, 'email'=>$usuario->email, 'nombre'=>$usuario->nombre);
				$this->session->set_userdata($sessionUser);
				$this->session->set_flashdata("success","Bienvenido $usuario->nombre");
				// vamos al admin
				redirect("/core/dashboard");
			}
			else {
				// autenticacion fallo y mostramos mensajes de errores
				$this->session->set_flashdata("error", "Email o contraseña incorrecta");
				echo "Email o contraseña incorrecta";
			}
		}
	}
}
