<?php
/*Los metodos del CRUD y otros se definen y se heredan en/de una clase global que esta ubicada en MY_Model.php en la carpeta core
para facilitar la creacion de nuevos modelos.*/

class Api extends MY_Model{

    public $table = "api";
    public $table_id = "idApi";

    public function __construct(){
        parent::__construct();    
    }

    //Estamos sobre escribiendo el metodo global find que definimos en MY_Model.
    function findByTag($tag){
        //muestra todos los registros de la tabla pelicula y ademas el nombre del genero al que pertenecen.
        $this ->db->select();
        $this ->db->from($this->table);        
        $this ->db->where("tag", $tag);  // 

        $query = $this ->db->get();
        return $query->row();
    }
}