<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        //verifyAuth();
    }

    public function index() {
        //$this->load->view('user/login');
        $view['body']="<div>hola Mundo</div>";
        $view['title'] = "Título";
        $this->parser->parse('core/templates/body', $view);
        echo "Admin";

    }

    public function pelicula_list() {        
        $datos["peliculas"]= $this->Pelicula->findAll(); //modelo que se encarga de traer los datos
        // construye la vista del listado de peliculas
        $view['title'] = "Lista de Peliculas";
        $view['body']=$this->load->view("core/peliculas/list", $datos, TRUE); //devuelve el html de la vista       
        $this->parser->parse('core/templates/body', $view);
    }

    public function pelicula_save($idPelicula = null) {
        
        // Capa de Modelo, carga la datos  
        // por el metodo de HTTP
        $vdatos["idGenero"] = $vdatos["nombre"] = $vdatos["anio"] = $vdatos["descripcion"] = $vdatos["imagen"] = "";
        $vdatos["genero"] = type_movies_to_form($this->Genero->findAll());
        
        if ($idPelicula != null) {
            $pelicula = $this->Pelicula->find($idPelicula);

            if (is_object($pelicula)) {
                $vdatos["nombre"] = $pelicula->nombre;
                $vdatos["anio"] = $pelicula->anio;
                $vdatos["descripcion"] = $pelicula->descripcion;
                $vdatos["imagen"] = $pelicula->imagen;
                $vdatos["idGenero"] = $pelicula->idGenero;
            }
        }

        if ($this->input->server("REQUEST_METHOD") == "POST") { // metodo http
            // reglas de validacion
            $this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]');
            $this->form_validation->set_rules('descripcion', 'Descripción', 'required|min_length[10]');
            $this->form_validation->set_rules('anio', 'Año', 'required');

            // obteniendo los datos del formulario
            $save["nombre"] = $vdatos["nombre"] = $this->input->post("nombre");
            $save["anio"] = $vdatos["anio"] = $this->input->post("anio");
            $save["descripcion"] = $vdatos["descripcion"] = $this->input->post("descripcion");
            $save["idGenero"] = $vdatos["idGenero"] = $this->input->post("idGenero");

            //revisar reglas de validacion
            if ($this->form_validation->run() == FALSE) {
                
            } 
            else {
                if ($idPelicula == null){
                    $idPelicula = $this->Pelicula->insert($save);
                }
                else{
                    $this->Pelicula->update($idPelicula, $save);
                }
                $this->do_upload($idPelicula);
            }
        }
        // Capa de la Vista
        $view['body'] = $this->load->view("core/peliculas/save", $vdatos, TRUE);
        $view['title'] = "Registrar película";
        $this->parser->parse('core/templates/body', $view);
    }

    public function pelicula_show($idPelicula = null) {

        // Capa de Modelo, carga la datos  
        // por el metodo de HTTP

        if ($idPelicula == null) {
            show_404();
        }

        $pelicula = $this->Pelicula->find($idPelicula);

        if (!is_object($pelicula)) {
            show_404();
        }

        $vdatos["nombre"] = $pelicula->nombre;
        $vdatos["anio"] = $pelicula->anio;
        $vdatos["descripcion"] = $pelicula->descripcion;
        $vdatos["imagen"] = $pelicula->imagen;

        // Capa de la Vista
        $view['body'] = $this->load->view("core/peliculas/show", $vdatos, TRUE);
        $view['title'] = "Mostrar película: " . $pelicula->nombre;
        $this->parser->parse('core/templates/body', $view);
    }
    
    public function pelicula_delete($idPelicula = null) {
        if ($idPelicula == null) {
            show_404();
        }
        $this->Pelicula->delete($idPelicula);
        redirect("/core/dashboard/pelicula_list");
    }

    //CRUD para Generos 

    public function genero_list() {

        // Capa de Modelo, carga la datos  
        $datos["genero"] = $this->Genero->findAll();

        // Capa de la Vista
        $view['body'] = $this->load->view("core/genero/list", $datos, TRUE);
        $view['title'] = "Listado de generos de películas";
        $this->parser->parse('core/templates/body', $view);
    }

    public function genero_save($idGenero = null) {

        // Capa de Modelo, carga la datos  
        // por el metodo de HTTP

        $vdatos["nombre"] = "";

        if ($idGenero != null) {
            $genero = $this->Genero->find($idGenero);

            if (is_object($genero)) {
                $vdatos["nombre"] = $genero->nombre;
            }
        }

        if ($this->input->server("REQUEST_METHOD") == "POST") {
            // reglas de validacion
            $this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]');
            // obteniendo los datos del formulario
            $save["nombre"] = $vdatos["nombre"] = $this->input->post("nombre");
            //revisar reglas de validacion
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                if ($idGenero == null)
                    $idGenero = $this->Genero->insert($save);
                else
                    $this->Genero->update($idGenero, $save);
            }
        }

        // Capa de la Vista
        $view['body'] = $this->load->view("core/genero/save", $vdatos, TRUE);
        $view['title'] = "Registrar Generos de películas";
        $this->parser->parse('core/templates/body', $view);
    }

    public function genero_show($idGenero = null) {
        // Capa de Modelo, carga la datos  
        // por el metodo de HTTP
        if ($idGenero == null) {
            show_404();
        }

        $genero = $this->Genero->find($idGenero);

        if (!is_object($genero)) {
            show_404();
        }

        $vdatos["nombre"] = $genero->nombre;
        // Capa de la Vista
        $view['body'] = $this->load->view("core/genero/show", $vdatos, TRUE);
        $view['title'] = "Mostrar película: " . $genero->nombre;
        $this->parser->parse('core/templates/body', $view);
    }

    public function genero_delete($idGenero = null) {
        if ($idGenero == null) {
            show_404();
        }
        $this->Genero->delete($idGenero);
        redirect("/core/dashboard/genero_list");
    }

    private function do_upload($idPelicula) {

        // configuraciones sobre la carga del archivo
        $config['upload_path'] = 'uploads/peliculas';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 20000; //20 mb = 20000 kilobyte
        $config['max_width'] = 3840;
        $config['max_height'] = 2160;

        // carga de la libreria
        $this->load->library('upload', $config);

        // intento de subida de la imagenn
        if (!$this->upload->do_upload('imagen')) {
            // mostrar errores
            return $this->upload->display_errors();
        } else {
            // mostrar datos de la carga de la imagenn
            $datos = $this->upload->datos();

            // actualizamos en base de datos
            $nombre = $datos['file_nombre'];
            $save = array("imagen" => $nombre);
            $this->Pelicula->update($idPelicula, $save);
        }
    }

}
