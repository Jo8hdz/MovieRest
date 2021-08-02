<?php
/*Los metodos del CRUD y otros se definen y se heredan en/de una clase global que esta ubicada en MY_Model.php en la carpeta core
para facilitar la creacion de nuevos modelos.*/

class calificacion extends MY_Model{

    public $table = "calificacion";
    public $table_id = "idCalificacion";

    public function __construct(){
        parent::__construct();    
    }

    function findByIdPelicula($idPelicula){ // busca la calificacion de una pelicula
        $this ->db->select();
        $this ->db->from($this->table);
        $this ->db->where("idPelicula", $idPelicula);

        $query = $this->db->get();
        return $query->result();
    }
    function findByIdP($idPelicula){ //busca calificaciones de una pelicula 
        $this ->db->select();
        $this ->db->from($this->table);
        $this ->db->where("idPelicula", $idPelicula);
        
        $query = $this->db->get();
        return $query->result();
    }
}