<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

    <title>Personas</title>
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
                    <a class="nav-link" href="<?=site_url('departamentos')?>">Departamentos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">Personas</a>
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
                <table id="table_personas" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Genero</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Curp</th>
                            <th>Email</th>
                            <th>Telefono</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($personas as $persona) { ?>
                            <tr>
                                <td><?=$persona->nombre_persona;?></td>
                                <td><?=$persona->apellidos;?></td>
                                <td><?=$persona->genero;?></td>
                                <td><?=$persona->fecha_nacimiento;?></td>
                                <td><?=$persona->curp;?></td>
                                <td><?=$persona->email;?></td>
                                <td><?=$persona->telefono;?></td>
                                <td>
                                    <a href="<?=site_url('personas/ver_detalle/'.$persona->id);?>" class="btn btn-info">Ver detalle</a>
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
        $('#table_personas').DataTable();
    });
  </script>
</html>