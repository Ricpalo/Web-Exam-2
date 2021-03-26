<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {
	function __construct(){
		parent::__construct();
        $this->load->model('CategoriasDAO');
        $this->load->model('ProductosDAO');
    }

    function index(){
        $data['categorias'] = $this->CategoriasDAO->listar_categorias();
        $data['productos'] = $this->ProductosDAO->listar_productos();
        $this->load->view('productos/productos_pagina', $data);
    }

    function registrar_producto($clave = NULL){
        $this->form_validation->set_rules('codigo', 'Codigo de Barras', 'required|min_length[18]|max_length[18]');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]|max_length[120]');
        $this->form_validation->set_rules('precio_compra', 'Precio de Compra', 'required');
        $this->form_validation->set_rules('precio_venta', 'Precio de Venta', 'required');
        $this->form_validation->set_rules('descripcion', 'Descripcion', 'required');
        $this->form_validation->set_rules('categoria', 'Categoria', 'callback_validar_categoria');

        if($this->form_validation->run()){
            $datos = array(
                "codigo_barras" => $this->input->post('codigo'),
                "nombre" => $this->input->post('nombre'),
                "precio_compra" => $this->input->post('precio_compra'),
                "precio_venta" => $this->input->post('precio_venta'),
                "descripcion" => $this->input->post('descripcion'),
                "fk_categoria" => $this->input->post('categoria')
            );

            if($clave){
                $existe_producto = $this->ProductosDAO->obtener_producto_id($clave);

                if($existe_producto){
                    $id = $clave;

                    $this->ProductosDAO->editar_producto($datos, $id);
                    $this->session->set_flashdata('mensaje', 'Modificado Correcto');
                } else{
                    $this->session->set_flashdata('mensaje', 'La clave enviada no existe');
                }
            } else{
                $this->ProductosDAO->registrar_producto($datos);
                $this->session->set_flashdata('mensaje', 'Registro Correcto');
            }

            redirect('productos');
        } else{
            $this->session->set_flashdata('errores', $this->form_validation->error_array());
            if($clave){
                $id = $clave;
                redirect('productos/ver_detalle/clave/'. $id);
            } else{
                redirect('productos');
            }
        }
    }

    function validar_categoria($value){
        if($value){
            $existe_categoria = $this->CategoriasDAO->obtener_categoria_id($value);

            if($existe_categoria){
                return TRUE;
            } else{
                $this->form_validation->set_message('validar_categoria', 'El campo {field} no existe');
            }
        } else{
            $this->form_validation->set_message('validar_categoria', 'El campo {field} es requerido');
            return FALSE;
        }
    }

    function ver_detalle($clave = NULL){
        if($clave){
            $producto_existe = $this->ProductosDAO->obtener_producto_id($clave);

            if($producto_existe){
                $data['producto_seleccionado'] = $producto_existe;
                $data['productos'] = $this->ProductosDAO->listar_productos();
                $data['categorias'] = $this->CategoriasDAO->listar_categorias();
                $this->load->view('productos/productos_pagina', $data);
            } else{
                $this->session->set_flashdata('mensaje', 'La clave no existe');
                redirect('productos');
            } 
        } else{
            $this->session->set_flashdata('mensaje', 'Parámetro no enviado');
            redirect('productos');
        }
    }

    function borrar_producto($clave = NULL){
        if($clave){
            $producto_existe = $this->ProductosDAO->obtener_producto_id($clave);

            if($producto_existe){
                $id = $clave;
                $this->ProductosDAO->borrar_producto($id);
                $this->session->set_flashdata('mensaje', 'Borrado Correcto');
                redirect('productos');
            } else{
                $this->session->set_flashdata('mensaje', 'La clave enviada no existe');
                redirect('productos');
            }
        } else{
            $this->session->set_flashdata('mensaje', 'Parámetro no enviado');
            redirect('productos');
        }
    }
}