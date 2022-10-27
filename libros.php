<?php error_reporting(1); 

session_start();

if ($_SESSION['privilegio'] == "1") 
{
 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Libros</title>
        <link rel="icon" type="img/png" href="img/12.png">
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">


<?php 
require 'bd/conexion_bd.php';

 $obj = new BD_PDO();

  if (isset($_POST['btninsertar'])) 
       {
          if ($_POST['btninsertar']=='Insertar') 
         {
         // Ruta donde se concentraran las imagenes
        $dir_subida = 'archivos/img/';
        // Obtenemos el nombre del archivo a subir
        $nombre_archivo = basename($_FILES['txtimagen']['name']);
        // Se prepara una variable con la ruta y el nombre del archivo para subirlo
        $fichero_subido = $dir_subida . $nombre_archivo;


        // Ruta donde se concentraran los archivos
        $dir_subida_arch = 'archivos/libros/';
        // Obtenemos el nombre del archivo a subir
        $nombre_archivo2 = basename($_FILES['txtarch']['name']);
        // Se prepara una variable con la ruta y el nombre del archivo para subirlo
        $fichero_subido2 = $dir_subida_arch . $nombre_archivo2;

        move_uploaded_file($_FILES['txtarch']['tmp_name'], $fichero_subido2);
 
         if (move_uploaded_file($_FILES['txtimagen']['tmp_name'], $fichero_subido))
         {
        //echo "El fichero es válido y se subió con éxito.\n";
         $obj->Ejecutar_Instruccion("insert into libros(NombreLib,LibroArch,imagen,Edicion,Categoria,Autor) values ('".$_POST['txtNombrelib']."','".$fichero_subido2."','".$fichero_subido."','".$_POST['txtedicion']."','".$_POST['txtCategoria']."','".$_POST['txtAutor']."')");  
         }
        
        }
         else
         {
          $obj->Ejecutar_Instruccion("insert into libros(NombreLib,LibroArch,Edicion,Categoria,Autor) values ('".$_POST['txtNombrelib']."','".$_POST['txtarch']."','".$_POST['txtedicion']."','".$_POST['txtCategoria']."','".$_POST['txtAutor']."')");
         }
    }    
         // else
         // {
         //  $obj->Ejecutar_Instruccion("update libros set IdLibro='".$_POST['txtIDlibro']."',NombreLib='".$_POST['txtNombrelib']."',LibroArch='".$_POST['txtarch']."',imagen='".$_POST['txtimagen']."',Edicion='".$_POST['txtedicion']."',Categoria='".$_POST['txtCategoria']."',Autor='".$_POST['txtAutor']."' where IdLibro='".$_POST['txtIDlibro']."'");
         // }
     
       elseif (isset($_GET['id_eliminar']))
       {
           $obj->Ejecutar_Instruccion("delete from libros where IdLibro = '".$_GET['id_eliminar']."'");
       }
       elseif (isset($_GET['id_modificar'])) 
        {
            $libro_modificar = $obj->Ejecutar_Instruccion("select * from libros where IdLibro = '".$_GET['id_modificar']."'");         
        }


         $registros = $obj->Ejecutar_Instruccion("Select IdLibro , NombreLib, LibroArch, imagen, Edicion, Categoria, Autor, Nombre_cat, Nombre_aut, Apellidos from libros 
          inner JOIN categorias on libros.Categoria = categorias.Id_categoria
          inner JOIN autores on libros.Autor = autores.Id_autor 
          where NombreLib like '%".$_POST['txtbuscar']."%'");



//Accion para mostrar las categorias
          @$MostrarCat = $obj->Ejecutar_Instruccion("Select * from categorias");
//Accion para mostrar los autores
          @$MostrarAu = $obj->Ejecutar_Instruccion("Select * from autores");
 ?>



        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
            <div class="container px-4">
                <a class="navbar-brand" href="#page-top">He'Books Digital</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link" href="#Reseña">Nuevo libro</a></li>
                        <li class="nav-item"><a class="nav-link" href="#opiniones">Buscar</a></li>
                        <!--li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li-->
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg- bg-gradient text-white" style="background-color: #72CC">
            <div class="container px-4 text-center">
                <h1 class="fw-bolder">Libros</h1>
                <p class="lead">Encuentra los mejores libros</p>
                <a class="btn btn-lg btn-light" href="#Reseña">Empezemos</a>
            </div>
        </header><br><br><br><br><br><br>


 <form action="libros.php" class="bg-light" method="post" id="Reseña" enctype="multipart/form-data"><br>
  <div class="container" align="center" style="">
   
   <h2>Libros</h2><br><br>
<div class="row">

    <input type="text" name="txtIDlibro" id="txtIDlibro" style="display: none;" value="<?php echo @$libro_modificar[0]['IdLibro']; ?>">

<div class="col-md-4">
    <label>Libro</label>
    <input placeholder="Nombre del libro" name="txtNombrelib" id="txtNombrelib" type="text" class="form-control" value="<?php echo @$libro_modificar[0]['NombreLib']; ?>">

</div>

<br>
<div class="col-md-4">
    <label>Archivo</label>
   <input type="file" name="txtarch" id="txtarch" class="form-control" value="<?php echo @$libro_modificar[0]['LibroArch']; ?>">
</div>

<div class="col-md-4">
    <label>Imagen</label>
    <input type="file" name="txtimagen" id="txtimagen" enctype="multipart/form-data" class="form-control" value="<?php echo @$libro_modificar[0]['imagen']; ?>"><br><br>
</div>


<div class="col-md-2">
    <label>Edicion</label>
    <input placeholder="Año del libro" type="number" name="txtedicion" id="txtedicion" class="form-control" value="<?php echo @$libro_modificar[0]['Edicion']; ?>">
</div>

<div class="col-md-5">
    <label>Categoria</label>
    <select name="txtCategoria" id="txtCategoria" type="text" class="form-control">
  <option value="">Seleccione la categoria</option>

            <?php foreach (@$MostrarCat as $UnaCat) { ?>
            <option value="<?php echo @$UnaCat['Id_categoria'];?>"

            <?php if ($UnaCat[0]==@$libro_modificar[0]['Categoria'])

                {echo 'Selected'; } ?>><br>

                <?php echo @$UnaCat['Nombre_cat'];?></option >
            <?php } ?>
    </select>
</div>

<div class="col-md-5">
    <label>Autor</label>
    <select name="txtAutor" id="txtAutor" type="text" class="form-control">
  <option value="">Seleccione el Autor</option>

            <?php foreach (@$MostrarAu as $UnAu) { ?>
            <option value="<?php echo @$UnAu['Id_autor'];?>"

            <?php if ($UnAu[0]==@$libro_modificar[0]['Autor'])

                {echo 'Selected'; } ?>>

                <?php echo @$UnAu['Nombre_aut']." ".@$UnAu['Apellidos'];?></option >
            <?php } ?>
    </select>
</div>
<br><br>


<br><br>
<div class="row">
    <div class="col-md-5"></div>
    <div class="col-md-2">
<input class="btn btn-success" type="submit" name="btninsertar" value="<?php 
                        
                        if (isset($_GET['id_modificar']))
                        {
                            echo 'Modificar';
                        }
                        else
                        {
                            echo 'Insertar';
                        }            ?>"></div>
 <div class="col-md-5"></div>
</div>

   </div> 
  </div><br>
</form>
<br><br>
            
<br><br><br><br><hr>       

<!---Seccion de buscar--->
 <form action="libros.php.#buscar" method="post" class="container" id="opiniones">
        <h1>Busca las reseñas por el libro</h1>
        <br>
        <label>Nombre del libro</label>
        <input type="text" name="txtbuscar" id="txtbuscar">
        <input type="submit" name="btnbuscar" id="btnbuscar" value="Buscar" class="btn btn-info">
        <br><br><br>
        <div class="table-responsive">
        <table class="table table-bordered table-dark" style="border-radius: 20px;">
            <tr align="center">
                <td>ID Libros</td>
                <td>Nombre del libro</td>
                <td>Archivo</td>
                <td>Imagen</td>
                <td>Edicion</td>
                <td>Categoria</td>
                <td>Autor</td>
                <?php if ($_SESSION['privilegio'] == "1") 
                { ?>
                <td style="text-align: center" colspan="3">Acciones</td>
                <?php } ?>
            </tr>
            <?php foreach ($registros as $renglon ) {  ?>
                
                <tr align="center">
                <td><?php echo $renglon['IdLibro']; ?></td>
                <td><?php echo $renglon['NombreLib']; ?></td>
                <td><?php echo $renglon['LibroArch']; ?></td>
                <td><img src="<?php echo $renglon['imagen']; ?>" height="120" width="90"></td>
                <td><?php echo $renglon['Edicion']; ?></td>
                <td><?php echo $renglon['Nombre_cat']; ?></td>
                <td><?php echo $renglon['Nombre_aut']." ".$renglon['Apellidos']; ?></td>

          <?php if ($_SESSION['privilegio'] == "1") 
            { ?>
                <td><a onclick="return ConfirmarEliminar()" class="btn btn-danger" href="libros.php?id_eliminar=<?php echo $renglon['IdLibro']; ?>#buscar">Eliminar</a></td>
                <td><a class="btn btn-primary" href="VistaLibros.php">Biblioteca</a></td>
                <!-- <td><a class="btn btn-success" href="libros.php?id_modificar=<?php echo $renglon['IdLibro'] ?>#registro">Modificar</a></td> -->
                <!-- <td><a class="btn btn-warning" href="<?php echo $renglon['LibroArch']; ?>" download="<?php echo $nombre_archivo2; ?>">Descargar</a></td> -->
            <?php } ?>
            </tr>
        <?php }?>
        
        </table>
        </form>

       
        <br><br><br>

            <footer class="py-5 bg-dark" id="fin">
                <div class="container px-4"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p></div>
            </footer>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
<?php 
}
header("Location: index.php");
 ?>
