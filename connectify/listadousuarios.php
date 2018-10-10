<?php
  require_once("funciones.php");
  $usuarios = traerUsuario();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1>Usuarios de Connectify.</h1>
    <ul>
      <?php foreach ($usuarios as $key => $usuario) : ?>
      <li>
        <a href="detalleusuario.php?id=<?php echo  $usuario["id"] ?>">
        <?php echo $usuario["nombre"] . " " . $usuario["apellido"]  ?>
        </a>
      </li>
      <?php endforeach; ?>
    </ul>
  </body>
</html>
