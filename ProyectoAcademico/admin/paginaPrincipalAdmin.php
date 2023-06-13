<?php

session_start();
$usuario = $_SESSION['username'];

if(!isset($usuario)){
    header("location: login.php");
} else { 
    echo "<h1> BIENVENIDO $usuario ADMIN </h1>";

    echo "<a href='../logica/salir.php'> SALIR </a>";
}


?>