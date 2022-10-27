<?php error_reporting(1); 
session_start();

if ($_SESSION['privilegio'] == "1") 
{
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>He'Books Digital</title>

    <link rel="icon" type="img/png" href="img/12.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/unicons.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="css/tooplate-style.css">
    
<!--

Tooplate 2115 Marvel

https://www.tooplate.com/view/2115-marvel

-->
  </head>
  <body>

<?php 
require 'bd/conexion_bd.php';
  
  $obj = new BD_PDO();

if (isset($_POST['btniniciar'])) 
{

$datos = $obj->Ejecutar_Instruccion("Select * from usuarios where Correo = '".$_POST['txtCorreo']."' and Pass = '".$_POST['txtPassword']."'");



  if (isset($datos)) 
  {
    $_SESSION['privilegio'] = $datos[0]['Privilegio'];
    $_SESSION['usuario'] = $datos[0][1];
    $_SESSION['id_usuario'] = $datos[0][4];
  }
  else
  {
    echo '<script type="text/javascript">alert("Correo o contraseña incorrecto");</script>';
  }
}
  
   $registros = $obj->Ejecutar_Instruccion("select * from categorias where Nombre_cat like '%".$_POST['txtbuscar']."%'"); 

 ?>


    <!-- MENU -->
    <nav class="navbar navbar-expand-sm navbar-light">
        <div class="container">
          <?php 

          if (isset($_SESSION['usuario'])) 
          {
            echo '<a class="navbar-brand" href="cerrar_sesion.php" style="font-size: 14px;"><i class="uil uil-user"></i>'.$_SESSION['usuario'].'</a>';
          }
          else
          {
            echo '<a class="navbar-brand" href="#" style="font-size: 17px;" data-toggle="modal" data-target="#exampleModalCenter"><i class="uil uil-user"></i>Iniciar Sesion</a>';
          }

           ?>
            

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link"><span data-hover="Inicio">Inicio</span></a>
                    </li>
                    <?php 
                  if ($_SESSION['privilegio'] == "1") 
                  {
                   echo '<li class="nav-item">
                        <a href="usuario.php" class="nav-link"><span data-hover="Usuarios">Usuarios</span></a>
                         </li>';
                  }
                   
                   ?>
                    <li class="nav-item">
                        <a href="resenas.php" class="nav-link"><span data-hover="Reseñas">Reseñas</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="libros.php" class="nav-link"><span data-hover="Libros">Libros</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="autores.php" class="nav-link"><span data-hover="Autores">Autores</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="categorias.php" class="nav-link"><span data-hover="Categorias">Categorias</span></a>
                    </li>
                </ul>

<!--Barra de busqueda-->
            

                <ul class="navbar-nav ml-lg-auto">
                    <div class="ml-lg-4">
                      <div class="color-mode d-lg-flex justify-content-center align-items-center">
                        <i class="color-mode-icon"></i>
                        Modo
                      </div>
                    </div>
                </ul>
            </div>
        </div>
    </nav>

<!-- Modal -->
<form action="index.php" method="post">
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle" style="color: black;">Inicio de Sesion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" align="center">
        
      <label>Correo electronico</label>
      <input type="mail" name="txtCorreo" id="txtCorreo" class="form-control"><br>

      <label>Contraseña</label>
      <input type="password" name="txtPassword" id="txtPassword" class="form-control"><br>

      <p align="center">¿No tienes cuenta aun? <a href="usuario.php">Registrate</a></p>
      <p align="center"><a href="">Olvide mi contraseña </a></p>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="btniniciar" id="btniniciar">Iniciar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        
      </div>
    </div>
  </div>
 </div>
</form>

    <!-- ABOUT -->
    <section class="about full-screen d-lg-flex justify-content-center align-items-center" id="about">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-7 col-md-12 col-12 d-flex align-items-center">
                    <div class="about-text">
                        <small class="small-text">Bienvenido <span class="mobile-block" >a He'Books Digital!</span></small>
                        <h1 class="animated animated-text">
                            <span class="mr-2">VISTA ADMINISTRADOR</span>
                                <div class="animated-info">
                                    <span class="animated-item">INSERTA</span>
                                    <span class="animated-item">MODIFICA</span>
                                    <span class="animated-item">ELIMINA</span>
                                </div>
                        </h1>

                        <p>Sumergete en la variedad de contenido, en cuanto a libros que tenemos puedes registrarte y hacer reseñas de los libros que haz leido entre otras cosas</p>
                        
                        <div class="custom-btn-group mt-4">
                          <!--a href="#" class="btn mr-lg-2 custom-btn"><i class='uil uil-file-alt'></i> Download Resume</a-->
                          <a href="VistaLibros.php" class="btn custom-btn custom-btn-bg custom-btn-link">Ir a ver un libro</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-md-12 col-12">
                    <div class="about-image svg">
                        <img src="img/6.png" class="img-fluid" alt="svg image">
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- FOOTER -->
     <footer class="footer py-5" style="background-color: #252526;">
          <div class="container">
               <div class="row">

                    <div class="col-lg-12 col-12">                                
                        <p style="color: white;" class="copyright-text text-center">Politica de privacidad &copy;
                          <script>
                             document.write(new Date().getFullYear());
                         </script></p>
                        <p class="copyright-text text-center">Designed by <a rel="nofollow" href="#">He'Books Digital compañia con derechos reservados</a></p>
                    </div>
                    
               </div>
          </div>
     </footer>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/Headroom.js"></script>
    <script src="js/jQuery.headroom.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/smoothscroll.js"></script>
    <script src="js/custom.js"></script>

  </body>
</html>
<?php 
}
else
{
 header("Location: index.php");
}

 ?>