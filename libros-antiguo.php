<?php error_reporting(1);

session_start();

 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Libros</title>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
            <div class="container px-4">
                <a class="navbar-brand" href="#page-top">Start Bootstrap</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg-primary bg-gradient text-white">
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
						?> Libro</h1>
                <p class="lead">AQUI SE ENCUENTRA EL FORMULARIO PARA EL LLENADO DE DATOS DE LOS LIBROS</p>
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
                $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
				$obj->Ejecutar_Instruccion("insert into libros(NombreLib, imagen, LibroArch, Edicion, Categoria, Autor) values('".$_POST['txttitulo']."','".$_POST['$imagen']."','".$_POST['txtarchivo']."','".$_POST['txtedicion']."','".$_POST['txtcategoria']."','".$_POST['txtautor']."')");
            }
			else
			{
				$obj->Ejecutar_Instruccion("update libros set NombreLib='".$_POST['txttitulo']."', imagen='".$_POST['txtimagen']."', LibroArch='".$_POST['txtarchivo']."', Edicion='".$_POST['txtedicion']."',Categoria='".$_POST['txtcategoria']."',Autor='".$_POST['txtautor']."' where IdLibro  = '".$_POST['txtid']."'");
			}

		}
			elseif (isset($_GET['id_eliminar'])) 
		{
			$obj->Ejecutar_Instruccion("delete from libros where IdLibro  = '".$_GET['id_eliminar']."'");			
		}
		elseif (isset($_GET['id_modificar'])) 
		{
			$proveedor_modificar = $obj->Ejecutar_Instruccion("select * from libros where IdLibro  = '".$_GET['id_modificar']."'");			
		}
		
		$productos = $obj->Ejecutar_Instruccion("Select IdLibro , NombreLib, imagen, LibroArch, Edicion, Categoria, Autor from libros where NombreLib like '%".$_POST['txtbuscar']."%'");
//var_dump($productos);
//$productos = $obj->Ejecutar_Instruccion("select IdLibro, NombreLib, LibroArch, Edicion, Categoria, Autor from libros 
         // inner JOIN autores on libros.Autor = autores.Id_autor 
        //  where NombreLib like '%".$_POST['txtbuscar']."%'");


//Accion para mostrar los libros
@$Mostrarcate = $obj->Ejecutar_Instruccion("Select * from categorias");
//Accion para mostrar los autores
        @$MostrarAu = $obj->Ejecutar_Instruccion("Select * from autores");

        
		
	?>
        <section id="about"> 
            <center>
            <div class="container px-12">
                <form action="libros.php" method="post" enctype="multipart/form-data">
                        <div class="form-group" style="display: none;">
                            <label for="formGroupExampleInput"><b>ID</b></label>
                            <input type="number" id="txtid"  name="txtid" class="form-control" id="formGroupExampleInput" placeholder="id" value="<?php echo @$proveedor_modificar[0]['IdLibro']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput"><b>TITULO</b></label>
                            <input type="text" id="txttitulo" name="txttitulo" class="form-control" id="formGroupExampleInput" placeholder="Escribe el nombre del libro..." value="<?php echo @$proveedor_modificar[0]['NombreLib']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput"><b>Imagen</b></label>
                            <input type="file" id="imagen" name="imagen" class="form-control" id="formGroupExampleInput" placeholder="Selecciona la imagen" value="<?php echo @$proveedor_modificar[0]['imagen']; ?>" required>
                        </div>
                        <div class="row">
                            <div class="col">
                            <label for="exampleFormControlFile1"><b>Archivo</b></label>
                                <input type="file" id="txtarchivo" name="txtarchivo" class="form-control" placeholder="Selecciona el archivo" value="<?php echo @$proveedor_modificar[0]['LibroArch']; ?>" required>
                            </div>
                            <div class="col">
                            <label for="formGroupExampleInput"><b>Edicion</b></label>
                                <input type="text" id="txtedicion" name="txtedicion" class="form-control" placeholder="Edicion a la que pertenece el libro." value="<?php echo @$proveedor_modificar[0]['Edicion']; ?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                            <label for="exampleFormControlSelect1"><b>Categoria</b></label>
                            <select name="txtcategoria" id="txtcategoria" type="text" class="form-control">
                            <option value="">Seleccione el Libro</option>
                            <?php foreach (@$Mostrarcate as $unacate) { ?>
                                    <option value="<?php echo @$unacate['Id_categoria'];?>"

                                    <?php if ($unacate[0]==@$resena_modificar[0]['categoria'])

                                        {echo 'Selected'; } ?>>

                                        <?php echo @$unacate['Nombre_cat'];?></option >
                                    <?php } ?>
                            </select>
                            </div>
                            <div class="col">
                            <label for="exampleFormControlSelect1"><b>Autor</b></label>
                            <select name="txtautor" id="txtautor" type="text" class="form-control">
                                <option value="">Seleccione el Autor</option>

                                            <?php foreach (@$MostrarAu as $UnAu) { ?>
                                            <option value="<?php echo @$UnAu['Id_autor'];?>"

                                            <?php if ($UnAu[0]==@$resena_modificar[0]['autores'])

                                                {echo 'Selected'; } ?>>

                                                <?php echo @$UnAu['Nombre_aut']."".@$UnAu['Apellidos'];?></option >
                                            <?php } ?>
                                    </select>
                            </div>
                        </div><br><br>
                        <center>
                            <button onclick="sweetcancelar();" class="btn btn-danger mt-2">Cancelar</button>
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
                        </center>
                </form>
            </div>
            </center>
        </section>
        <div class="jumbotron text-center">
		<h1>Listado de Libros Registrados</h1>
		<form action="libros.php" method="post" enctype="multipart/form-data">
			<div class="row">
				<div class="col-lg-4" style="text-align: right;">
					<label for="" class="control" >INGRESE EL MODO DE BUSQUEDA</label>
					<select name="lsbuscar" id="lsbuscar">
						<option value="NombreLib">Nombre</option>
					</select>
				</div>
				<div class="col-lg-4">
					<input type="text" id="txtbuscar" name="txtbuscar" class="form-control">
				</div>
				<div class="col-lg-4">
                    <button type="submit" id="btnbuscar" name="btnbuscar"  value="Buscar" class="btn btn-success">BUSCAR</button>
				</div>				
			</div>
			<br>
			<table class="table table-dark table-striped">
				<tr>
					<td>ID</td>
					<td>TITULO</td>
                    <td>IMAGEN</td>
					<td>ARCHIVO</td>
					<td>EDICION</td>
					<td>CATEGORIA</td>
					<td>AUTOR</td>
					<td colspan="2" align="text-center">ACCION</td>
				</tr>
				<?php foreach ($productos as $registro) { ?>				
					<tr>					
						<td><?php echo $registro['IdLibro']; ?></td>
						<td><?php echo $registro['NombreLib']; ?></td>
                        <td><img height="120px" src="data:image/jpg;base64,<?php echo base64_encode($row['imagen']); ?>"/></td>
						<td><?php echo $registro['LibroArch']; ?></td>
						<td><?php echo $registro['Edicion']; ?></td>
						<td><?php echo $registro['Categoria']; ?></td>
						<td><?php echo $registro['Autor']; ?></td>
						<td align="text-center"><a class="btn btn-danger" href="libros.php?id_eliminar=<?php echo $registro['IdLibro']; ?>">Eliminar</a></td>
						<td align="text-center"><a class="btn btn-warning" href="libros.php?id_modificar=<?php echo $registro['IdLibro']; ?>">Modificar</a></td>
					</tr>
				<?php } ?>
		
			</table>
		</form>
	</div>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container px-4"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>

