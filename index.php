<?php
     session_start(); //ver si sesión que existe. x ende, hay q ver si el id está en la base de datos

     require 'conexionBD.php';
   
     if (isset($_SESSION['alumno_id'])) { //si existe aquella variable dentro de nuestra sesion, se hace consulta para el resto de datos del usuario
       $records = $conn->prepare('SELECT id, dni, contrasena FROM alumnos WHERE id = :id');
       $records->bindParam(':id', $_SESSION['alumno_id']); //se vincula
       $records->execute();
       $results = $records->fetch(PDO::FETCH_ASSOC); // todos los resultados, asignarlos a results
   
       $alumno = null;
   
       if (count($results) > 0) { //si los resultados son mayor a 0, es decir q no estan vacios
         $alumno = $results;
       }
     }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Rematriculación</title>
    </head>
    <body>

    <?php if(!empty($alumno)): ?>
      <br> Welcome. <?= $alumno['dni']; ?>
      <br>Iniciaste sesión correctamente
      <a href="logout.php">
        Salir de la sesión
      </a>
    <?php else: ?>
        <h1>Iniciá sesión o registrate</h1>

        <a href="login.php">Iniciá sesión</a> o
        <a href="registrarse.php">Registrarse</a>
    <?php endif; ?>
        
    </body>
</html>