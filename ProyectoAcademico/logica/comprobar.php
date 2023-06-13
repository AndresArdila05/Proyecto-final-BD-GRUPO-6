<?php
require 'conexion.php';
session_start();
//Variables que traen los datos de nombre de usuario y contraseña
$usuario = $_POST['username'];
$clave = $_POST['password'];


$q = "SELECT COUNT(*) as contar_est FROM estudiante where usuario = '$usuario' and contrasena = '$clave'";
$q2= "SELECT COUNT(*) as contar_prof FROM profesor where usuario_profesor = '$usuario' and contrasena_profesor = '$clave'";
$q3= "SELECT COUNT(*) as contar_admin FROM administrador where usuario = '$usuario' and contrasena = '$clave'";


$consulta_est = mysqli_query($conexion,$q);
$array_est = mysqli_fetch_array($consulta_est);


$consulta_prof = mysqli_query($conexion,$q2);
$array_prof = mysqli_fetch_array($consulta_prof);


$consulta_admin = mysqli_query($conexion,$q3);
$array_admin = mysqli_fetch_array($consulta_admin);


if($array_est['contar_est']>0){
    $_SESSION['username'] = $usuario;
    header("location: ../logica/loguear.php");
} else if ($array_prof['contar_prof']>0) {
    $_SESSION['usernameProfesor'] = $usuario;
    header("location: ../profesor/paginaPrincipalProfesor.php");
} else {    
    echo "<h1> Datos incorrectos </h1>";
    echo "<a href='../login.php'> VOLVER AL MENÚ DE LOGIN </a>";
}




?>