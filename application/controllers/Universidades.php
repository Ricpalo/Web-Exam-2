<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Universidades extends CI_Controller {
	function __construct(){
		parent::__construct();
        $this->load->model('UniversidadesDAO');
    }

    function index(){
        $data['universidades'] = $this->UniversidadesDAO->listar_universidades();
        $this->load->view('universidades/universidades_pagina', $data);
    }

    function registrar_universidad($clave = NULL){
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]|max_length[120]');
        $this->form_validation->set_rules('direccion', 'Direccion', 'required|min_length[3]|max_length[120]');
        $this->form_validation->set_rules('email', 'Email', 'required|min_length[3]|max_length[255]|is_unique[universidades.email]');
        $this->form_validation->set_rules('telefono', 'Telefono', 'required|min_length[3]|max_length[120]');

        if($this->form_validation->run()){
            $datos = array(
                "nombre" => $this->input->post('nombre'),
                "direccion" => $this->input->post('direccion'),
                "email" => $this->input->post('email'),
                "telefono" => $this->input->post('telefono')
            );

            if($clave){
                $existe_universidad = $this->UniversidadesDAO->obtener_universidad_id($clave);

                if($existe_universidad){
                    $id = $clave;

                    $this->UniversidadesDAO->editar_universidad($datos, $id);
                    $this->session->set_flashdata('mensaje', 'Modificado Correcto');
                } else{
                    $this->session->set_flashdata('mensaje', 'La clave enviada no existe');
                }
            } else{
                $this->UniversidadesDAO->registrar_universidad($datos);
                $this->session->set_flashdata('mensaje', 'Registro Correcto');
            }

            redirect('universidades');
        } else{
            $this->session->set_flashdata('errores', $this->form_validation->error_array());
            if($clave){
                $id = $clave;
                redirect('universidades/ver_detalle/clave/'. $id);
            } else{
                redirect('universidades');
            }
        }
    }

    function ver_detalle($clave = NULL){
        if($clave){
            $universidad_existe = $this->UniversidadesDAO->obtener_universidad_id($clave);

            if($universidad_existe){
                $data['universidad_seleccionada'] = $universidad_existe;
                $data['universidades'] = $this->UniversidadesDAO->listar_universidades();
                $this->load->view('universidades/universidades_pagina', $data);
            } else{
                $this->session->set_flashdata('mensaje', 'La clave no existe');
                redirect('universidades');
            } 
        } else{
            $this->session->set_flashdata('mensaje', 'Parámetro no enviado');
            redirect('universidades');
        }
    }

    function borrar_universidad($clave = NULL){
        if($clave){
            $universidad_existe = $this->UniversidadesDAO->obtener_universidad_id($clave);

            if($universidad_existe){
                $id = $clave;
                $this->UniversidadesDAO->borrar_universidad($id);
                $this->session->set_flashdata('mensaje', 'Borrado Correcto');
                redirect('universidades');
            } else{
                $this->session->set_flashdata('mensaje', 'La clave enviada no existe');
                redirect('universidades');
            }
        } else{
            $this->session->set_flashdata('mensaje', 'Parámetro no enviado');
            redirect('universidades');
        }
    }
}