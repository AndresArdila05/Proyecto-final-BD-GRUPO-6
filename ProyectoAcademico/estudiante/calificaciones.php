<?php
    session_start();
    $usuario = $_SESSION['username'];

    if(!isset($usuario)){
        header("location: ../login.php");
    }
    $llaves = $_SESSION['llavesHorario'];
    $nombres_horario = $_SESSION['nombresHorario']; 

?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calificaciones</title>
  <link rel="stylesheet" href="../css/estudiante_css/calificaciones.css">
</head>
<body>
  <header>
    <div class="user-corner">
      <h1>Calificaciones</h1>
      <span class="welcome-message">Bienvenido a sus Calificaciones, <?php echo $usuario; ?></span>
    </div>
    <a href="paginaPrincipalEstudiante.php" class="btn-volver">Volver</a>
  </header>

  <main>
    <h2 class="title">Calificaciones</h2>
    <div class="datos-container">
      <ul class="datos-list">
        <?php
        // Aquí puedes obtener los datos personales de la base de datos

        // Imprime los datos personales en la página
        $enlace = "descripcion_definitiva.php";
        
        foreach ($llaves as $curso) {
          $arregloDefinitiva = $nombres_horario[$curso];
          $nombre_curso = $arregloDefinitiva[0];
          $definitiva = $arregloDefinitiva[1];
          echo "<li><strong>Curso:</strong> $curso <a href='descripcion_definitiva.php?parametro1=$curso'>$nombre_curso</a> <strong>$definitiva</strong></li>";
        }

        ?>
      </ul>
    </div>
  </main>
</body>
</html>