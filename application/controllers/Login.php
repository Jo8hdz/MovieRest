<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct(){// constructor login
        parent::__construct();
    }

    //para el login
    public function index() {
        //echo hashPassword("hola");
        //echo verifyHashedPassword("hola",hashPassword("hola"));
        if (!isLoggedIn()){// si nuestro usuario no es valido
            // el usuario no esta autenticado
            $this->login();
            $this->load->view("user/login"); // carga la vista del login.php
        }
        else{
            //el usuario esta autenticado
            redirect("/core/dashboard");
        }
    }
    
    //para cerrar sesion
    public function logout(){
        // evita acceder al logout con la ruta login/logout
        if ($this->uri->uri_string() == "login/logout") {//si ponemos esto el la ruta nos manda 404
            show_404();
        }
        // destruimos la session y redireccionamos a login
        $this->session->sess_destroy();
        redirect("/login");
    }

    // para el login
    private function login(){       
        // reglas de validacion
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[20]');
        $this->form_validation->set_rules('email', 'Email', 'required|max_length[30]|valid_email|trim');
        
        if ($this->form_validation->run() == FALSE) {//revisa las reglas de validacion
            
        }
        else {
            $email= $this->input->post('email');// datos de entrada del formulario
            $password= $this->input->post('password'); // datos de entrada del formulario
            $usuario= $this->Usuario->checkLogin($email, $password);// revisa si los datos de autentificacion son correctos
            if (is_object($usuario)) {
                $sessionUser= array(
                    'idUsuario'=>$usuario->idUsuario,
                    'email'=>$usuario->email,
                    'nombre'=>$usuario->nombre
                );
                //se define la sesion
                $this->session->set_userdata($sessionUser);
                $this->session->set_flashdata("success","Bienvenido $usuario->nombre");
                // vamos al admin
                redirect("/core/Dashboard");
            }
            else {
                // autenticacion fallo y mostramos mensajes de errores
                $this->session->set_flashdata("error", "Email o contraseña incorrecta");
                echo "Email o contraseña incorrecta";
            }
        }
    }
}

