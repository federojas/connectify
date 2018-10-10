<?php



include_once "funciones.php";

$usernameDefault = "";
$apellidoDefault = "";
$emailDefault = "";

$errores=[];
if ($_POST) {
  $usernameDefault = $_POST["nombre"];
  $apellidoDefault = $_POST["apellido"];
  $emailDefault = $_POST["email"];


  // Validar al  usuario
  $errores = validarUsuario();

  if (empty($errores)) {
    // Registrarlo
$usuario = armarUsuario();
crearUsuario($usuario);

//GUARDAR LA FOTO
$ext = pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
move_uploaded_file($_FILES["avatar"]["tmp_name"], "img/" . $_POST["email"] . "." . $ext);

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
  <?php   include_once "nav.php" ?>
    <section>
      <ul style="color:red">
              <?php foreach ($errores as $error) : ?>
                <li>
                  <?=$error?>
                </li>
              <?php endforeach; ?>
            </ul>
<h1 class="h1RL">REGISTRATE</h1>
<form class="formulario" action="" method="post" enctype="multipart/form-data">
    <div class="Data">
    <label for="nombre"><h6>Nombre</h6></label>
    <input class="input_texto" type="text" name="nombre" value="<?=$usernameDefault?>" id="input" required>
    <h5>Obligatorio.<h5>
      </div>
      <div class="Data">
    <label for="nombre"><h6>Apellido</h6></label>
    <input class="input_texto" type="text" name="apellido" value="" id="input" required>
    <h5>Obligatorio.<h5>
      </div>
      <div class="Data">
    <label for="email"><h6>Email</h6></label>
    <input class="input_texto" type="email" name="email" value="" id="input" required>
    <h5>Obligatorio.<h5>
      </div>
      <div class="Data">
    <label for="contraseña"><h6>Contraseña</h6></label>
    <input class="input_texto" type="password" name="contrasenia" value="" id="input" required>
    <h5>Obligatorio.<h5>
      </div>
      <div class="Data">
      <label for="nombre"><h6>Repetir Contraseña</h6></label>
      <input class="input_texto" type="password" name="repetircontrasenia" value="" id="input" required>
      <h5>Obligatorio.<h5>
        </div>
        <div class="Data">
    <label for="pais"><h6>Pais</h6></label>
    <select class="input_texto" name="pais" >
      <optgroup label="Pais">
        <option value="arg">Argentina</option>
        <option value="ale">Alemania</option>
        <option value="ing">Inglaterra</option>
        <option value="esp">España</option>
        <option value="fra">Francia</option>
        <option value="jap">Japon</option>
      </optgroup>
      </select>
      <h5>Obligatorio.</h5>
      </div>
      <div class="Data">
        <h6>Genero</h6>
      <input class="seleccion" type="radio" name="sexo" value="masculino">
      <label class="genero" for="sexo">Masculino</label>
      <input class="seleccion" type="radio" name="sexo" value="femenino">
      <label class="genero" for="sexo">Femenino</label>
      </div>
    <div class="Data">
    <label class="genero" for="condiciones">Acepto los Terminos y Condiciones</label>
    <input class="seleccion" type="checkbox" name="condiciones" value="condiciones" required>
    <input type="file" name="avatar" value="avatar">
    </div>
    <div class="input">
          <button class="button" type="submit" name="registrarme">Registrarme</button>
          <button class="button" type="reset" name="cancelar">Cancelar</button>
          </div>
  </form>
          </section>
        <?php include_once("footer.php") ?>
  </body>
</html>
