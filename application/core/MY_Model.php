<?php
//CRUD y metodos globales para los modelos
class MY_Model extends CI_Model{

    public function __construct(){ // constructor
        parent::__construct();
        $this->load->database(); // carga la direccion de la base de datos, esta definida en application/config/database.php 
    }
  
    function findAll(){ //  todos registros
        $this ->db->select();
        $this ->db->from($this->table);
        $query = $this ->db->get();
        return $query->result();
    }

    function find($id){ // un solo registro
        $this ->db->select();
        $this ->db->from($this->table);
        $this ->db->where($this->table_id, $id);
        $query = $this->db->get();
        return $query->row();
    }

    function update($id, $data){ // actualiza un registro
        $this ->db->where($this->table_id, $id);
        $this ->db->update($this->table, $data);
    }

    function delete($id/*, $data*/){ // borra un registro
        $this ->db->where($this->table_id, $id);
        $this ->db->delete($this->table);
    }

    function insert($data){ // inserta un registro
        $this ->db->insert($this->table, $data);
        return $this ->db->insert_id(); //devuelve el id del elemento insertado
    }

    function count(){ // cuenta el numero de registros
        $count = $this ->db->query("SELECT $this->table_id FROM $this->table");
        return $count->num_rows();
    }

}