<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

    <title>Empleados</title>
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
                    <a class="nav-link" href="<?=site_url('productos')?>">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=site_url('departamentos')?>">Departamentos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=site_url('personas')?>">Personas</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Empleados</a>
                </li>
			</ul>
		</div>
	</nav>

	<div class="container-fluid">
        <div class="row mt-2">
            <div class="col-12">
                <form action="<?=site_url('empleados/registrar_empleado/'.@$empleado_seleccionado->id);?>" method="post">
                    <div class="row">
                        <div class="col-4 form-group">
                            <label for="nombre">Nombres:</label>
                            <input type="text" class="form-control" name="nombre">
                            <small class="help-text text-danger"><?=@$this->session->flashdata('errores')['nombre'];?></small>
                        </div>

                        <div class="col-4 form-group">
                            <label for="apellidos">Apellidos:</label>
                            <input type="text" class="form-control" name="apellidos" value="<?=@$alumno_seleccionado->alumno_nombre;?>">
                            <small class="help-text text-danger"><?=@$this->session->flashdata('errores')['apellidos'];?></small>
                        </div>

                        <div class="col-4 form-group">
                            <label for="genero">G&eacute;nero</label>
                            <?php
                                $generos = array(
                                    array(
                                        "nombre" => "Femenino",
                                        "valor" => "F"
                                    ),
                                    array(
                                        "nombre" => "Masculino",
                                        "valor" => "M"
                                    )
                                );
                            ?>
                            <select name="genero" class="form-control">
                                <option value="" selected disabled>--Selecciona una opcion--</option>
                                <?php foreach ($generos as $genero){ ?>
                                    <option value="<?=$genero['valor'];?>" <?=@$persona_seleccionada->genero == $genero['valor'] ? 'selected' : '';?>><?=$genero['nombre'];?></option>
                                <?php } ?>
                            </select>
                            <small class="help-text text-danger"><?=@$this->session->flashdata('errores')['genero'];?></small>
                        </div>

                        <div class="col-4 form-group">
                            <label for="nacimiento">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" name="nacimiento">
                        </div>

                        <div class="col-4 form-group">
                            <label for="curp">Curp:</label>
                            <input type="text" class="form-control" name="curp">
                            <small class="help-text text-danger"><?=@$this->session->flashdata('errores')['apellidos'];?></small>
                        </div>

                        <div class="col-4 form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" name="email">
                            <small class="help-text text-danger"><?=@$this->session->flashdata('errores')['apellidos'];?></small>
                        </div>

                        <div class="col-4 form-group">
                            <label for="telefono">Telefono:</label>
                            <input type="tel" class="form-control" name="telefono">
                            <small class="help-text text-danger"><?=@$this->session->flashdata('errores')['apellidos'];?></small>
                        </div>

                        <div class="col-4 form-group">
                            <label for="numero">Numero de Empleado:</label>
                            <input type="text" class="form-control" name="numero">
                            <small class="help-text text-danger"><?=@$this->session->flashdata('errores')['apellidos'];?></small>
                        </div>

                        <div class="col-4 form-group">
                            <label for="rfc">RFC:</label>
                            <input type="text" class="form-control" name="rfc">
                            <small class="help-text text-danger"><?=@$this->session->flashdata('errores')['apellidos'];?></small>
                        </div>

                        <div class="col-4 form-group">
                            <label for="salario">Salario:</label>
                            <input type="text" class="form-control" name="salario">
                            <small class="help-text text-danger"><?=@$this->session->flashdata('errores')['apellidos'];?></small>
                        </div>

                        <div class="col-4 form-group">
                            <label for="fecha">Fecha de Ingreso:</label>
                            <input type="date" class="form-control" name="fecha">
                            <small class="help-text text-danger"><?=@$this->session->flashdata('errores')['apellidos'];?></small>
                        </div>

                        <div class="col-4 form-group">
                            <label for="departamento">Departamento</label>
                            <select name="departamento" class="form-control">
                                <option value="" selected disabled>--Selecciona una opcion--</option>
                                <?php foreach ($departamentos as $departamento){ ?>
                                    <option value="<?=$departamento->id;?>"><?=$departamento->nombre_departamento;?></option>
                                <?php } ?>
                            </select>
                            <small class="help-text text-danger"><?=@$this->session->flashdata('errores')['grupo'];?></small>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12">
                <table id="table_empleados" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Numero Empleado</th>
                            <th>RFC</th>
                            <th>Persona</th>
                            <th>Salario</th>
                            <th>Fecha de Ingreso</th>
                            <th>Departamento</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($empleados as $empleado) { ?>
                            <tr>
                                <td><?=$empleado->no_empleado;?></td>
                                <td><?=$empleado->rfc;?></td>
                                <td><?=$empleado->fk_persona;?></td>
                                <td><?=$empleado->salario;?></td>
                                <td><?=$empleado->fecha_ingreso;?></td>
                                <td><?=$empleado->nombre_departamento;?></td>
                                <td>
                                    <a href="<?=site_url('empleados/ver_detalle/'.$empleado->id);?>" class="btn btn-info">Ver detalle</a>
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
        $('#table_empleados').DataTable();
    });
  </script>
</html>