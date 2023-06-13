<?php
require 'conexion.php';
session_start();
//Variables que traen los datos de nombre de usuario y contraseña
$usuario = $_POST['username'];
$clave = $_POST['password'];


$q2= "SELECT COUNT(*) as contar_prof FROM profesor where usuario_profesor = '$usuario' and contrasena_profesor = '$clave'";

$consulta_prof = mysqli_query($conexion,$q2);
$array_prof = mysqli_fetch_array($consulta_prof);


if ($array_prof['contar_prof']>0) {
    $_SESSION['username'] = $usuario;
    header("location: ../profesor/paginaPrincipalProfesor.php");

}else {
        echo "<h1> Datos incorrectos </h1>";
        echo "<a href='../login.php'> VOLVER AL MENÚ DE LOGIN </a>";
    }



?>
