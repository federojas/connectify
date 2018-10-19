<?php
  require_once("funciones.php");
  if(estaLogueado()){
    header("location:index.php");exit;
  }

  //SI VINO POR POST

  if ($_POST) {
    $errores = validarLogin($_POST);

    $emailDefault = $_POST["email"];
    $passwordDefault = $_POST["password"];

    ?>

    <?php
    if(empty($errores)){
      loguear($_POST["email"]);

      if (isset($_POST["recordarme"])) {
        $year = time() + 31536000;
        setcookie("RECORDAR", $_POST["email"], $year);
      }

      header("location:index.php");exit;
    }
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
    <?php require_once("nav.php") ?>
    <section>
      <div class="todo">
        <div class="container">
          <div class="titulo">
            <br>
            <br>
            <h1 class="h1RL">INGRESAR</h1>
            <br>
          </div>
          <form class="formulario" action="login.php" method="post">
            <div class="input">
              <?php if (isset($errores["email"])) : ?>
                <input class="error caja" id="input" placeholder=" Email *" type="email" name="email" value="<?=$emailDefault?>">
                <p class="mensaje-error">
                  <?=$errores["email"]?>
                </p>
              <?php else : ?>
                <input class="caja" id="input" placeholder=" Email *" type="email" name="email" value="">
                <h3>¿Has olvidado tu correo electronico?<h3>
              <?php endif; ?>
            </div>


            <div class="input">
              <?php if (isset($errores["password"])) : ?>
                <input class="error caja" id="input" placeholder=" Contraseña *" type="password" name="password" value="">
                <p class="mensaje-error">
                  <?=$errores["password"]?>
                </p>
              <?php else : ?>
                <input class="caja" id="input" placeholder=" Contraseña *" type="password" name="password" value="">
                <h3>¿Has olvidado tu contraseña?<h3>
              <?php endif; ?>
            </div>

            <div class="recordar">
              <label class="genero" for="condiciones">Recordarme</label>
              <input class="seleccion" type="checkbox" name="recordarme"  value="recordado">
            </div>
            <div class="input">
              <input type="submit" name="aceptar" class="boton" value="Login">
              <input type="reset" name="cancelar" class="boton" value="Cancelar">
            </div>
          </form>
          <br>
        </div>
      </div>
    </section>
    <?php require_once("footer.php") ?>
  </body>
</html>
