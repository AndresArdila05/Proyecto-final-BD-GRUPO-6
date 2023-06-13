<?php
    session_start();
    $usuario = $_SESSION['username'];

    if(!isset($usuario)){
        header("location: ../login.php");
    }
    $datosHorario = $_SESSION['nombresHorario2'];
    $dias = array("LUNES","MARTES","MIERCOLES","JUEVES","VIERNES","SABADO");

?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Horario estudiante</title>
  <link rel="stylesheet" href="../css/estudiante_css/horario.css">
</head>
<body>
  <header>
    <div class="user-corner">
      <h1>Horario estudiante</h1>
      <span class="welcome-message">Bienvenido a su horario, <?php echo $usuario; ?></span>
    </div>
    <a href="paginaPrincipalEstudiante.php" class="btn-volver">Volver</a>
  </header>

  <main>
    <h2 class="title">Horario actual</h2>
    <div class="datos-container">
      <ul class="datos-list">
        <?php
        // Aquí puedes obtener los datos personales de la base de datos

        // Imprime los datos personales en la página
        
        foreach ($dias as $dia) {
          echo "<h3>$dia</h3>";
          $count = 0;
          foreach($datosHorario as $curso) {
            if($curso["dia"]==$dia) {
              $codigo_asignatura = $curso["codigo_asignatura"]; 
              $nombre_asignatura = $curso["nombre_asignatura"]; 
              $grupo_asignatura = $curso["num_grupo"]; 
              $profesor_asignatura = $curso["nombre_profesor"]; 
              $franja_asignatura = $curso["franja_horaria"]; 
              $edificio = $curso["nombre_edificio"];
              $salon = $curso["Salon_numero_salon"];
              echo "<li><h4><strong>$franja_asignatura $codigo_asignatura $nombre_asignatura</strong></h4>Grupo: $grupo_asignatura Profesor: $profesor_asignatura Edificio: $edificio Salon: $salon </li>";
              $count = $count +1;
            }
            
          }
          if($count == 0) {
            echo "No hay cursos inscritos";
          }

        }

        ?>
      </ul>
    </div>
  </main>
</body>
</html>