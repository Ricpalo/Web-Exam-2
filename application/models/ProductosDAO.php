<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductosDAO extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function editar_producto($datos, $id){
        $this->db->where('codigo_barras', $id);
        $this->db->update('productos', $datos);
    }

    function registrar_producto($datos){
        $this->db->insert('productos', $datos);
    }

    function listar_productos(){
        $sql = 'SELECT p.*, c.nombre_categoria FROM productos p, categoria_productos c WHERE id = fk_categoria';

        $query = $this->db->query($sql);

        return $query->result();
    }

    function obtener_producto_id($id){
        $this->db->where('codigo_barras', $id);

        $query = $this->db->get('productos');
        return $query->row();
    } 

    function borrar_producto($id){
        $this->db->where('codigo_barras', $id);
        $this->db->delete('productos');
    }
}