<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoriasDAO extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function editar_categoria($datos, $id){
        $this->db->where('id', $id);
        $this->db->update('categoria_productos', $datos);
    }

    function registrar_categoria($datos){
        $this->db->insert('categoria_productos', $datos);
    }

    function listar_categorias(){
        $query = $this->db->get('categoria_productos');

        return $query->result();
    }

    function obtener_categoria_id($id){
        $this->db->where('id', $id);
        $query = $this->db->get('categoria_productos');

        return $query->row();
    }

    function borrar_categoria($id){
        $this->db->where('id', $id);
        $this->db->delete('categoria_productos');
    }
}