<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DAO extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function insertar_tabla($nombre_entidad, $datos, $generar_id = false){
        $this->db->insert($nombre_entidad, $datos);

        if($generar_id){
            return $this->db->insert_id();
        }
    }

    function obtener_id($nombre_entidad, $id){
        $this->db->where('id', $id);
        $query = $this->db->get($nombre_entidad);

        return $query->row();
    }

    function iniciar_transaccion(){
        $this->db->trans_begin();
    }

    function validar_transaccion(){
        if($this->db->trans_status()){
            $this->db->trans_commit();
            return true;
        } else{
            $this->db->trans_rollback();
            return false;
        }
    }
}