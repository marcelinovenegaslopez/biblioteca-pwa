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
        <title>Reseñas</title>
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
         $obj->Ejecutar_Instruccion("insert into reseñas(Libro,Autor,Calificacion,Opinion) values ('".$_POST['txtLibro']."','".$_POST['txtAutor']."','".$_POST['txtCalif']."','".$_POST['txtOpinion']."')");
         }
      
         else
         {
          $obj->Ejecutar_Instruccion("update reseñas set Id_rese='".$_POST['txtIDRese']."',Libro='".$_POST['txtLibro']."',Autor='".$_POST['txtAutor']."',Calificacion='".$_POST['txtCalif']."',Opinion='".$_POST['txtOpinion']."' where Id_rese='".$_POST['txtIDRese']."'");
         }
       }
       elseif (isset($_GET['id_eliminar']))
       {
           $obj->Ejecutar_Instruccion("delete from reseñas where Id_rese = '".$_GET['id_eliminar']."'");
       }
       elseif (isset($_GET['id_modificar'])) 
        {
            $resena_modificar = $obj->Ejecutar_Instruccion("select * from reseñas where Id_rese = '".$_GET['id_modificar']."'");         
        }

         //$registros = $obj->Ejecutar_Instruccion("select * from reseñas where Id_rese like '%".$_POST['txtbuscar']."%'");

         $registros = $obj->Ejecutar_Instruccion("select Id_rese, Libro, Calificacion, Opinion, NombreLib from reseñas 
          inner JOIN libros on reseñas.libro = libros.IdLibro 
          where NombreLib like '%".$_POST['txtbuscar']."%'");

        // $registros = $obj->Ejecutar_Instruccion("select id_visi,nombre_visi,apellidos_visi,compania,
        // fecha_registro,statusVisitante,id_person, nombre_com, nombre_per, apellidos_per from visitantes 
        // inner JOIN compania on visitantes.compania = compania.id_com
        // inner JOIN personal on visitantes.id_person = personal.id_per 
        // where nombre_visi like '%".@$_POST['txtbuscar']."%'");


//Accion para mostrar los libros
          @$Mostrarlib = $obj->Ejecutar_Instruccion("Select * from libros");
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
                        <li class="nav-item"><a class="nav-link" href="VistaLibros.php">Libros</a></li>
                        <li class="nav-item"><a class="nav-link" href="#Reseña">Reseña</a></li>
                        <li class="nav-item"><a class="nav-link" href="#opiniones">Opiniones</a></li>
                        <!--li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li-->
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg- bg-gradient text-white" style="background-color: #72CC50">
            <div class="container px-4 text-center">
                <h1 class="fw-bolder">Reseñas</h1>
                <p class="lead">Da las opiniones de tus libros favoritos, y como te parecieron!</p>
                <a class="btn btn-lg btn-light" href="#Reseña">Da tu opinion</a>
            </div>
        </header><br><br><br><br><br><br>


 <form action="resenas.php" class="bg-light" method="post" id="Reseña"><br>
  <div class="container" align="center" style="">
   
   <h2>Opinion</h2><br><br>
<div class="row">

    <input type="text" name="txtIDRese" id="txtIDRese" style="display: none;" value="<?php echo @$resena_modificar[0]['Id_rese']; ?>">

<div class="col-md-4">
    <label>Libro</label>
    <select name="txtLibro" id="txtLibro" type="text" class="form-control">
  <option value="">Seleccione el Libro</option>

            <?php foreach (@$Mostrarlib as $Unlib) { ?>
            <option value="<?php echo @$Unlib['IdLibro'];?>"

            <?php if ($Unlib[0]==@$resena_modificar[0]['Libro'])

                {echo 'Selected'; } ?>>

                <?php echo @$Unlib['NombreLib'];?></option >
            <?php } ?>
    </select>
</div>

<br>
<div class="col-md-5">
    <label>Autor</label>
    <select name="txtAutor" id="txtAutor" type="text" class="form-control">
  <option value="">Seleccione el Autor</option>

            <?php foreach (@$MostrarAu as $UnAu) { ?>
            <option value="<?php echo @$UnAu['Id_autor'];?>"

            <?php if ($UnAu[0]==@$resena_modificar[0]['Autor'])

                {echo 'Selected'; } ?>>

                <?php echo @$UnAu['Nombre_aut']."".@$UnAu['Apellidos'];?></option >
            <?php } ?>
    </select>
</div>


<div class="col-md-3"><br>
    <label>Calificacion</label>
    <input type="range" name="txtCalif" id="txtCalif" class="" max="10" min="1" value="<?php echo @$resena_modificar[0]['Calificacion']; ?>"><br>
</div>

<br><br>

<div class="row">
    <div class="col-md-2"></div><br>
    <div class="col-md-8"><br>
    <label>Opinion</label>
    <textarea class="form-control" name="txtOpinion"><?php echo @$resena_modificar[0]['Opinion']; ?></textarea><br>
    </div>  
    <div class="col-md-2"></div>
</div>

<br>
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
 <form action="resenas.php.#buscar" method="post" class="container" id="opiniones">
        <h1>Busca las reseñas por el libro</h1>
        <br>
        <label>Nombre del libro</label>
        <input type="text" name="txtbuscar" id="txtbuscar">
        <input type="submit" name="btnbuscar" id="btnbuscar" value="Buscar" class="btn btn-info">
        <br><br><br>
        <div class="table-responsive">
        <table class="table table-bordered table-dark" style="border-radius: 20px;">
            <tr align="center">
                <td>ID Libro</td>
                <td>Libro</td>
                <td>Calificacion</td>
                <td>Opinion</td>
                <?php if ($_SESSION['privilegio'] == "1") 
                { ?>
                <td style="text-align: center" colspan="2">Acciones</td>
                <?php } ?>
            </tr>
            <?php foreach ($registros as $renglon ) {  ?>
                
                <tr align="center">
                <td><?php echo $renglon['Id_rese']; ?></td>
                <td><?php echo $renglon['NombreLib']; ?></td>
                <td><?php echo $renglon['Calificacion']; ?></td>
                <td><?php echo $renglon['Opinion']; ?></td>

          <?php if ($_SESSION['privilegio'] == "1") 
            { ?>
                <td><a onclick="return ConfirmarEliminar()" class="btn btn-danger" href="resenas.php?id_eliminar=<?php echo $renglon['Id_rese']; ?>#buscar">Eliminar</a></td>
                <td><a class="btn btn-success" href="resenas.php?id_modificar=<?php echo $renglon['Id_rese'] ?>#registro">Modificar</a></td>
            <?php } ?>
            </tr>
        <?php }?>
        
        </table>
        </form>

        <!-- Services section-->
<!--         <section class="bg-light" id="services">
            <div class="container px-4">
                <div class="row gx-4 justify-content-center">
                    <div class="col-lg-8">
                        <h2>Services we offer</h2>
                        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut optio velit inventore, expedita quo laboriosam possimus ea consequatur vitae, doloribus consequuntur ex. Nemo assumenda laborum vel, labore ut velit dignissimos.</p>
                    </div>
                </div>
            </div>
        </section>
        <-- Contact section-->
        <!--section id="contact">
            <div class="container px-4">
                <div class="row gx-4 justify-content-center">
                    <div class="col-lg-8">
                        <h2>Contact us</h2>
                        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero odio fugiat voluptatem dolor, provident officiis, id iusto! Obcaecati incidunt, qui nihil beatae magnam et repudiandae ipsa exercitationem, in, quo totam.</p>
                    </div>
                </div>
            </div>
        </section> -->
        <!-- Footer-->
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

