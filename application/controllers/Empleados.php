<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empleados extends CI_Controller {
	function __construct(){
		parent::__construct();
        $this->load->model('DepartamentosDAO');
        $this->load->model('EmpleadosDAO');
        $this->load->model('DAO');
    }

    function index(){
        $data['departamentos'] = $this->DepartamentosDAO->listar_departamentos();
        $data['empleados'] = $this->EmpleadosDAO->listar_empleados();
        $this->load->view('empleados/empleados_pagina', $data);
    }

    function registrar_empleado(){
        $this->DAO->iniciar_transaccion();

        $datos_persona = array(
            "nombre_persona" => $this->input->post('nombre'),
            "apellidos" => $this->input->post('apellidos'),
            "genero" => $this->input->post('genero'),
            "fecha_nacimiento" => $this->input->post('nacimiento'),
            "curp" => $this->input->post('curp'),
            "email" => $this->input->post('email'),
            "telefono" => $this->input->post('telefono')
        );

        $persona_id = $this->DAO->insertar_tabla('personas', $datos_persona, TRUE);

        $datos_empleado = array(
            "no_empleado" => $this->input->post('numero'),
            "rfc" => $this->input->post('rfc'),
            "fk_persona" => $persona_id,
            "salario" => $this->input->post('salario'),
            "fecha_ingreso" => $this->input->post('fecha'),
            "fk_departamento" => $this->input->post('departamento')
        );

        $this->DAO->insertar_tabla('empleados', $datos_empleado);

        if($this->DAO->validar_transaccion()){
            echo "Si guardo";
        } else{
            echo "Error, algo ha salido mal";
        }
    }

    function ver_detalle($clave = NULL){
        if($clave){
            $empleado_existe = $this->DAO->obtener_id('empleados',$clave);

            if($empleado_existe){
                $data['empleado_seleccionado'] = $empleado_existe;
                $data['empleados'] = $this->EmpleadosDAO->listar_empleados();
                $data['departamentos'] = $this->DepartamentosDAO->listar_departamentos();
                $this->load->view('empleados/empleados_pagina', $data);
            } else{
                $this->session->set_flashdata('mensaje', 'La clave no existe');
                redirect('empleados');
            } 
        } else{
            $this->session->set_flashdata('mensaje', 'Parámetro no enviado');
            redirect('empleados');
        }
    }
}