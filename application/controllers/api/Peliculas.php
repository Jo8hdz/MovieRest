<?php

use Restserver\Libraries\REST_Controller;

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Peliculas extends REST_Controller{

    public function show_get($id= NULL){// el parametro id es opcional por eso si no lo pasamos sera nulo, el id solo se ocupara mostrar una los detalles de una pelicula de un listado
        
        if (isset($id)) {
            $datos= $this->Pelicula->find($id);
            if ($this->input->get("idusuario") !="" && $this->input->get("idusuario") != NULL) { // si es diferente de vacio y de null
                $datos->favorito= $this->Favorito->findByIdU_IdP($this->input->get("idusuario"), $id);//añade la informacion de favoritos del usuario a datos
                $datos->calificacion= $this->Calificacion->findByIdU_IdP($this->input->get("idusuario"), $id); //añade la informacion de calificacion del usuario a datos
            }
            $datos->favoritos= $this->Favorito->findByIdP($id);//añade la informacion de los favoritos de todos los usuarios a datos
            $datos->calificaciones= $this->Calificacion->findByIdP($id);//añade la informacion de las calificaciones de todos los usuarios a datos
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

    public function favorito_post(){         
        //agregar favorito
        $favorito= $this->Favorito->findByIdU_IdP($this->input->post("idusuario"), $this->input->post("idPelicula"));
        if ($this->input->post("favorito")==1 && !is_object($favorito)) {  // si el favorito no existe ya y se quiere crear uno nuevo
            $save =array(
                "idusuario"=> $this->input->post("idusuario"),
                "idPelicula"=>$this->input->post("idPelicula")
            );
            $this->Favorito->insert($save);
        }
        //quitar favorito
        if ($this->input->post("favorito")==0) {
            $this->Favorito->deleteByIdU_IdP($this->input->post("idusuario"), $this->input->post("idPelicula"));
        }

        $this->response(array("res"=>"ok")); //devulve una respuesta      
    }

    public function favorito_get(){
        //buscar favorito        
        if ($this->input->get("idusuario") !="" && $this->input->get("idusuario") != NULL) { 
            $datos= $this->Favorito->findByIdU_IdP($this->input->get("idusuario"), $this->input->get("idPelicula"));
        }
        else {
            $datos= $this->Favorito->findByIdP($this->input->get("idPelicula"));
        }

        $this->response($datos); //devulve una respuesta      
    }

    public function calificacion_post(){ 
        //guardamos los datos de entrada en save
        $save =array(
            "idusuario"=> $this->input->post("idusuario"), 
            "idPelicula"=>$this->input->post("idPelicula"), 
            "calificacion"=>$this->input->post("calificacion")
        );        
        $calificacion= $this->Calificacion->findByIdU_IdP($this->input->post("idusuario"), $this->input->post("idPelicula"));//busca la calificacion
        if (is_object($calificacion)) {  // si ya existe una calificacion
            $this->Calificaion->update($calificacion->idCalificacion, $save);// actualiza la calificacion
        }
        else {// si no existe
            $this->Calificacion->insert($save); // inserta la calificacion
        }

        $this->response(array("res"=>"ok")); //devulve una respuesta      
    }

    public function calificacion_get(){
        //buscar favorito        
        if ($this->input->get("idusuario") !="" && $this->input->get("idusuario") != NULL) { 
            $datos= $this->Calificacion->findByIdU_IdP($this->input->get("idusuario"), $this->input->get("idPelicula"));
        }
        else {
            $datos= $this->Calificacion->findByIdP($this->input->get("idPelicula"));
        }

        $this->response($datos); //devulve una respuesta      
    }

    public function genero_get(){
        
        $this->response($this->Genero->findAll()); //devulve todos los generos      
    }

    public function imagen_promocional_get(){
        $api= $this->Api->findByTag("IMAGEN_PROMOCIONAL");
        $this->response(array("res"=> $api->valor)); //devulve todos los generos      
    }
}