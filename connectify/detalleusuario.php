<?php
  require_once("funciones.php");
  $id = $_GET["id"];
  $usuario = buscarPorId($id);
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    
    <h1>Detalle Usuario.</h1>
      <?php
        echo "Nombre: " . $usuario["nombre"];
        ?> <br><?php
        echo "Apellido: " . $usuario["apellido"];
        ?> <br><?php
        echo "Email: " . $usuario["email"];
        ?> <br><?php
        echo "Género: " . $usuario["genero"];
        ?> <br><?php
        echo "País: " . $usuario["pais"];
        ?> <br><?php
      ?>

  </body>
</html>
