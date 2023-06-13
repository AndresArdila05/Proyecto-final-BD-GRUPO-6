<?php
    session_start();
    $usuario = $_SESSION['username'];

    if(!isset($usuario)){
        header("location: ../login.php");
    }

    $datosPendientes = $_SESSION['nombresPendientes'];
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Asignaturas disponibles para cursar</title>
  <link rel="stylesheet" href="../css/estudiante_css/asignaturas_disponibles.css">
</head>
<body>
  <header>
    <div class="user-corner">
      <h1>Asignaturas disponibles para cursar</h1>
      <span class="welcome-message">Bienvenido a las asignaturas disponibles, <?php echo $usuario; ?></span>
    </div>
    <a href="paginaPrincipalEstudiante.php" class="btn-volver">Volver</a>
  </header>

  <main>
    <h2 class="title">Asignaturas disponibles</h2>
    <div class="datos-container">
      <ul class="datos-list">
        <?php
        // Aquí puedes obtener los datos personales de la base de datos

        // Imprime los datos personales en la página
        foreach($datosPendientes as $pendientes) {
          $codigoAsignatura = $pendientes["Asignatura_codigo_asignatura"];
          $nombreAsignatura = $pendientes["nombre_asignatura"];
          $tipologia = $pendientes["tipologia"];
          $componente = $pendientes["componente"];
          $agrupacion = $pendientes["agrupacion"];
          echo "<h3>$codigoAsignatura $nombreAsignatura</h3>";
          echo "<a><strong>Tipologia:</strong> $tipologia <strong>Componente:</strong> $componente <strong>Agrupación:</strong> $agrupacion</a>";
          echo "<br>";
          echo "<br>";
        }
        

        ?>
      </ul>
    </div>
  </main>
</body>
</html>
