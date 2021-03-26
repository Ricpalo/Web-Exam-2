<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends CI_Controller {
	function __construct(){
		parent::__construct();
        $this->load->model('CategoriasDAO');
    }

    function index(){
        $data['categorias'] = $this->CategoriasDAO->listar_categorias();
        $this->load->view('categorias/categorias_pagina', $data);
    }

    function registrar_categoria($clave = NULL){
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]|max_length[120]');
        $this->form_validation->set_rules('descripcion', 'Descripcion', 'required');

        if($this->form_validation->run()){
            $datos = array(
                "nombre_categoria" => $this->input->post('nombre'),
                "descripcion" => $this->input->post('descripcion')
            );

            if($clave){
                $existe_categoria = $this->CategoriasDAO->obtener_categoria_id($clave);

                if($existe_categoria){
                    $id = $clave;

                    $this->CategoriasDAO->editar_categoria($datos, $id);
                    $this->session->set_flashdata('mensaje', 'Modificado Correcto');
                } else{
                    $this->session->set_flashdata('mensaje', 'La clave enviada no existe');
                }
            } else{
                $this->CategoriasDAO->registrar_categoria($datos);
                $this->session->set_flashdata('mensaje', 'Registro Correcto');
            }

            redirect('categorias');
        } else{
            $this->session->set_flashdata('errores', $this->form_validation->error_array());
            if($clave){
                $id = $clave;
                redirect('categorias/ver_detalle/clave/'. $id);
            } else{
                redirect('categorias');
            }
        }
    }

    function ver_detalle($clave = NULL){
        if($clave){
            $categoria_existe = $this->CategoriasDAO->obtener_categoria_id($clave);

            if($categoria_existe){
                $data['categoria_seleccionada'] = $categoria_existe;
                $data['categorias'] = $this->CategoriasDAO->listar_categorias();
                $this->load->view('categorias/categorias_pagina', $data);
            } else{
                $this->session->set_flashdata('mensaje', 'La clave no existe');
                redirect('categorias');
            } 
        } else{
            $this->session->set_flashdata('mensaje', 'Parámetro no enviado');
            redirect('categorias');
        }
    }

    function borrar_categoria($clave = NULL){
        if($clave){
            $categoria_existe = $this->CategoriasDAO->obtener_categoria_id($clave);

            if($categoria_existe){
                $id = $clave;
                $this->CategoriasDAO->borrar_categoria($id);
                $this->session->set_flashdata('mensaje', 'Borrado Correcto');
                redirect('categorias');
            } else{
                $this->session->set_flashdata('mensaje', 'La clave enviada no existe');
                redirect('categorias');
            }
        } else{
            $this->session->set_flashdata('mensaje', 'Parámetro no enviado');
            redirect('categorias');
        }
    }
}