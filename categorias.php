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
        <title>Categorias</title>
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
         $obj->Ejecutar_Instruccion("insert into categorias(Nombre_cat) values ('".$_POST['txtNombreCat']."')");
         }
      
         else
         {
          $obj->Ejecutar_Instruccion("update categorias set Id_categoria='".$_POST['txtIDcategoria']."',Nombre_cat='".$_POST['txtNombreCat']."' where Id_categoria='".$_POST['txtIDcategoria']."'");
         }
       }
       elseif (isset($_GET['id_eliminar']))
       {
           $obj->Ejecutar_Instruccion("delete from categorias where Id_categoria = '".$_GET['id_eliminar']."'");
       }
       elseif (isset($_GET['id_modificar'])) 
        {
            $categoria_modificar = $obj->Ejecutar_Instruccion("select * from categorias where Id_categoria = '".$_GET['id_modificar']."'");         
        }

         $registros = $obj->Ejecutar_Instruccion("select * from categorias where Nombre_cat like '%".$_POST['txtbuscar']."%'");

 ?>



        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
            <div class="container px-4">
                <a class="navbar-brand" href="#page-top">He'Books Digital</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link" href="#Nueva">Nueva categoria</a></li>
                        <li class="nav-item"><a class="nav-link" href="#BuscarCat">Buscar</a></li>
                        <!--li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li-->
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg- bg-gradient text-white" style="background-color: #84CFCB;">
            <div class="container px-4 text-center">
                <h1 class="fw-bolder">Categorias</h1>
                <p class="lead">Selecciona las categorias que te gusten</p>
                <a class="btn btn-lg btn-light" href="#Nueva">Empezemos</a>
            </div>
        </header><br><br><br><br><br><br>

<?php if ($_SESSION['privilegio'] == "1") 
{ ?>
 <form action="categorias.php" class="bg-light" method="post" id="Nueva"><br>
  <div class="container" align="center" style="">
   
   <h2>Dar de alta la categoria</h2><br><br>
<div class="row">

    <input type="text" name="txtIDcategoria" id="txtIDcategoria" style="display: none;" value="<?php echo @$categoria_modificar[0]['Id_categoria']; ?>">

<div class="row">
    <div class="col-md-3"></div>

<div class="col-md-6">
    <label>Nombre de categoria</label>
    <input class="form-control" placeholder="Nombres de categoria" type="text" name="txtNombreCat" id="txtNombreCat" value="<?php echo @$categoria_modificar[0]['Nombre_cat']; ?>">
</div>

<br>
<div class="col-md-3"> </div>


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
 <form action="categorias.php.#buscar" method="post" class="container" id="BuscarCat">
        <h1>Busca por el nombre de categoria</h1>
        <br>
        <label>Nombre categoria</label>
        <input type="text" name="txtbuscar" id="txtbuscar">
        <input type="submit" name="btnbuscar" id="btnbuscar" value="Buscar" class="btn btn-info">
        <br><br><br>
        <div class="table-responsive">
        <table class="table table-bordered table-ligth" style="border-radius: 20px;">
            <tr align="center">
                <td>ID Categoria</td>
                <td>Nombre</td>
                <?php if ($_SESSION['privilegio'] == "1") 
                 { ?>
                <td style="text-align: center" colspan="2">Acciones</td>
                <?php } ?>
                <td>Accion</td>
            </tr>
            <?php foreach ($registros as $renglon ) {  ?>
                
                <tr align="center">
                <td><?php echo $renglon['Id_categoria']; ?></td>
                <td><?php echo $renglon['Nombre_cat']; ?></td>

               <?php if ($_SESSION['privilegio'] == "1") 
               { ?>
                <td><a onclick="return ConfirmarEliminar()" class="btn btn-danger" href="categorias.php?id_eliminar=<?php echo $renglon['Id_categoria']; ?>#buscar">Eliminar</a></td>
                <td><a class="btn btn-success" href="categorias.php?id_modificar=<?php echo $renglon['Id_categoria'] ?>#registro">Modificar</a></td>
               <?php } ?>

                <td><a class="btn btn-warning" href="VistaLibros.php">Ver Libros</a></td>
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
