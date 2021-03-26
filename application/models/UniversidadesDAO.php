<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UniversidadesDAO extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function editar_universidad($datos, $id){
        $this->db->where('id', $id);
        $this->db->update('universidades', $datos);
    }

    function registrar_universidad($datos){
        $this->db->insert('universidades', $datos);
    }

    function listar_universidades(){
        $query = $this->db->get('universidades');

        return $query->result();
    }

    function obtener_universidad_id($id){
        $this->db->where('id', $id);
        $query = $this->db->get('universidades');

        return $query->row();
    }

    function borrar_universidad($id){
        $this->db->where('id', $id);
        $this->db->delete('universidades');
    }
}