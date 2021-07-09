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
}