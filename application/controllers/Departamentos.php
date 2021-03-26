<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departamentos extends CI_Controller {
	function __construct(){
		parent::__construct();
        $this->load->model('DepartamentosDAO');
    }

    function index(){
        $data['departamentos'] = $this->DepartamentosDAO->listar_departamentos();
        $this->load->view('departamentos/departamentos_pagina', $data);
    }

    function registrar_departamento($clave = NULL){
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]|max_length[120]');
        $this->form_validation->set_rules('clave', 'Clave', 'required|min_length[3]|max_length[120]');

        if($this->form_validation->run()){
            $datos = array(
                "nombre_departamento" => $this->input->post('nombre'),
                "clave" => $this->input->post('clave')
            );

            if($clave){
                $existe_departamento = $this->DepartamentosDAO->obtener_departamento_id($clave);

                if($existe_departamento){
                    $id = $clave;

                    $this->DepartamentosDAO->editar_departamento($datos, $id);
                    $this->session->set_flashdata('mensaje', 'Modificado Correcto');
                } else{
                    $this->session->set_flashdata('mensaje', 'La clave enviada no existe');
                }
            } else{
                $this->DepartamentosDAO->registrar_departamento($datos);
                $this->session->set_flashdata('mensaje', 'Registro Correcto');
            }

            redirect('departamentos');
        } else{
            $this->session->set_flashdata('errores', $this->form_validation->error_array());
            if($clave){
                $id = $clave;
                redirect('departamentos/ver_detalle/clave/'. $id);
            } else{
                redirect('departamentos');
            }
        }
    }

    function ver_detalle($clave = NULL){
        if($clave){
            $departamento_existe = $this->DepartamentosDAO->obtener_departamento_id($clave);

            if($departamento_existe){
                $data['departamento_seleccionado'] = $departamento_existe;
                $data['departamentos'] = $this->DepartamentosDAO->listar_departamentos();
                $this->load->view('departamentos/departamentos_pagina', $data);
            } else{
                $this->session->set_flashdata('mensaje', 'La clave no existe');
                redirect('departamentos');
            } 
        } else{
            $this->session->set_flashdata('mensaje', 'Parámetro no enviado');
            redirect('departamentos');
        }
    }

    function borrar_departamento($clave = NULL){
        if($clave){
            $departamento_existe = $this->DepartamentosDAO->obtener_departamento_id($clave);

            if($departamento_existe){
                $id = $clave;
                $this->DepartamentosDAO->borrar_departamento($id);
                $this->session->set_flashdata('mensaje', 'Borrado Correcto');
                redirect('departamentos');
            } else{
                $this->session->set_flashdata('mensaje', 'La clave enviada no existe');
                redirect('departamentos');
            }
        } else{
            $this->session->set_flashdata('mensaje', 'Parámetro no enviado');
            redirect('departamentos');
        }
    }
}