<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carreras extends CI_Controller {
	function __construct(){
		parent::__construct();
        $this->load->model('CarrerasDAO');
    }

    function index(){
        $data['carreras'] = $this->CarrerasDAO->listar_carreras();
        $this->load->view('carreras/carreras_pagina', $data);
    }

    function registrar_carrera($clave = NULL){
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]|max_length[120]');
        $this->form_validation->set_rules('clave', 'Clave', 'required');

        if($this->form_validation->run()){
            $datos = array(
                "nombre" => $this->input->post('nombre'),
                "clave" => $this->input->post('clave')
            );

            if($clave){
                $existe_carrera = $this->CarrerasDAO->obtener_carrera_id($clave);

                if($existe_carrera){
                    $id = $clave;

                    $this->CarrerasDAO->editar_carrera($datos, $id);
                    $this->session->set_flashdata('mensaje', 'Modificado Correcto');
                } else{
                    $this->session->set_flashdata('mensaje', 'La clave enviada no existe');
                }
            } else{
                $this->CarrerasDAO->registrar_carrera($datos);
                $this->session->set_flashdata('mensaje', 'Registro Correcto');
            }

            redirect('carreras');
        } else{
            $this->session->set_flashdata('errores', $this->form_validation->error_array());
            if($clave){
                $id = $clave;
                redirect('carreras/ver_detalle/clave/'. $id);
            } else{
                redirect('carreras');
            }
        }
    }

    function ver_detalle($clave = NULL){
        if($clave){
            $carrera_existe = $this->CarrerasDAO->obtener_carrera_id($clave);

            if($carrera_existe){
                $data['carrera_seleccionada'] = $carrera_existe;
                $data['carreras'] = $this->CarrerasDAO->listar_carreras();
                $this->load->view('carreras/carreras_pagina', $data);
            } else{
                $this->session->set_flashdata('mensaje', 'La clave no existe');
                redirect('carreras');
            } 
        } else{
            $this->session->set_flashdata('mensaje', 'Parámetro no enviado');
            redirect('carreras');
        }
    }

    function borrar_carrera($clave = NULL){
        if($clave){
            $carrera_existe = $this->CarrerasDAO->obtener_carrera_id($clave);

            if($carrera_existe){
                $id = $clave;
                $this->CarrerasDAO->borrar_carrera($id);
                $this->session->set_flashdata('mensaje', 'Borrado Correcto');
                redirect('carreras');
            } else{
                $this->session->set_flashdata('mensaje', 'La clave enviada no existe');
                redirect('carreras');
            }
        } else{
            $this->session->set_flashdata('mensaje', 'Parámetro no enviado');
            redirect('carreras');
        }
    }
}