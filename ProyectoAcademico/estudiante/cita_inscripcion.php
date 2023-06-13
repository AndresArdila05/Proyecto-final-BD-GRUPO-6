<?php
    session_start();
    $usuario = $_SESSION['username'];

    if(!isset($usuario)){
        header("location: ../login.php");
    }
    $datosCita = $_SESSION['nombresCita'];
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cita de Inscripción</title>
  <link rel="stylesheet" href="../css/estudiante_css/cita_inscripcion.css">
</head>
<body>
  <header>
    <div class="user-corner">
      <h1>Cita de Inscripción/Cancelación</h1>
      <span class="welcome-message">Bienvenido a su cita, <?php echo $usuario; ?></span>
    </div>
    <a href="paginaPrincipalEstudiante.php" class="btn-volver">Volver</a>
  </header>

  <main>
    <h2 class="title">Cita de inscripción</h2>
    <div class="datos-container">
      <ul class="datos-list">
        <?php
        // Aquí puedes obtener los datos personales de la base de datos

        // Imprime los datos personales en la página
        $pagina = "paginaPrincipalEstudiante.php";
        foreach ($datosCita as $cita) {
          $inicioCita = $cita["inicio_cita"];
          $finCita = $cita["fin_cita"];

          echo "<li><strong>Inicio cita: </strong>$finCita <strong>Fin cita: </strong>$inicioCita </li>";
          echo "<br>";
          echo "<a href='inscripcion.php' class='btn-volver'>Acceder a inscripcion</a>";
        }
        

        ?>
      </ul>
    </div>
  </main>
</body>
</html>