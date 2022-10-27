<?php error_reporting(1); 

require 'bd/conexion_bd.php';
  
$obj = new BD_PDO();

if(isset($_POST['btnenviar'])){
	$usuarios = $obj->Ejecutar_Instruccion("SELECT * from usuarios where Correo = '".$_POST['txtcorreo']."'");

  $to = $_POST['txtcorreo'];
  $subjet = "Recupero de contraseña";
  $headers = "MIME-Version 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

$message = 'Haz solicitado la contraseña del usuario: '.$usuarios[0]['Correo'].'. Tu contraseña es la siguiente: '.$usuarios[0]['Pass'].' . No compartas este correo con nadie, ¡elimínalo!. Ahora debes iniciar sesión, ingresa aquí: http://http://localhost/universidad_ut/pruebas/BIBLIOTECA/';

$mail = @mail($to, $subjet, $message, $headers);
     	if ($mail) {
     		echo "<h4>Enviado exitosamente ¡Revise su correo ahi encontrara un mesaje que le enviamos con su password para que inicie sesion de nuevo!</h4>";
        //  echo "<script>
        //           window.location='index.php';
        //       </script>";
     		
     	}
      
      else
      {
        echo "No se encontro el correo solicitado";
      }
    }

 ?>
 
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>Recuperar contraseña</title> 
    <link rel="icon" type="img/png" href="img/12.png">
    <meta name="viewport "content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=3.0, minimum-scale=1.0">

   
  <link href="css/styles.css" rel="stylesheet" />
    

</head>  
<body style="align-items: center; padding-top: 180px;" background="img/fondo.webp">

    <form action="recuperoContra.php" method="post" class="jumbotron">

          <h1 align="center">Recupero</h1>

      <!-- Card with Center Text Alignment -->
      <div class="container" align="center">
      <div class="card" style="width:40rem;" align="center">
      <div class="card-body text-center" align="center">
      <h4 class="card-title">Introduce tu correo</h4>
      <p class="card-text">Se mandara un correo con la contraseña</p>
      <input type="email" name="txtcorreo" required="" id="txtcorreo" required class="form-control"><br>

      <input class="btn btn" style="background-color: #D6234A;" name="btnenviar" id="btnenviar" type="submit" value="Enviar">
      <a href="index.php" class="btn btn-primary">Regresar</a>


      </div>
      </div>
      </div>
    </form>
 
</body>
</html>
