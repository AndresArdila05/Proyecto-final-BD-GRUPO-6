<?php
    require '../logica/conexion.php';
    session_start();
    $usuario = $_SESSION['usernameProfesor'];

    if(!isset($usuario)){
        header("location: ../login.php");
    }
    $dias = array("LUNES","MARTES","MIERCOLES","JUEVES","VIERNES","SABADO");
    $horario2 = $_SESSION['horarioProfesor'];
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
    <a href="paginaPrincipalProfesor.php" class="btn-volver">Volver</a>
  </header>

  <main>
    <h2 class="title">Horario actual</h2>
    <div class="datos-container">
      <ul class="datos-list">
        <?php
        // Aquí puedes obtener los datos personales de la base de datos

        // Imprime los datos personales en la página
        /*
        $horario = "call pr_horario_profesor ('$usuario');";
        $horario2 = array();

        if (mysqli_multi_query($conexion,$horario)) {
            $count = 0;
            do {
                if ($result2 = mysqli_store_result($conexion)) {
                    // Process each result set
                    while ($rowHorario2 = mysqli_fetch_assoc($result2)) {
                        // Access the values of each row
                        // Example: echo $row['column_name'];
                        $horario2[$count] = $rowHorario2;
                        $count = $count +1;
                        //print_r($rowHorario2);
                        //print_r($horario3);
                    }
                    mysqli_free_result($result2);
                }
            } while (mysqli_next_result($conexion));
        } else {
            echo "Error: " . mysqli_error($conexion);
        }
        //print_r($horario2); 
        $_SESSION['horarioProfesor'] = $horario2; 
        */

        foreach ($dias as $dia) {
          echo "<h3>$dia</h3>";
          $count = 0;
          foreach($horario2 as $curso) {
            if($curso["dia"]==$dia) {
              $codigo_asignatura = $curso["codigo_asignatura"]; 
              $nombre_asignatura = $curso["nombre_asignatura"]; 
              $grupo_asignatura = $curso["num_grupo"]; 
              $franja_asignatura = $curso["franja_horaria"]; 
              $edificio = $curso["nombre_edificio"];
              $salon = $curso["Salon_numero_salon"];
              echo "<li><h4><strong>$franja_asignatura $codigo_asignatura $nombre_asignatura</strong></h4>Grupo: $grupo_asignatura Edificio: $edificio Salon: $salon </li>";
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