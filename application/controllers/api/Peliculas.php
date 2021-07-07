<?php

use Restserver\Libraries\REST_Controller;

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Peliculas extends REST_Controller{

    public function show_get($id= NULL){// el parametro id es opcional por eso si no lo pasamos sera nulo, el id solo se ocupara mostrar una los detalles de una pelicula de un listado
        
        $this->load->model('Pelicula');//El modelo que va usar
        if (isset($id)) {
            $datos= $this->Pelicula->find($id);
        }else{
            // paginacion
            $offset= $this->input->get("offset");            
            
            //busqueda
            $nombre= $this->input->get("nombre");
            $buscar= explode(" ", $nombre);//explode divide un string(segundo parametro) usando otro como marcador(primer parametro) y devuelve un array.
            
            // filtros
            $idGenero= $this->input->get("idGenero");
            $anio= $this->input->get("anio");            
            
            $datos= $this->Pelicula->findRecords($buscar, $idGenero, $anio);            
        } 
        $this->response($datos); //devulve los datos        
    }
}