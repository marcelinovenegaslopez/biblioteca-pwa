<?php error_reporting(1); 
session_start();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Bienvenido a la pagina web HéBooksDigital donde podras descargar libros y tener acceso a busquedas de los mas interesante en literatura, Sumergete en la variedad de contenido, en cuanto a libros que tenemos puedes registrarte y hacer reseñas de los libros que haz leido entre otras cosas.">
    <title>He'Books Digital</title>

    <meta name="theme-color" content="#F0DB4F">
    <meta name="MobileOptimized" content="width">
    <meta name="HandheldFriendly" content="true">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="shortcut icon" content="image/png" href="img/12.png">
    <link rel="apple-touch-icon" href="img/12.png">
    <link rel="apple-touch-startup-image" href="img/12.png">
    <link rel="manifest" href="manifest.json">

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

   $registros = $obj->Ejecutar_Instruccion("Select IdLibro , NombreLib, LibroArch, imagen, Edicion, Categoria, Autor, Nombre_cat, Nombre_aut, Apellidos from libros 
          inner JOIN categorias on libros.Categoria = categorias.Id_categoria
          inner JOIN autores on libros.Autor = autores.Id_autor 
          where NombreLib like '%".$_POST['txtbuscar']."%'");

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
                  <?php 
                  if ($_SESSION['privilegio'] == "1") 
                  {
                   echo '<li class="nav-item">
                        <a href="administrador.php" class="nav-link"><span data-hover="Administrador">Administrador</span></a>
                         </li>';
                  }
                   
                   ?>
                   <?php 
                   if ($_SESSION['privilegio'] == "0")
                   {
                     echo '<li class="nav-item">
                        <a href="resenas.php" class="nav-link"><span data-hover="Reseñas">Reseñas</span></a>
                    </li>';
                   }
                   if ($_SESSION['privilegio'] == "1")
                   {
                    echo '<li class="nav-item">
                        <a href="resenas.php" class="nav-link"><span data-hover="Reseñas">Reseñas</span></a>
                    </li>';
                   }
                    ?>
                    
                    <li class="nav-item">
                        <a href="#categoria" class="nav-link"><span data-hover="Categorias">Categorias</span></a>
                    </li>
                    <?php  
                     if ($_SESSION['privilegio'] == "0")
                      {
                       echo '<li class="nav-item">
                        <a href="VistaLibros.php" class="nav-link"><span data-hover="Libros">Libros</span></a>
                    </li>';
                      }
                    ?>
                    
                    <li class="nav-item">
                    <a href="#ediciones" class="nav-link"><span data-hover="Ediciones">Ediciones</span></a>
                    </li>
                    <?php 
                    if ($_SESSION['privilegio'] == "1") 
                     {
                     echo '';
                     }
                     else
                     {
                      echo '<li class="nav-item">
                        <a href="#contact" class="nav-link"><span data-hover="Contacto">Contacto</span></a>
                          </li>';
                     }
                    ?>
                    
                </ul>

<!--Barra de busqueda-->
                  <?php 
                    if ($_SESSION['privilegio'] == "1") 
                    {
                    echo '<ul class="navbar-nav mx-auto">
                    <form  action="VistaLibros.php#lib" method="post" class="form-inline">
                    <input class="form-control mr-sm-2" type="text" name="txtbuscar" id="txtbuscar" placeholder="Ingrese una busqueda" aria-label="">
                    <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit" name="btnbuscar" id="btnbuscar" value="Buscar" >Buscar</button>
                    </form>
               </ul>';
                    }
                   
                   ?>
                   <?php 
                    if ($_SESSION['privilegio'] == "0") 
                    {
                    echo '<ul class="navbar-nav mx-auto">
                    <form  action="VistaLibros.php#lib" method="post" class="form-inline">
                    <input class="form-control mr-sm-2" type="text" name="txtbuscar" id="txtbuscar" placeholder="Ingrese una busqueda" aria-label="">
                    <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit" name="btnbuscar" id="btnbuscar" value="Buscar" >Buscar</button>
                    </form>
               </ul>';
                    }
                   
                   ?>
            

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
      <p align="center"><a href="recuperoContra.php">Olvide mi contraseña </a></p>

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
                        <small class="small-text">Bienvenido <span class="mobile-block">a He'Books Digital!</span></small>
                        <h1 class="animated animated-text">
                            <span class="mr-2">Los libros al alcance, De</span>
                                <div class="animated-info">
                                    <span class="animated-item">Un click</span>
                                    <span class="animated-item">De tu mano</span>
                                    <span class="animated-item">de tu lectura</span>
                                </div>
                        </h1>

                        <p>Sumergete en la variedad de contenido, en cuanto a libros que tenemos puedes registrarte y hacer reseñas de los libros que haz leido entre otras cosas</p>
                        
                        <div class="custom-btn-group mt-4">
                          <!--a href="#" class="btn mr-lg-2 custom-btn"><i class='uil uil-file-alt'></i> Download Resume</a-->
                          <?php 
                           switch ($_SESSION['privilegio']) 
                           {
                             case "0":
                               echo '<a href="VistaLibros.php" class="btn custom-btn custom-btn-bg custom-btn-link">Ir a ver un libro</a>';
                               break;
                             case "1":
                               echo '<a href="VistaLibros.php" class="btn custom-btn custom-btn-bg custom-btn-link">Ir a ver un libro</a>';
                               break;
                             default:
                               echo '<a href="#" class="btn custom-btn custom-btn-bg custom-btn-link" data-toggle="modal" data-target="#exampleModalCenter">Ir a ver un libro</a>';
                               break;
                           }
                           ?>
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

    <!-- Categorias -->

<br><hr>

<!--Muestra de categorias en tarjetas--->
<div class="container" align="center">
  <h2>Categorias</h2>
  <div class="jumbotron" id="categoria">
       
       <div class="card-deck mt-3">
            <?php 
            
      if (isset($_POST['btnbuscar'])) 
        {              
          $registros1 = $obj->Ejecutar_Instruccion("select * from categorias where Nombre_cat like '%".$_POST['txtbuscar']."%'");

        } 
       else
        {  
          $registros1 = $obj->Ejecutar_Instruccion("select * from categorias where Nombre_cat like '%".$_POST['txtbuscar']."%'");

        }

            foreach ($registros1 as $registro) { ?>

    <div class="col-lg-4 col-md-6 text-center">             
      <div class="card text-center border-">
        
            <div class="sb-icon">               
                                
            <div class="card-body">

                
                <label class="card-text"><b>Categoria: <?php echo $registro['Id_categoria']; ?></b></label><br> 
                <img src="img/12.png" width="50px" height="50px">
                <label class="card-text"><h3 style="color: darkgray;"><?php echo $registro['Nombre_cat']; ?></h3></label><br><br>
                
              <a class="btn btn-primary" href="#">Ver </a>
                 
            </div>   
          </div>
      </div><br>
    </div> 
                  
                  <?php }?>

        </div>    

  </div>
</div>

<br><hr>
    <!-- FEATURES -->
    <section class="resume py-5 d-lg-flex justify-content-center align-items-center" id="resume">
        <div class="container">
            <div class="row">

                <div class="col-lg-6 col-12">
                  <h2 class="mb-4" id="ediciones">Diferentes Ediciones</h2>

                    <div class="timeline">
                        <div class="timeline-wrapper">
                             <div class="timeline-yr">
                                  <span><img src="img/8.png" style="width: 50px; height: 50px;"></span>
                             </div>
                             <div class="timeline-info">
                                  <h3><span>Novela Historica</span><small>-</small></h3>
                                  <p>Siendo una obra de ficción, recrea un periodo histórico preferentemente lejano y en la que forman parte de la acción personajes y eventos no ficticios.</p>
                             </div>
                        </div>

                        <div class="timeline-wrapper">
                            <div class="timeline-yr">
                                <span><img src="img/7.png" style="width: 50px; height: 50px;"></span>
                            </div>
                            <div class="timeline-info">
                                <h3><span>Comic o Historietas</span><small>-</small></h3>
                                <p>Es un medio visual de narración verbo-icónica que comunica historias de uno o varios personajes. Se trata de una “narración secuencial mediante imágenes fijas que te entretendran facilmente".</p>
                            </div>
                        </div>

                        <div class="timeline-wrapper">
                            <div class="timeline-yr">
                                <span><img src="img/10.png" style="width: 50px; height: 50px;"></span>
                            </div>
                            <div class="timeline-info">
                                <h3><span>Crimen y misterio</h3>
                                <p>Las "novelas de misterio" pueden ser historias de detectives en las cuales el énfasis se encuentra en el caso o elemento de suspenso y su solución lógica.</p>
                            </div>
                        </div>
                        
                        

                    </div>
                </div>

                <div class="col-lg-6 col-12">
                  <h2 class="mb-4 mobile-mt-2">Educacion</h2>

                    <div class="timeline">
                        <div class="timeline-wrapper">
                             <div class="timeline-yr">
                                  <span><img src="img/17.png" style="width: 53px; height: 53px;"></span>
                             </div>
                             <div class="timeline-info">
                                  <h3><span>Bibliografias y memorias</span><small>-</small></h3>
                                  <p>Son escritos compuestos por recuerdos de vivencias, experiencias y sensaciones que pudo haber tenido algún personaje de cierto renombre a lo largo de su vida.</p>
                             </div>
                        </div>

                        <div class="timeline-wrapper">
                            <div class="timeline-yr">
                                <span><img src="img/14.png" style="width: 50px; height: 50px;"></span>
                            </div>
                            <div class="timeline-info">
                                <h3><span>Empresa y economia</span><small>-</small></h3>
                                <p> Estos te enseñarán conceptos y aspectos básicos relacionados con los negocios. Tales textos pueden interesarte si te llama la atención el emprendimiento, la gerencia y áreas afines.</p>
                            </div>
                        </div>
                        
                        <div class="timeline-wrapper">
                            <div class="timeline-yr">
                                <span><img src="img/16.png" style="width: 50px; height: 50px;"></span>
                            </div>
                            <div class="timeline-info">
                                <h3><span>Psicologia</span><small>-</small></h3>
                                <p>Esta disciplina ciertamente es interesante puesto que proporciona información para comprender el comportamiento de las personas.</p>
                            </div>
                        </div>

                    </div>
                </div>
                
            </div>
        </div>
    </section>

<hr>
    <!-- CONTACTO-->
    <section class="contact py-5" id="contact">
      <div class="container">
        <div class="row">
          
          <div class="col-lg-5 mr-lg-5 col-12">
            <div class="google-map w-100">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3503.909459564559!2d-100.61828208544176!3d28.572481393548262!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x865ff586598af941%3A0xf0e5df7612124b7d!2sUniversidad%20Tecnol%C3%B3gica%20del%20Norte%20de%20Coahuila!5e0!3m2!1ses-419!2smx!4v1645213218094!5m2!1ses-419!2smx" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>


            <div class="contact-info d-flex justify-content-between align-items-center py-4 px-lg-5">
                <div class="contact-info-item">
                  <h3 class="mb-3 text-white">Nuestra Ubicacion</h3>
                  <p class="footer-text mb-0">010 020 0960</p>
                  <a href="mailto:hebooksdigital@gmail.com?Subject=Interesado%20en%20la%20pagina%20HeBooksDigital">hebooksdigital@gmail.com</a>
                </div>

                <ul class="social-links">
                    <br>
                     <br><li><a href="#" class="uil uil-instagram" data-toggle="tooltip" data-placement="left" title="Instagram"></a></li>
                     <li><a href="#" class="uil uil-youtube" data-toggle="tooltip" data-placement="left" title="Youtube"></a></li>
                </ul>
            </div>
          </div>

          <div class="col-lg-6 col-12">
            <div class="contact-form">
              <h1>Contactanos!</h1>
              <h4 class="mb-4">Si te interesa saber mas mandanos un correo</h4>

              <form action="enviarEmail.php" method="POST">
                <div class="row">
                  <div class="col-lg-6 col-12">
                    <input type="text" class="form-control" name="nombreCliente" placeholder="Nombre" id="name">
                  </div>

                  <div class="col-lg-6 col-12">
                    <input type="email" class="form-control" name="emailCliente" placeholder="Correo" id="email">
                  </div>

                  <div class="col-12">
                    <textarea name="msjCliente" rows="6" class="form-control" id="message" placeholder="Mensaje"></textarea>
                  </div>

                  <div class="ml-lg-auto col-lg-5 col-12">
                    <input type="submit" class="form-control submit-btn" value="Enviar">
                  </div>
                </div>
              </form>
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
          
     
    <script src="js/script.js"><script>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/Headroom.js"></script>
    <script src="js/jQuery.headroom.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    
    <script src="js/custom.js"></script>
    <script type="text/javascript">
    <script src="js/smoothscroll.js"></script>
    
    $(document).ready(function() {

        $(window).load(function() {
            $(".cargando").fadeOut(1000);
        });

//Ocultar mensaje
    setTimeout(function () {
        $("#msj").fadeOut(1000);
    }, 7000);

});
</script>

  </body>
</html>