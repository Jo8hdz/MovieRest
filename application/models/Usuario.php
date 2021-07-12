<?php
/*Los metodos del CRUD y otros se definen y se heredan en/de una clase global que esta ubicada en MY_Model.php en la carpeta core
para facilitar la creacion de nuevos modelos.*/

class Usuario extends MY_Model{

    public $table = "usuario";
    public $table_id = "idUsuario";

    public function __construct(){
        parent::__construct();    
    }

    function checkLogin($email, $plainPassword){        
        $this ->db->select();
        $this ->db->from($this->table);        
        $this ->db->where("email", $email);  // 
        
        $query = $this ->db->get();
        $usuario= $query->row();
        if (!empty($usuario)) {
            if (verificarHashedPassword($plainPassword,$usuario->password)) {
                return $usuario;
            }
        }
        return null;
    }

    function findRecords($buscar= array(), $idGenero= NULL, $anio= NULL, $offset=0){// si no le pasamos ningun parametro para los filtros los establece como nulos y si no le pasamos ninguna busqueda se establece un array vacio.
        
        //muestra todos los registros de la tabla pelicula y ademas el nombre del genero al que pertenecen.
        $this ->db->select("p.*, g.nombre as genero");
        $this ->db->from("$this->table as p");
        $this ->db->join('genero as g', 'g.idGenero = p.idGenero', 'LEFT');

        //busqueda
        foreach ($buscar as $indice => $palabra) {//si no hay nada en el array el foreach no entra
            $this ->db->like('p.nombre', $palabra);//busca coincidencias con la palabra (no tiene que ser exactamente igual por eso usamos like)
        }
        //filtros
        if (isset($idGenero)) { //checa si idGenero es nulo
            $this ->db->where('g.idGenero', $idGenero);// devuelve los resultados con exactamente ese dato en ese campo
        }
        if (isset($anio)) { //checa si anio es nulo
            $this ->db->where('anio', $anio);// devuelve los resultados con exactamente ese dato en ese campo
        } 

        $this ->db->limit(TAMANIO_PAGINA, $offset);  // TAMANIO_PAGINA es una constante para todo el entorno que se definio en index.php que esta en la carpeta raiz     

        $query = $this ->db->get();
        return $query->result();
    }

    //Estamos sobre escribiendo el metodo global findAll que definimos en MY_Model.
    function findAll(){
        //muestra todos los registros de la tabla pelicula y ademas el nombre del genero al que pertenecen.
        $this ->db->select("p.*, g.nombre as genero");
        $this ->db->from("$this->table as p");
        $this ->db->join('genero as g', 'g.idGenero = p.idGenero', 'LEFT'); 
        $query = $this ->db->get();
        return $query->result();
    }
}