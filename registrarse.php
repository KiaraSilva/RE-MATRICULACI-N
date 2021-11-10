<?php
require 'conexionBD.php';

$message = ''; //variable global.

//sino estan vacios esos campos continuo
if (!empty($_POST['dni']) && !empty($_POST['contrasena'])) {
  $sql = "INSERT INTO alumnos (dni, contrasena) VALUES (:dni, :contrasena)";
  $stmt = $conn->prepare($sql); //ejecuta consulta sql
  $stmt->bindParam(':dni', $_POST['dni']); //vincula lo q se obtuvo con la variable
  $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT); //cifra pass
  $stmt->bindParam(':contrasena', $contrasena);

  if ($stmt->execute()) {
    $message = 'Se creó el usuario'; //variable local
  } else {
    $message = 'Ha ocurrido un error al crear su contraseña';
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

    <?php if(!empty($message)): // si no está vacio el msj es xq ocurrió algo?> 
      <p> <?= $message ?></p>
    <?php endif; ?>

        <h1>Registrate</h1>
    <span>o <a href="login.php">Iniciá sesión</a> 
        
    <form action="registrarse.php" class="formbox" method = "post">
        <input type="text" name="dni" placeholder="Ingrese DNI" />
        <br>
        <input type="password" name="contrasena" placeholder="Ingrese Contraseña" />
        <br>
        <input type="password" name="contra" placeholder="Confirme Contraseña" />
		<input type="submit" value="Enviar">
    </form> 

        
    </body>
</html>