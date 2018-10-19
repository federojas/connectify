<?php
  require_once("funciones.php");

  if(!estaLogueado()){
    header("location:login.php");exit;
  }

  $id = $_GET["id"];
  $usuario = buscarPorId($id);
  $foto = glob("img/" . $usuario["nombrefoto"])[0];
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
      <div class="container">
        <div class="titulo">
          <br>
          <h1 class="h1RL">Mi Perfil</h1>
        </div>
            <ul>
              <li>Nombre: <?=$usuario["nombre"]?></li>
              <li>Apellido: <?=$usuario["apellido"]?></li>
              <li>Email: <?=$usuario["email"]?></li>
              <li>Género: <?=($usuario["genero"] === "m") ? "Masculino" : "Femenino"?></li>

              <?php
              $paises = ["Argentina","Bolivia","Brasil","Uruguay","Alemania","Inglaterra","España","Francia", "Japón", "Otros"];
              $paises[$usuario["pais"]]
              ?>

              <li>País: <?=$paises[$usuario["pais"]]?></li>
            </ul>
            <br>
            <img width="200" src="<?=$foto?>" alt="">
            <br>
            <br>
      </div>
    </section>
    <?php require_once("footer.php") ?>
  </body>
</html>
