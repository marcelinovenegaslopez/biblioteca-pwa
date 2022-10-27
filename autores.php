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
        <title>Autores</title>
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
         $obj->Ejecutar_Instruccion("insert into autores(Nombre_aut,Apellidos) values ('".$_POST['txtNombreAutor']."','".$_POST['txtApellidos']."')");
         }
      
         else
         {
          $obj->Ejecutar_Instruccion("update autores set Id_autor='".$_POST['txtIDautor']."',Nombre_aut='".$_POST['txtNombreAutor']."',Apellidos='".$_POST['txtApellidos']."' where Id_autor='".$_POST['txtIDautor']."'");
         }
       }
       elseif (isset($_GET['id_eliminar']))
       {
           $obj->Ejecutar_Instruccion("delete from autores where Id_autor = '".$_GET['id_eliminar']."'");
       }
       elseif (isset($_GET['id_modificar'])) 
        {
            $autor_modificar = $obj->Ejecutar_Instruccion("select * from autores where Id_autor = '".$_GET['id_modificar']."'");         
        }

         $registros = $obj->Ejecutar_Instruccion("select * from autores where Nombre_aut like '%".$_POST['txtbuscar']."%'");



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
                        <li class="nav-item"><a class="nav-link" href="#Reseña">Nuevo registro</a></li>
                        <li class="nav-item"><a class="nav-link" href="#opiniones">Autores</a></li>
                        <!--li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li-->
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg- bg-gradient text-white" style="background-color: #F76C6C;">
            <div class="container px-4 text-center">
                <h1 class="fw-bolder">Autores</h1>
                <p class="lead">Busca entre tus autores favoritos</p>
                <a class="btn btn-lg btn-light" href="#Reseña">Buscar</a>
            </div>
        </header><br><br><br><br><br><br>

<?php if ($_SESSION['privilegio'] == "1") 
{ ?>
 <form action="autores.php" class="bg-light" method="post" id="Reseña" enctype="multipart/form-data"><br>
  <div class="container" align="center" style="">
   
   <h2>Dar de alta al autor</h2><br><br>
<div class="row">

    <input type="text" name="txtIDautor" id="txtIDautor" style="display: none;" value="<?php echo @$autor_modificar[0]['Id_autor']; ?>">

<div class="row">
<div class="col-md-6">
    <label>Nombre</label>
    <input class="form-control" placeholder="Nombres del autor" type="text" name="txtNombreAutor" id="txtNombreAutor" value="<?php echo @$autor_modificar[0]['Nombre_aut']; ?>">
</div>

<br>
<div class="col-md-6">
    <label>Apellidos</label>
     <input class="form-control" placeholder="Apellidos del autor" type="text" name="txtApellidos" id="txtApellidos" value="<?php echo @$autor_modificar[0]['Apellidos']; ?>">
 </div>


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
<?php } ?>
<br><br>
            
<br><br><br><br><hr>       

<!---Seccion de buscar--->
 <form action="autores.php.#buscar" method="post" class="container" id="opiniones">
        <h1>Busca por el nombre de autor</h1>
        <br>
        <label>Nombre del autor</label>
        <input type="text" name="txtbuscar" id="txtbuscar">
        <input type="submit" name="btnbuscar" id="btnbuscar" value="Buscar" class="btn btn-info">
        <br><br><br>
        <div class="table-responsive">
        <table class="table table-bordered table-ligth" style="border-radius: 20px;">
            <tr align="center">
                <td>ID Autor</td>
                <td>Nombre</td>
                <td>Apellidos</td>
                <?php if ($_SESSION['privilegio'] == "1") 
                 { ?>
                <td style="text-align: center" colspan="2">Acciones</td>
                <?php } ?>
                
            </tr>
            <?php foreach ($registros as $renglon ) {  ?>
                
                <tr align="center">
                <td><?php echo $renglon['Id_autor']; ?></td>
                <td><?php echo $renglon['Nombre_aut']; ?></td>
                <td><?php echo $renglon['Apellidos']; ?></td>

              <?php if ($_SESSION['privilegio'] == "1") 
              { ?>
                <td><a onclick="return confirm('Esta seguro de eliminar el archivo?');" class="btn btn-danger" href="autores.php?id_eliminar=<?php echo $renglon['Id_autor']; ?>#buscar" >Eliminar</a></td>
                <td><a class="btn btn-success" href="autores.php?id_modificar=<?php echo $renglon['Id_autor'] ?>#registro">Modificar</a></td>
              <?php } ?>

                <!-- <td><a class="btn btn-primary" style="background-color: salmon;" href="">Ver estos autores</a></td> -->
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
