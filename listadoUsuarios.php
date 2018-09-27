<?php
include_once "funciones.php";
$usuarios = traerUsuario();


 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
<h1>Mis Usuarios</h1>
<ul>
  <?php foreach ($usuarios as $key => $usuario) : ?>
    <li>
      <a href="detalleUsuario.php?id=<?php echo  $usuario["id"] ?>">
<?php echo $usuario["nombre"] . " " . $usuario["apellido"]  ?>
      </a>
   </li>
<?php endforeach; ?>
</ul>






  </body>
</html>
