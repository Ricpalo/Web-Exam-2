<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

    <title>Productos</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="#">SW17</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=site_url('carreras')?>">Carreras</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=site_url('universidades')?>">Universidades</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=site_url('categorias')?>">Categorias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=site_url('departamentos')?>">Departamentos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=site_url('personas')?>">Personas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=site_url('empleados')?>">Empleados</a>
                </li>
			</ul>
		</div>
	</nav>

	<div class="container-fluid">
        <div class="row mt-2">
            <div class="col-12">
                <form action="<?=site_url('productos/registrar_producto/'.@$producto_seleccionado->codigo_barras);?>" method="post">
                    <div class="row">
                        <div class="col-4 form-group">
                            <label for="codigo">Codigo de Barras:</label>
                            <input type="text" class="form-control" name="codigo" value="<?=@$producto_seleccionado->codigo_barras;?>">
                            <small class="help-text text-danger"><?=@$this->session->flashdata('errores')['codigo'];?></small>
                        </div>

                        <div class="col-4 form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" name="nombre" value="<?=@$producto_seleccionado->nombre;?>">
                            <small class="help-text text-danger"><?=@$this->session->flashdata('errores')['nombre'];?></small>
                        </div>

                        <div class="col-4 form-group">
                            <label for="precio_compra">Precio de Compra:</label>
                            <input type="text" class="form-control" name="precio_compra" value="<?=@$producto_seleccionado->precio_compra;?>">
                            <small class="help-text text-danger"><?=@$this->session->flashdata('errores')['precio_compra'];?></small>
                        </div>

                        <div class="col-4 form-group">
                            <label for="precio_venta">Precio de Venta:</label>
                            <input type="text" class="form-control" name="precio_venta" value="<?=@$producto_seleccionado->precio_venta;?>">
                            <small class="help-text text-danger"><?=@$this->session->flashdata('errores')['precio_venta'];?></small>
                        </div>

                        <div class="col-4 form-group">
                            <label for="descripcion">Descripcion:</label>
                            <input type="text" class="form-control" name="descripcion" value="<?=@$producto_seleccionado->descripcion;?>">
                            <small class="help-text text-danger"><?=@$this->session->flashdata('errores')['descripcion'];?></small>
                        </div>


                        <div class="col-4 form-group">
                            <label for="categoria">Categoria</label>
                            <select name="categoria" class="form-control">
                                <option value="" selected disabled>--Selecciona una opcion--</option>
                                <?php foreach ($categorias as $categoria){ ?>
                                    <option value="<?=$categoria->id;?>" <?=@$producto_seleccionado->fk_categoria == $categoria->id ? 'selected' : '';?>><?=$categoria->nombre_categoria;?></option>
                                <?php } ?>
                            </select>
                            <small class="help-text text-danger"><?=@$this->session->flashdata('errores')['categoria'];?></small>
                        </div>
                    </div>
                    <?php if(@$producto_seleccionado) { ?>
                        <a href="<?=site_url('productos/borrar_producto/'.$producto_seleccionado->codigo_barras)?>" class="btn btn-danger">Borrar</a>
                    <?php } ?>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12">
                <table id="table_productos" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Codigo de Barras</th>
                            <th>Nombre</th>
                            <th>Precio de Compra</th>
                            <th>Precio de Venta</th>
                            <th>Descripcion</th>
                            <th>Categoria</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($productos as $producto) { ?>
                            <tr>
                                <td><?=$producto->codigo_barras;?></td>
                                <td><?=$producto->nombre;?></td>
                                <td><?=$producto->precio_compra;?></td>
                                <td><?=$producto->precio_venta;?></td>
                                <td><?=$producto->descripcion;?></td>
                                <td><?=$producto->nombre_categoria;?></td>
                                <td>
                                    <a href="<?=site_url('productos/ver_detalle/'.$producto->codigo_barras);?>" class="btn btn-info">Ver detalle</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
	</div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src=""></script>
    <!-- https://code.jquery.com/jquery-3.5.1.js -->
  </body>
  <script>
    $(function(){
        $('#table_productos').DataTable();
    });
  </script>
</html>