<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CarrerasDAO extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function editar_carrera($datos, $id){
        $this->db->where('id', $id);
        $this->db->update('carreras', $datos);
    }

    function registrar_carrera($datos){
        $this->db->insert('carreras', $datos);
    }

    function listar_carreras(){
        $query = $this->db->get('carreras');

        return $query->result();
    }

    function obtener_carrera_id($id){
        $this->db->where('id', $id);
        $query = $this->db->get('carreras');

        return $query->row();
    }

    function borrar_carrera($id){
        $this->db->where('id', $id);
        $this->db->delete('carreras');
    }
}