<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Personas extends CI_Controller {
	function __construct(){
		parent::__construct();
        $this->load->model('PersonasDAO');
    }

    function index(){
        $data['personas'] = $this->PersonasDAO->listar_personas();
        $this->load->view('personas/personas_pagina', $data);
    }

    function registrar_persona($clave = NULL){
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]|max_length[120]');
        $this->form_validation->set_rules('apellidos', 'Apellidos', 'required|min_length[3]|max_length[120]');
        $this->form_validation->set_rules('genero', 'Genero', 'required|in_list[F, M]');
        $this->form_validation->set_rules('fecha', 'Fecha de Nacimiento', 'required');
        $this->form_validation->set_rules('curp', 'Curp', 'required|is_unique[personas.curp]');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[personas.curp]');
        $this->form_validation->set_rules('telefono', 'Telefono', 'required|is_unique[personas.curp]');

        if($this->form_validation->run()){
            $datos = array(
                "nombre_persona" => $this->input->post('nombre'),
                "apellidos" => $this->input->post('apellidos'),
                "genero" => $this->input->post('genero'),
                "fecha_nacimiento" => $this->input->post('fecha'),
                "curp" => $this->input->post('curp'),
                "email" => $this->input->post('email'),
                "telefono" => $this->input->post('telefono')
            );

            if($clave){
                $existe_persona = $this->PersonasDAO->obtener_persona_id($clave);

                if($existe_persona){
                    $id = $clave;

                    $this->PersonasDAO->editar_persona($datos, $id);
                    $this->session->set_flashdata('mensaje', 'Modificado Correcto');
                } else{
                    $this->session->set_flashdata('mensaje', 'La clave enviada no existe');
                }
            } else{
                $this->PersonasDAO->registrar_persona($datos);
                $this->session->set_flashdata('mensaje', 'Registro Correcto');
            }

            redirect('personas');
        } else{
            $this->session->set_flashdata('errores', $this->form_validation->error_array());
            if($clave){
                $id = $clave;
                redirect('personas/ver_detalle/clave/'. $id);
            } else{
                redirect('personas');
            }
        }
    }

    function ver_detalle($clave = NULL){
        if($clave){
            $persona_existe = $this->PersonasDAO->obtener_persona_id($clave);

            if($persona_existe){
                $data['persona_seleccionada'] = $persona_existe;
                $data['personas'] = $this->PersonasDAO->listar_personas();
                $this->load->view('personas/personas_pagina', $data);
            } else{
                $this->session->set_flashdata('mensaje', 'La clave no existe');
                redirect('personas');
            } 
        } else{
            $this->session->set_flashdata('mensaje', 'Parámetro no enviado');
            redirect('personas');
        }
    }

    function borrar_persona($clave = NULL){
        if($clave){
            $persona_existe = $this->PersonasDAO->obtener_persona_id($clave);

            if($persona_existe){
                $id = $clave;
                $this->PersonasDAO->borrar_persona($id);
                $this->session->set_flashdata('mensaje', 'Borrado Correcto');
                redirect('personas');
            } else{
                $this->session->set_flashdata('mensaje', 'La clave enviada no existe');
                redirect('personas');
            }
        } else{
            $this->session->set_flashdata('mensaje', 'Parámetro no enviado');
            redirect('personas');
        }
    }
}