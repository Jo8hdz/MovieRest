<?php
/*Los metodos del CRUD y otros se definen y se heredan en/de una clase global que esta ubicada en MY_Model.php en la carpeta core
para facilitar la creacion de nuevos modelos.*/

class favorito extends MY_Model{

    public $table = "favorito";
    public $table_id = "idFavorito";

    public function __construct(){
        parent::__construct();    
    }

    function findByIdU_IdP($idusuario, $idPelicula){ //busca un favorito de una pelicula y usuario especifico
        $this ->db->select();
        $this ->db->from($this->table);
        $this ->db->where("idusuario", $idusuario);
        $this ->db->where("idPelicula", $idPelicula);
        
        $query = $this->db->get();
        return $query->row();
    }

    function findByIdP($idPelicula){ //busca favoritos de una pelicula 
        $this ->db->select();
        $this ->db->from($this->table);
        $this ->db->where("idPelicula", $idPelicula);
        
        $query = $this->db->get();
        return $query->result();
    }

    function deleteByIdU_IdP($idusuario, $idPelicula){ // borra un favorito especifico de un usuario
        $this ->db->where("idusuario", $idusuario);
        $this ->db->where("idPelicula", $idPelicula);
        $this ->db->delete($this->table);
    }
}