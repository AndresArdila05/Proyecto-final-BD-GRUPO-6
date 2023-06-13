<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema Académico</title>
  <link rel="stylesheet" href="../css/estudiante_css/estudiante.css">
</head>
<body>
<div class="background-image">
    <div class="overlay">
        <h1 class="overlay-text">Universidad Nacional de Colombia</h1>
        <h3 class="overlay-text2">Portal de servicios académicos</h3>
    </div>
  <header>
    <h1>Portal de servicios académicos</h1>
    <div class="user-corner">
    <?php
    $usuario = $_SESSION['username'];

    if(!isset($usuario)){
        header("location: ../login.php");
    } else { 
        echo "<h2> Bienvenido $usuario </h2>";
}
?>
        <form action="../logica/salir.php" method="post">
            <input type="submit" value="SALIR" class="logout-button">
        </form>
    </div>
  </header>
  <nav>
    <ul>
      <li><a href="#">Datos Personales</a>
        <ul>
          <li><a href="datos_personales.php">Datos</a></li>
        </ul>
      </li>
      <li><a href="#">Información Académica</a>
        <ul>
          <li><a href="calificaciones.php">Calificaciones</a></li>
          <li><a href="historia_academica.php">Historia Académica</a></li>
          <li><a href="horario.php">Horario</a></li>
        </ul>
      </li>
      <li><a href="#">Proceso de Inscripción</a>
        <ul>
          <li><a href="cita_inscripcion.php">Cita de Inscripción</a></li>
          <li><a href="asignaturas_disponibles.php">Asignaturas Disponibles para Cursar</a></li>
        </ul>
      </li>
      <li><a href="#">Buscador de Cursos</a>
        <ul>
          <li><a href="buscador_cursos.php">Buscador</a></li>
        </ul>
      </li>
    </ul>
  </nav>
  <main>
    <!-- Contenido de la página -->
  </main>
  </div>
</body>
</html>


