<?php

function validarUsuario(){
$errores = [];

if (strlen($_POST["nombre"]) == 0) {
    $errores[] = "Ey, dejaste el nombre de usuario vacío";
  }  else if (ctype_alpha($_POST["nombre"]) == false)  {
    $errores[] = "El nombre de usuario tienen que ser solo letras";
  }

  if (strlen($_POST["apellido"]) == 0) {
      $errores[] = "Dejaste el apellido vacío";
    }
    else if (ctype_alpha($_POST["apellido"]) == false)  {
      $errores[] = "El apellido tiene que ser solo letras";
    }

  if (strlen($_POST["email"]) == 0 ){
    $errores[] = "Dejaste el email vacío";
  }
  else if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) == false) {
    $errores[] = "El email es incorrecto";
  }

  if (strlen($_POST["contrasenia"]) == 0) {
      $errores[] = "Ey, dejaste la contra vacía";
    } else if (strlen($_POST["contrasenia"])<5){
      $errores[] = "Tu contraseña debe tener mas de 5 caracteres!";
    }

    if ($_POST["contrasenia"]!= $_POST["repetircontrasenia"]){
      $errores[]= "Tus contrasenias no son iguales!";
    }
    if(!isset($_POST["condiciones"])){
      $errores[]= "Debes aceptar terminos y condiciones";
    }

  return $errores;
}


$usernameDefault = "";
$apellidoDefault = "";
$emailDefault = "";

if ($_POST) {
  $usernameDefault = $_POST["nombre"];
  $apellidoDefault = $_POST["apellido"];
  $emailDefault = $_POST["email"];


  // Validar al  usuario
  $errores = validarUsuario();

  if (empty($errores)) {
    // Registrarlo

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
    <header class="header">
      <h1 class="logo"><a href="#">Connectify.</a></h1>
        <ul class="main-nav">
            <li><a href="index.html">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="registration.html">Registration</a></li>
            <li><a href="login.html">Login</a></li>
        </ul>
    </header>
    <section>
      <ul style="color:red">
              <?php foreach ($errores as $error) : ?>
                <li>
                  <?=$error?>
                </li>
              <?php endforeach; ?>
            </ul>
<h1 class="h1RL">REGISTRATE</h1>
<form class="formulario" action="" method="post">
    <div class="Data">
    <label for="nombre"><h6>Nombre</h6></label>
    <input class="input_texto" type="text" name="nombre" value="<?=$usernameDefault?>" required>
    <h5>Obligatorio.<h5>
      </div>
      <div class="Data">
    <label for="nombre"><h6>Apellido</h6></label>
    <input class="input_texto" type="text" name="apellido" value="" required>
    <h5>Obligatorio.<h5>
      </div>
      <div class="Data">
    <label for="email"><h6>Email</h6></label>
    <input class="input_texto" type="email" name="email" value="" required>
    <h5>Obligatorio.<h5>
      </div>
      <div class="Data">
    <label for="contraseña"><h6>Contraseña</h6></label>
    <input class="input_texto" type="password" name="contrasenia" value="" required>
    <h5>Obligatorio.<h5>
      </div>
      <div class="Data">
      <label for="nombre"><h6>Repetir Contraseña</h6></label>
      <input class="input_texto" type="password" name="repetircontrasenia" value="" required>
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
    </div>
    <div class="input">
          <button class="button" type="submit" name="registrarme">Registrarme</button>
          <button class="button" type="reset" name="cancelar">Cancelar</button>
          </div>
  </form>
          </section>
          <footer class="social-footer">
            <div class="social-footer-left">
              <!-- <a href="#"><img class="logo" src="https://placehold.it/150x30"></a> -->
              <h1 class="logo"><a href="#">Connectify.</a></h1>
            </div>
            <div class="social-footer-icons">
              <ul class="menu simple">
                <li><a href="https://www.facebook.com/"><i class="fab fa-facebook" ></i></a></li>
                <li><a href="https://www.instagram.com/?hl=en"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                <li><a href="https://www.pinterest.com/"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a></li>
                <li><a href="https://twitter.com/?lang=en"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
              </ul>
            </div>
          </footer>
  </body>
</html>
