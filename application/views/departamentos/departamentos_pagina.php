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
                    <a class="nav-link" href="<?=site_url('categorias')?>">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">Departamentos</a>
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
                <form action="<?=site_url('departamentos/registrar_departamento/'.@$departamento_seleccionado->id);?>" method="post">
                    <div class="row">
                        <div class="col-4 form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" name="nombre" value="<?=@$departamento_seleccionado->nombre_departamento;?>">
                            <small class="help-text text-danger"><?=@$this->session->flashdata('errores')['nombre'];?></small>
                        </div>
                        <div class="col-4 form-group">
                            <label for="clave">Clave:</label>
                            <input type="text" class="form-control" name="clave" value="<?=@$departamento_seleccionado->clave;?>">
                            <small class="help-text text-danger"><?=@$this->session->flashdata('errores')['clave'];?></small>
                        </div>
                    </div>
                    <?php if(@$departamento_seleccionado) { ?>
                        <a href="<?=site_url('departamentos/borrar_departamento/'.$departamento_seleccionado->id)?>" class="btn btn-danger">Borrar</a>
                    <?php } ?>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12">
                <table id="table_departamentos" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Clave</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($departamentos as $departamento) { ?>
                            <tr>
                                <td><?=$departamento->nombre_departamento;?></td>
                                <td><?=$departamento->clave;?></td>
                                <td>
                                    <a href="<?=site_url('departamentos/ver_detalle/'.$departamento->id);?>" class="btn btn-info">Ver detalle</a>
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
        $('#table_departamentos').DataTable();
    });
  </script>
</html>