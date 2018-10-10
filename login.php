<?php
require_once("funciones.php");

if(estaLogueado()){
  header("location:index.php");exit;
}

//SI VINO POR POST


if ($_POST) {

  $errores = validarLogin($_POST);

  var_dump($errores);exit;

  if(empty($errores)){
    loguear($_POST["email"]);

    if (isset($_POST["recordarme"])) {
      $year = time() + 31536000;
      setcookie("recordar", $_POST["email"], $year);
    }


    header("location:indep.php");exit;
  }
  var_dump($errores);

}
 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="css/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <title>Connectify.</title>
  </head>
  <body>
    <?php   include_once "nav.php" ?>
    <section>
      <div class="todo">
      <div class="container">
      <div class="titulo">
        <h1 class="h1RL">BIENVENIDO</h1>
      </div>
<form class="formulario" action="login.php" method="post">
<div class="input">
  <h4>Email</h4>
<input class="caja" type="email" name="email" value="" id="input">
<h3>¿Has olvidado tu correo electronico?<h3>
  </div>

  <div class="input">
    <h4>Contraseña</h4>
  <input class="caja" type="password" name="password" value="" id="input">
  <h3>¿Has olvidado tu contraseña?<h3>
    </div>
    <div class="recordar">
      <input class="checkbox" type="checkbox" name="recordarme" value="recordado"> <p id="recordarlo">Recordarme</p> <br>

    </div>
      <div class="input">
    <input type="submit" name="aceptar" class="boton" value="Login">
    <input type="reset" name="cancelar" class="boton" value="Cancelar">
    </div>
  </form>
</div>
</div>
    </section>
    <?php include_once("footer.php") ?>
  </body>
</html>
