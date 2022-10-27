<?php error_reporting(1);

session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Usuarios</title>
        <link rel="icon" type="img/png" href="img/12.png">
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link href="js/scripts.js" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
            <div class="container px-4">
                <a class="navbar-brand" href="#page-top">He'Books Digital</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link" href="#services">Registrar</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Buscar</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg- bg-gradient text-white" style="background-color: orange;">
            <div class="container px-4 text-center">
                <h1 class="fw-bolder">CATALOGO</h1>
                <h1 style="text-align: center;"><?php if (isset($_GET['id_modificar']))
						{
							echo 'Modificar';
						}
						else
						{
							echo 'Registrar';
						}
						?> Usuario</h1>
                <p class="lead">AQUI SE ENCUENTRA EL FORMULARIO PARA EL LLENADO DE DATOS DE LOS USUARIOS</p>
                <a class="btn btn-lg btn-light" href="#about">EMPEZEMOS!</a>
            </div>
        </header>
        <!-- About section-->
        <?php 

		require 'bd/conexion_bd.php';

		$obj = new BD_PDO();


		if (isset($_POST['btninsertar'])) 
		{
			if($_POST['btninsertar']=='Registrar')
			{
				$obj->Ejecutar_Instruccion("insert into usuarios(Nombre_usu, Apellidos, Correo, Pass, Privilegio) values('".$_POST['txttitulo']."','".$_POST['txtarchivo']."','".$_POST['txtedicion']."','".$_POST['txtcategoria']."','0')");
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                       <strong>Se registro correctamente</strong> Regrese a la pagina principal para acceder
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
			}
			else
			{
				$obj->Ejecutar_Instruccion("update usuarios set Nombre_usu='".$_POST['txttitulo']."', Apellidos='".$_POST['txtarchivo']."', Correo='".$_POST['txtedicion']."',Pass='".$_POST['txtcategoria']."',Privilegio='".$_POST['txtautor']."' where Id_usuario = '".$_POST['txtid']."'");
			}

		}
			elseif (isset($_GET['id_eliminar'])) 
		{
			$obj->Ejecutar_Instruccion("delete from usuarios where Id_usuario = '".$_GET['id_eliminar']."'");			
		}
		elseif (isset($_GET['id_modificar'])) 
		{
			$proveedor_modificar = $obj->Ejecutar_Instruccion("select * from usuarios where Id_usuario = '".$_GET['id_modificar']."'");			
		}
		
		$productos = $obj->Ejecutar_Instruccion("Select Id_usuario , Nombre_usu, Apellidos, Correo, Pass, Privilegio from usuarios where Nombre_usu like '%".$_POST['txtbuscar']."%'");
//var_dump($productos);
		
	?>
        <section id="about">
            <center>
            <div class="container px-12">
                <form action="usuario.php"method="post" onsubmit="return validacion();">
                        <div class="form-group" style="display: none;">
                            <label for="formGroupExampleInput"><b>ID</b></label>
                            <input type="number" id="txtid"  name="txtid" class="form-control" id="formGroupExampleInput" placeholder="id" value="<?php echo @$proveedor_modificar[0]['Id_usuario']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput"><b>Nombre</b></label>
                            <input type="text" id="txttitulo" name="txttitulo" class="form-control" id="formGroupExampleInput" placeholder="Escribe su nombre." value="<?php echo @$proveedor_modificar[0]['Nombre_usu']; ?>" required>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="exampleFormControlFile1"><b>Apellidos</b></label>
                                <input type="text" id="txtarchivo" name="txtarchivo" class="form-control" placeholder="ingrese su apellido" value="<?php echo @$proveedor_modificar[0]['Apellidos']; ?>" required>
                            </div>
                            <div class="col">
                                <label for="formGroupExampleInput"><b>Correo</b></label>
                                <input type="email" id="txtedicion" name="txtedicion" class="form-control" placeholder="ingrese su correo." value="<?php echo @$proveedor_modificar[0]['Correo']; ?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="exampleFormControlFile1"><b>Password</b></label>
                                <input type="password" id="txtcategoria" name="txtcategoria" class="form-control" placeholder="ingrese una contraseña." value="<?php echo @$proveedor_modificar[0]['Pass']; ?>" required>
                            </div>
                            <!--div class="col">
                                <label for="formGroupExampleInput"><b>Privilegio</b></label>
                                <input type="text" id="txtautor" name="txtautor" class="form-control" placeholder="seleccione el privilegio." value="<?php echo @$proveedor_modificar[0]['Privilegio']; ?>">
                            </div-->
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col">
                                <button class="btn btn-danger mt-2" >Cancelar</button>
                                <input type="submit" id="btninsertar" name="btninsertar" class="btn btn-primary" value="<?php 
                                    if (isset($_GET['id_modificar']))
                                    {
                                        echo 'Modificar';
                                    }
                                    else
                                    {
                                        echo 'Registrar';
                                    }			 
                                    ?>">
                            </div>
                        </div>
                </form>
            </div>
            </center>
            <?php 

            if ($_SESSION['privilegio'] == "1") 
             {
            ?>
        </section>
        <div class="jumbotron text-center">
		<h1>Listado de USUARIOS Registrados</h1>
		<form action="usuario.php" method="post">
			<br>
			<div class="row">
				<div class="col-lg-4" style="text-align: right;">
					<label for="" class="control" >INGRESE EL MODO DE BUSQUEDA</label>
					<select name="lsbuscar" id="lsbuscar">
						<option value="Nombre_usu">Nombre</option>
					</select>
				</div>
				<div class="col-lg-4">
					<input type="text" id="txtbuscar" name="txtbuscar" class="form-control">
				</div>
				<div class="col-lg-4">
					<input type="submit" id="btnbuscar" name="btnbuscar"  value="Buscar" class="btn btn-success">
				</div>				
			</div>
			<br>
			<table class="table table-dark table-striped">
				<tr>
					<td>ID</td>
					<td>NOMBRE</td>
					<td>APELLIDOS</td>
					<td>CORREO</td>
					<td>PASSWORD</td>
					<td>PRIVILEGIO</td>
					<td colspan="2" align="text-center">ACCION</td>
				</tr>
				<?php foreach ($productos as $registro) { ?>				
					<tr>					
						<td><?php echo $registro['Id_usuario']; ?></td>
						<td><?php echo $registro['Nombre_usu']; ?></td>
						<td><?php echo $registro['Apellidos']; ?></td>
						<td><?php echo $registro['Correo']; ?></td>
						<td><?php echo $registro['Pass']; ?></td>
						<td><?php echo $registro['Privilegio']; ?></td>
						<td align="text-center"><a class="btn btn-danger" href="usuario.php?id_eliminar=<?php echo $registro['Id_usuario']; ?>">Eliminar</a></td>
						<td align="text-center"><a class="btn btn-info" href="usuario.php?id_modificar=<?php echo $registro['Id_usuario']; ?>">Modificar</a></td>
					</tr>
				<?php } ?>
		
			</table>
        <?php } ?>
		</form>
	</div><br><br><br>
        <!-- Footer-->
            <footer class="py-5 bg-dark" id="fin">
                <div class="container px-4"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p></div>
            </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>