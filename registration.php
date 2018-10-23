<?php

  require_once("funciones.php");

  $errores=[];
  $nombreDefault = "";
  $apellidoDefault = "";
  $emailDefault = "";

// Viene por POST?
  if ($_POST) {

    // Validar al  usuario
    $errores = validarUsuario($_POST);

    $nombreDefault = $_POST["nombre"];
    $apellidoDefault = $_POST["apellido"];
    $emailDefault = $_POST["email"];
    $fecnacDefault = $_POST["fecnac"];

    if (empty($errores)) {
      // Registrarlo
      $usuario = armarUsuario();
      $usuario = crearUsuario($usuario);

      //GUARDAR LA FOTO
      move_uploaded_file($_FILES["avatar"]["tmp_name"], "img/" . $usuario["nombrefoto"]);
      // Redirigir a la home
      
      header("location:index.php");exit;
    }
  }
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <title>Connectify.</title>
  </head>
  <body>
    <?php require_once("nav.php") ?>
      <section>
        <br>
        <br>
        <h1 class="h1RL">REGISTRATE</h1>
        <br>
        <form class="formulario" action="" method="post" enctype="multipart/form-data">
          <div class="Data">
            <?php if (isset($errores["nombre"])) : ?>
              <input class="error input_texto" id="input" placeholder=" Nombre *" type="text" name="nombre" value="<?=$nombreDefault?>">
                <p class="mensaje-error">
                  <?=$errores["nombre"]?>
                </p>
            <?php else : ?>
              <input class="input_texto" id="input" placeholder=" Nombre *" type="text" name="nombre" value="<?=$nombreDefault?>">
            <?php endif; ?>
          </div>
          <br>
          <div class="Data">
            <?php if (isset($errores["apellido"])) : ?>
              <input class="error input_texto" id="input" placeholder=" Apellido *" type="text" name="apellido" value="<?=$apellidoDefault?>">
              <p class="mensaje-error">
                <?=$errores["apellido"]?>
              </p>
            <?php else : ?>
              <input class="input_texto" id="input" placeholder=" Apellido *" type="text" name="apellido" value="<?=$apellidoDefault?>">
            <?php endif; ?>
          </div>
          <br>
          <div class="Data">
            <?php if (isset($errores["email"])) : ?>
              <input class="error input_texto" id="input" placeholder=" Email *" type="email" name="email" value="<?=$emailDefault?>">
              <p class="mensaje-error">
              <?=$errores["email"]?>
              </p>
            <?php else : ?>
              <input class="input_texto" id="input" placeholder=" Email *" type="email" name="email" value="<?=$emailDefault?>">
            <?php endif; ?>
          </div>
          <br>
          <div class="Data">
            <?php if (isset($errores["contrasenia"])) : ?>
              <input class="error input_texto" id="input" placeholder=" Contraseña *" type="password" name="contrasenia" value="">
              <p class="mensaje-error">
              <?=$errores["contrasenia"]?>
              </p>
            <?php else : ?>
              <input class="input_texto" id="input" placeholder=" Contraseña *" type="password" name="contrasenia" value="">
            <?php endif; ?>
          </div>
          <br>
          <div class="Data">
            <?php if (isset($errores["repetircontrasenia"])) : ?>
              <input class="error input_texto" id="input" placeholder=" Confirmar Contraseña *" type="password" name="repetircontrasenia" value="">
              <p class="mensaje-error">
              <?=$errores["repetircontrasenia"]?>
              </p>
            <?php else : ?>
              <input class="input_texto" id="input" placeholder=" Confirmar Contraseña *" type="password" name="repetircontrasenia" value="">
            <?php endif; ?>
          </div>
          <br>
          <div class="Data">

            <?php
            $paises = ["Argentina","Bolivia","Brasil","Uruguay","Alemania","Inglaterra","España","Francia", "Japón", "Otros"];
            ?>

            <select class="input_texto" name="pais" value="<?=$paislDefault?>">
                <option value="null" class="hidden" selected disabled>País *</option>
                <option value=0><?=$paises[0]?></option>
                <option value=1><?=$paises[1]?></option>
                <option value=2><?=$paises[2]?></option>
                <option value=3><?=$paises[3]?></option>
                <option value=4><?=$paises[4]?></option>
                <option value=5><?=$paises[5]?></option>
                <option value=6><?=$paises[6]?></option>
                <option value=7><?=$paises[7]?></option>
                <option value=8><?=$paises[8]?></option>
                <option value=9><?=$paises[9]?></option>
            </select>
          </div>
          <br>

          <div class="Data">
            <h6>Fecha de Nacimiento</h6>
            <br>

            <?php if (isset($errores["fecnac"])) : ?>
              <input class="error input_texto" id="input" placeholder=" Fecha de Nacimiento *" type="date" name="fecnac" value="<?=$fecnacDefault?>">
              <p class="mensaje-error">
              <?=$errores["fecnac"]?>
              </p>
            <?php else : ?>
              <input class="input_texto" id="input" placeholder=" Fecha de Nacimiento *" type="date" name="fecnac" value="<?=$fecnacDefault?>">
            <?php endif; ?>
          </div>
          <br>
          <div class="Data">
            <?php if (isset($_POST["sexo"])) : ?>
              <?php if ($_POST["sexo"] == "m") : ?>
                <input class="seleccion" type="radio" name="sexo" value="m" checked>
                <label class="genero" for="sexo">Masculino</label>
                <input class="seleccion" type="radio" name="sexo" value="f">
                <label class="genero" for="sexo">Femenino</label>
              <?php else : ?>
                <input class="seleccion" type="radio" name="sexo" value="m">
                <label class="genero" for="sexo">Masculino</label>
                <input class="seleccion" type="radio" name="sexo" value="f" checked>
                <label class="genero" for="sexo">Femenino</label>
              <?php endif; ?>
            <?php else : ?>
              <input class="seleccion" type="radio" name="sexo" value="m">
              <label class="genero" for="sexo">Masculino</label>
              <input class="seleccion" type="radio" name="sexo" value="f">
              <label class="genero" for="sexo">Femenino</label>
            <?php endif; ?>
          </div>
          <br>
          <div class="Data">
            <h6>Foto de Perfil</h6>
            <br>
            <?php if (isset($errores["avatar"])) : ?>
              <input type="file" name="avatar" value="<?=$avatarDefault?>">
              <p class="mensaje-error">
              <?=$errores["avatar"]?>
              </p>
            <?php else : ?>
              <input type="file" name="avatar" value="<?=$avatarDefault?>">
            <?php endif; ?>
          </div>
          <br>
          <br>
          <br>
          <div class="Data">
            <label class="genero" for="condiciones">Acepto los Terminos y Condiciones</label>
            <input class="seleccion" type="checkbox" name="condiciones" value="condiciones" required>
          </div>
          <br>
          <div class="input">
            <button class="button" type="submit" name="registrarme">Registrarme</button>
            <button class="button" type="reset" name="cancelar">Cancelar</button>
          </div>
          <br>
        </form>
      </section>
      <?php require_once("footer.php") ?>
    </body>
</html>
