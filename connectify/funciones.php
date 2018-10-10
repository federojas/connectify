<?php

session_start();

//FUNCIONES PARA EL LOGIN//
function validarLogin($datos){
  $errores=[];

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
    $errores["password"] = "Dejaste la contrasenia vacia";
  } else {
      $usuario = buscarPorEmail($datos["email"]);
      if($usuario != null){
        if(password_verify($datos["password"], $usuario["contrasenia"]) == false){
          $errores["password"]="Contrasenia incorrecta";
        }
      }
  }
  return $errores;
}


function loguear($email){
  $_SESSION["usuarioLogueado"] = $email;
}


function estaLogueado(){
  if(isset($_SESSION["usuarioLogueado"])){
    return true;
  } else {
    return false;
  }
}

function traerUsuarioLogueado(){
  $usuario = buscarPorEmail($_SESSION["usuarioLogueado"]);
  return $usuario;
}


function buscarPorId($id){
  $usuarios = file_get_contents("usuarios.json");
  $usuariosArray=json_decode($usuarios, true);
  foreach($usuariosArray as $usuario){
    if($id==$usuario["id"]){
      return $usuario;
    }
    return null;
  }
}


function proximoId(){
  $json = file_get_contents("usuarios.json");

  if($json == ""){
    return 1;
  }
  $usuarios = json_decode($json, true);
  $ultimo = array_pop($usuarios);

  return $ultimo["id"] + 1;
}


function armarUsuario(){
  return [
    "id"=> proximoId(),
    "nombre" => trim($_POST["nombre"]),
    "apellido"=>trim($_POST["apellido"]),
    "email"=>trim($_POST["email"]),
    "contrasenia"=>password_hash($_POST["contrasenia"], PASSWORD_DEFAULT),
    "pais"=>$_POST["pais"],
    "genero"=>$_POST["sexo"]
  ];
}



function crearUsuario($usuario){
  $usuarios = file_get_contents("usuarios.json");
  $usuarios = json_decode($usuarios,true);

  if($usuarios===NULL){
    $usuarios=[];
  }

  $usuarios[]=$usuario;
  $usuarios=json_encode($usuarios);
  file_put_contents("usuarios.json", $usuarios);
}



function traerUsuario(){
  $usuarios = file_get_contents("usuarios.json");
  $usuarios = json_decode($usuarios, true);
  return $usuarios;
}


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
  } else if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) == false) {
    $errores[] = "El email es incorrecto";
  } else if (buscarPorEmail($_POST["email"]) != NULL){
    $errores["email"] = "El email ya esta en uso";
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

  if ($_FILES["avatar"]["error"]!= 0){
    $errores["avatar"]= "Hubo un error en la carga";
  } else {
    $ext = pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
    if($ext != "jpg" && $ext != "png"){
      $errores["avatar"]="Solo podes subir fotos jpg o png";
    }
  }
  return $errores;
}



function buscarPorEmail($email){
  $usuarios=file_get_contents("usuarios.json");
  $usuariosArray=json_decode($usuarios, true);
  foreach($usuariosArray as $usuario){
    if($email==$usuario["email"]){
      return $usuario;
    }
  }
  return null;
}
