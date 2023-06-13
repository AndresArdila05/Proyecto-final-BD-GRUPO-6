<?php
    require '../logica/conexion.php';
    session_start();
    $usuario = $_SESSION['username'];

    if(!isset($usuario)){
        header("location: ../login.php");
    }
    $llaves = $_SESSION['llavesHorario'];
    $nombres_horario = $_SESSION['nombresHorario']; 
    $codigo_materia = $_GET['parametro1'];
    $curso_actual = $nombres_horario[$codigo_materia];
    $curso_final = $curso_actual[0];
    $definitiva = $curso_actual[1];

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
    <a href="calificaciones.php" class="btn-volver">Volver</a>
  </header>

  <main>
    <h2 class="title">Calificaciones</h2>
    <h3 class="title"><?php echo "<strong>Asignatura:</strong> $curso_final";  ?></h3>
    <div class="datos-container">
      <ul class="datos-list">
        <?php
        $notas = "call ConsultarNotasEstudiante ('$usuario','$codigo_materia');";
        $notas2 = array();
        
            if (mysqli_multi_query($conexion,$notas)) {
                do {
                    if ($result = mysqli_store_result($conexion)) {
                        // Process each result set
                        while ($rowNotas = mysqli_fetch_assoc($result)) {
                            // Access the values of each row
                            // Example: echo $row['column_name'];
                            $notas2[$rowNotas['id_calificacion']] = array($rowNotas['calificacion'], $rowNotas['descripcion'], $rowNotas['peso']);
                            //print_r($rowNotas);
                        }
                        mysqli_free_result($result);
                    }
                } while (mysqli_next_result($conexion));
            } else {
                echo "Error: " . mysqli_error($conexion);
            }


            foreach ($notas2 as $notas3) {
                $calificacion = $notas3[0];
                $descripcion = $notas3[1];
                $peso = $notas3[2];
                echo "<li><strong>Nota/Descripción/Peso:</strong> $calificacion - $descripcion - $peso </li>";
            }
            echo "<h2><li><strong>Definitiva: </strong> $definitiva </li></h2>";
        //print_r($codigo_materia);
        


        ?>
      </ul>
    </div>
  </main>
</body>
</html>