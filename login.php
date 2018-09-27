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
<form class="formulario" action="index.php" method="post">
<div class="input">
  <h4>Email</h4>
<input class="caja" type="email" name="email" value="">
<h3>¿Has olvidado tu correo electronico?<h3>
  </div>

  <div class="input">
    <h4>Contraseña</h4>
  <input class="caja" type="password" name="pass" value="">
  <h3>¿Has olvidado tu contraseña?<h3>
    </div>
    <div class="recordar">
      <input class="checkbox" type="checkbox" name="recordarme" value="recordarme"> <p id="recordarlo">Recordarme</p> <br>
    </div>
      <div class="input">
    <input type="submit" name="aceptar" class="boton" value="Login">
    <input type="reset" name="cancelar" class="boton" value="Cancelar">
    </div>
  </form>
</div>
</div>
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
