<?php

//CONECTAR BASE//

$dsn = "mysql:host=localhost;dbname=connectify;port=3306;";
$usuario = "root";
$pass = "root";

try {
  $db = new PDO($dsn, $usuario, $pass);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (\Exception $e) {
  echo "Hubo un error";exit;
}


session_start();

if (isset($_COOKIE["usuarioLogueado"]) && isset($_SESSION["usuarioLogueado"]) == false) {
  $_SESSION["usuarioLogueado"] = $_COOKIE["usuarioLogueado"];
}


//FUNCIONES PARA EL LOGIN//
function validarLogin($datos){
  $errores = [];

  if($datos["email"]==""){
    $errores["email"]="Dejaste vacio el email";
  } else if(!filter_var($datos["email"], FILTER_VALIDATE_EMAIL)){
    $errores["email"]= "El email no es un email";
  } else {
    $usuario = buscarPorEmail($datos["email"]);
    if($usuario == null){
      $errores["email"] = "El email no existe";
    }
  }
  if($datos["password"]==""){
    $errores["password"] = "Dejaste la contraseña en blanco";
  } else {
      $usuario = buscarPorEmail($datos["email"]);
      if($usuario != null){
        if(password_verify($datos["password"], $usuario["password"]) == false){
          $errores["password"]="Contraseña incorrecta";
        }
      }
  }
  return $errores;
}


function armarUsuario(){
  return [
    "nombre" => trim($_POST["nombre"]),
    "apellido"=>trim($_POST["apellido"]),
    "email"=>trim($_POST["email"]),
    "password"=>password_hash($_POST["contrasenia"], PASSWORD_DEFAULT),
    "fecnac"=>trim($_POST["fecnac"]),
    "pais"=>$_POST["pais"],
    "genero"=>$_POST["sexo"],
    "nombrefoto"=>$_POST["email"] . ".jpg"
    ];
}


function crearUsuario($usuario){
  global $db;

  $consulta = $db->prepare("INSERT into usuarios values (null, :nombre, :apellido, :email, :password, :fecnac, :pais, :genero, :nombrefoto, :created_at, :updated_at)");

  $now = date("Y-m-d h:i:s");

  $consulta->bindValue(":nombre", $usuario["nombre"]);
  $consulta->bindValue(":apellido", $usuario["apellido"]);
  $consulta->bindValue(":email", $usuario["email"]);
  $consulta->bindValue(":password", $usuario["password"]);
  $consulta->bindValue(":fecnac", $usuario["fecnac"]);
  $consulta->bindValue(":pais", $usuario["pais"]);
  $consulta->bindValue(":genero", $usuario["genero"]);
  $consulta->bindValue(":nombrefoto", $usuario["nombrefoto"]);
  $consulta->bindValue(":created_at", $now);
  $consulta->bindValue(":updated_at", $now);
  $consulta->execute();
}

function loguear($email){
  $_SESSION["usuarioLogueado"] = $email;
}

function estaLogueado() {
  return isset($_SESSION["usuarioLogueado"]);
}


function traerUsuarioLogueado(){
  $usuario = buscarPorEmail($_SESSION["usuarioLogueado"]);
  return $usuario;
}



function traerUsuario(){
  global $db;
  $consulta = $db->prepare("SELECT * FROM usuarios");
  $consulta->execute();
  return $consulta->fetchAll(PDO::FETCH_ASSOC);
}


function validarUsuario(){
  $errores = [];

  if (strlen($_POST["nombre"]) == 0) {
    $errores["nombre"] = "Dejaste el nombre vacío";
  }  else if (ctype_alpha($_POST["nombre"]) == false)  {
    $errores["nombre"] = "El nombre tienen que ser solo letras";
  }

  if (strlen($_POST["apellido"]) == 0) {
    $errores["apellido"] = "Dejaste el apellido vacío";
  }
    else if (ctype_alpha($_POST["apellido"]) == false)  {
    $errores["apellido"] = "El apellido tiene que ser solo letras";
  }

  if (strlen($_POST["email"]) == 0 ){
    $errores["email"] = "Dejaste el email vacío";
  } else if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) == false) {
    $errores["email"] = "El email es incorrecto";
  } else if (buscarPorEmail($_POST["email"]) != NULL){
    $errores["email"] = "El email ya esta en uso";
  }

  if (strlen($_POST["contrasenia"]) == 0) {
    $errores["contrasenia"] = "Ey, dejaste la contra vacía";
  } else if (strlen($_POST["contrasenia"])<5){
    $errores["contrasenia"] = "Tu contraseña debe tener mas de 5 caracteres!";
  }

  if ($_POST["contrasenia"]!= $_POST["repetircontrasenia"]){
    $errores["contrasenia"] = "Tus contraseña no coinciden";
  }
  if(!isset($_POST["condiciones"])){
    $errores["condiciones"] = "Debes aceptar términos y condiciones";
  }


  if ($_POST["fecnac"] == "") {
    $errores["fecnac"] = "La fecha de nacimiento esta vacia";
  } else {
    $age = date_diff(date_create($_POST["fecnac"]), date_create('now'))->y;
    if ($age < 18) {
      $errores["fecnac"] = "Debe ser mayor de edad";
    }
  }

  if ($_FILES["avatar"]["error"]!= 0){
    $errores["avatar"] = "Hubo un error en la carga";
  } else {
    $ext = pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
    if($ext != "jpg" && $ext != "png"){
      $errores["avatar"] = "Solo podes subir fotos jpg o png";
    }
  }
  return $errores;
}


function buscarPorEmail($email){
  global $db;
  $consulta = $db->prepare("SELECT * FROM usuarios WHERE email = :email");
  $consulta->bindValue(":email", $email);
  $consulta->execute();
  return $consulta->fetch(PDO::FETCH_ASSOC);
}


function buscarPorId($id){
  global $db;
  $consulta = $db->prepare("SELECT * FROM usuarios WHERE id = :id");
  $consulta->bindValue(":id", $id);
  $consulta->execute();
  return $consulta->fetch(PDO::FETCH_ASSOC);
}
