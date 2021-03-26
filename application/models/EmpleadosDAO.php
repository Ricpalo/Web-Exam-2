<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmpleadosDAO extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function listar_empleados(){
        $sql = 'SELECT e.*, d.nombre_departamento FROM empleados e, departamentos d WHERE d.id = fk_departamento';

        $query = $this->db->query($sql);

        return $query->result();
    }
}