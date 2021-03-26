<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DepartamentosDAO extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function editar_departamento($datos, $id){
        $this->db->where('id', $id);
        $this->db->update('departamentos', $datos);
    }

    function registrar_departamento($datos){
        $this->db->insert('departamentos', $datos);
    }

    function listar_departamentos(){
        $query = $this->db->get('departamentos');

        return $query->result();
    }

    function obtener_departamento_id($id){
        $this->db->where('id', $id);
        $query = $this->db->get('departamentos');

        return $query->row();
    }

    function borrar_departamento($id){
        $this->db->where('id', $id);
        $this->db->delete('departamentos');
    }
}