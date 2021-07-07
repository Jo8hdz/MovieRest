<?php
/*Los metodos del CRUD y otros se definen y se heredan en/de una clase global que esta ubicada en MY_Model.php en la carpeta core
para facilitar la creacion de nuevos modelos.*/

class Genero extends MY_Model{

    public $table = "genero";
    public $table_id = "idGenero";

    public function __construct(){
        parent::__construct();    
    }
}