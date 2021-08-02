<?php

use Restserver\Libraries\REST_Controller;

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Usuarios extends REST_Controller{

    public function login_post($id= NULL){// el parametro id es opcional por eso si no lo pasamos sera nulo, el id solo se ocupara mostrar una los detalles de una pelicula de un listado
        
        $datos= array(
            'idUsuario'=>0,
            'email'=>"",
            'nombre'=>"",
            'token'=>""
        );
        
        // reglas de validacion
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[20]');
        $this->form_validation->set_rules('email', 'Email', 'required|max_length[30]|valid_email|trim');
        
        if ($this->form_validation->run()) {//revisa las reglas de validacion
            $email= $this->input->post('email');// datos de entrada del formulario
            $password= $this->input->post('password'); // datos de entrada del formulario
            $usuario= $this->Usuario->checkLogin($email, $password);// revisa si los datos de autentificacion son correctos
            if (is_object($usuario)) {
                $datos= array(
                    'idUsuario'=>$usuario->idUsuario,
                    'email'=>$usuario->email,
                    'nombre'=>$usuario->nombre,
                    'token'=>""
                );                
            }
        }
        
        $this->response($datos); //devulve los datos        
    }

    public function singUp_post(){// el parametro id es opcional por eso si no lo pasamos sera nulo, el id solo se ocupara mostrar una los detalles de una pelicula de un listado
               
        // reglas de validacion
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[20]|min_length[5]');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|max_length[20]');
        $this->form_validation->set_rules('confirmar_password', 'Confirmar Password', 'required|max_length[20]|min_length[5]|matches[password]');
        $this->form_validation->set_rules('email', 'Email', 'required|max_length[30]|valid_email|trim|is_unique[usuario.email]');
        
        if ($this->form_validation->run()) {//revisa las reglas de validacion, entre si los datos proporcionados cumplen con las reglas
            //guarda los datos del formulario en un arreglo
            $save= array(
                "email"=> $this->input->post('email'), // datos de entrada del formulario
                "nombre"=> $this->input->post('nombre'), // datos de entrada del formulario
                "password"=> hashPassword($this->input->post('password')) // convierte en un hash los datos de entrada del formulario
            );
        
            $idUsuario= $this->Usuario->insert($save);//hace el insert del usuario
            $usuario= $this->Usuario->find($idUsuario);
            
            $datos= array(
                'idUsuario'=>$usuario->idUsuario,////////////////////revisar posible ERROR/////////////////
                'email'=>$usuario->email,
                'nombre'=>$usuario->nombre
            );            
        }
        else{ // si los datos no son correctos devulve los errores
            $datos= array(
                'idUsuario'=>0,////////////////////revisar posible ERROR/////////////////
                'password'=>form_error('confirmar_password'),
                'nombre'=>form_error('nombre'),
                'email'=>form_error('email')
            );
        }
        
        $this->response($datos); //devulve los datos        
    }
    
}