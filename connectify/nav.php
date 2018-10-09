<?php
  require_once("funciones.php");
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

  </body>
</html>

<nav>
  <header class="header">
    <h1 class="logo"><a href="#">Connectify.</a></h1>
      <ul class="main-nav">
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About</a></li>

        <?php
        if(estaLogueado()){
          $usuario = traerUsuarioLogueado();
          ?>
          <li><a href="logout.php">Logout</a></li>
          <li><a href="detalleusuario.php?id=<?php echo $usuario["id"] ?>"><?php echo $usuario["nombre"] ?></a></li>
          <?php
        } else {
          ?>
          <li><a href="registration.php">Registration</a></li>
          <li><a href="login.php">Login</a></li>
          <?php
        }
        ?>
      </ul>
  </header>
</nav>
