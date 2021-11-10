<?php

session_start();

if (isset($_SESSION['alumno_id'])) { // es xq ya esta registrado
  header('Location: /proyecto final');
}

require 'conexionBD.php';


if (!empty($_POST['dni']) && !empty($_POST['contrasena'])) {  //si no estan vacios, continuo
    $records = $conn->prepare('SELECT id, dni, contrasena FROM alumnos WHERE dni = :dni');
    $records->bindParam(':dni', $_POST['dni']); //lo q recibe, lo vincula a ese parametro
    $records->execute(); //ejecuta consulta
    $results = $records->fetch(PDO::FETCH_ASSOC); //se obtienen los datos del usuario

    $message = ''; //si ocurre un error se asigna a esa variable

    if (!empty($results) > 0 && password_verify($_POST['contrasena'], $results['contrasena'])) { //si coinciden las pass, es el usuario el q esta intentado de ingresar
      $_SESSION['alumno_id'] = $results['id']; //almacena sesión de usuario
      header("Location: /proyecto final/matricula.html"); //redirecciona a pag inicial
    } else {
      $message = 'Disculpá, el usuario o contraseña no coinciden';
    }
  }

?>

<!DOCTYPE html>
<html>
    <head> 
        <link rel="stylesheet" href="inicio.css">
        <meta charset="utf-8">
        <title>Rematriculación</title>
    </head>
    <body>
    <div class="wrapper fadeInDown">
        <div id="formContent">
         <!-- Tabs Titles -->
    <a href="login.php" class="active"> Iniciar sesión </a>
    <a href="registrarse.php" class="inactive underlineHover">Registrarse </a>

        <?php if(!empty($message)): // si no está vacio el msj es xq ocurrió algo?> 
      <p> <?= $message ?></p>
    <?php endif; ?>

        <form action="login.php" method="post">
            <input type="text" class="fadeIn second" name="dni" placeholder="Ingresa DNI">
            <input type="password" class="fadeIn third" name="contrasena" placeholder="Ingresa contraseña">
            <input type="submit" class="fadeIn fourth" value="Ingresar">
        </form>
       
        <!-- Remind Passowrd -->
        <div id="formFooter">
         <a class="underlineHover" href="#">Recuperar contraseña</a>
         </div>
         
           </div>
    </div>
    </body>
</html>

