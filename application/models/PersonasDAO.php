<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PersonasDAO extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function editar_persona($datos, $id){
        $this->db->where('id', $id);
        $this->db->update('personas', $datos);
    }

    function registrar_persona($datos){
        $this->db->insert('personas', $datos);
    }

    function listar_personas(){
        $query = $this->db->get('personas');

        return $query->result();
    }

    function obtener_persona_id($id){
        $this->db->where('id', $id);
        $query = $this->db->get('personas');

        return $query->row();
    }

    function borrar_persona($id){
        $this->db->where('id', $id);
        $this->db->delete('personas');
    }
}