<?php
require 'conexion.php';
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $planEstudios = $_POST["plan_estudios_hidden"];
    // Hacer algo con el valor de $planEstudios
    } 

//print_r($planEstudios);


$buscador = "call pr_buscador_cursos2 ('$planEstudios')";
$buscador2 = array();

if (mysqli_multi_query($conexion,$buscador)) {
    $count = 0;
    do {
        if ($resultBuscador = mysqli_store_result($conexion)) {
            // Process each result set
            while ($rowBuscador = mysqli_fetch_assoc($resultBuscador)) {
                // Access the values of each row
                // Example: echo $row['column_name'];
                $buscador2[$count] = $rowBuscador;
                $count = $count +1;
                //print_r($rowHorario2);
                //print_r($horario3);
            }
            mysqli_free_result($resultBuscador);
        }
    } while (mysqli_next_result($conexion));
} else {
    echo "Error: " . mysqli_error($conexion);
}

//print_r($buscador2);



?>



<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Resultado</title>
  <link rel="stylesheet" href="../css/estudiante_css/calificaciones.css">
</head>
<body>
  <header>
    <div class="user-corner">
      <h1>Resultados de busqueda</h1>
      <span class="welcome-message">Resultados de la busqueda</span>
    </div>
    <a href="../estudiante/buscador_cursos.php" class="btn-volver">Volver</a>
  </header>

  <main>
    <h2 class="title">Resultados</h2>
    <div class="datos-container">
      <ul class="datos-list">
        <?php
        // Aquí puedes obtener los datos personales de la base de datos

        // Imprime los datos personales en la página

        foreach($buscador2 as $pendientes) {
            $codigoAsignatura = $pendientes["codigo_asignatura"];
            $numCupos = "SELECT sum(cupos) FROM grupo WHERE Asignatura_codigo_asignatura = $codigoAsignatura";
            $consulta_cupos = mysqli_query($conexion,$numCupos);
            $array_cupos = mysqli_fetch_array($consulta_cupos);
            //print_r($array_cupos);
            $num_cupos2 = $array_cupos[0];
            $nombreAsignatura = $pendientes["nombre_asignatura"];
            $componente = $pendientes["componente"];

            echo "<h3>$codigoAsignatura $nombreAsignatura</h3>";
            echo "<a><strong>Componente:</strong> $componente <strong>Cupos totales:</strong> $num_cupos2</a>";
            echo "<br>";
            echo "<br>";


            $espacios = "call pr_asig_espacio ($codigoAsignatura);";
            $espacios2 = array();

            if (mysqli_multi_query($conexion,$espacios)) {
             $count = 0;
            do {
             if ($resultEspacios = mysqli_store_result($conexion)) {
            // Process each result set
            while ($rowEspacios = mysqli_fetch_assoc($resultEspacios)) {
                // Access the values of each row
                // Example: echo $row['column_name'];
                $espacios2[$count] = $rowEspacios;
                $count = $count +1;
                //print_r($rowHorario2);
                //print_r($horario3);
                }
                mysqli_free_result($resultEspacios);
             }
            } while (mysqli_next_result($conexion));
        } else {
            echo "Error: " . mysqli_error($conexion);
            }
            $longitud = count($espacios2);
            $indice = 0;
            $grupo = 0;
            do {
                $espacio = $espacios2[$indice];
                $dia = $espacio["dia"];
                $franja = $espacio["franja_horaria"];
                $profesor = $espacio["nombre_profesor"];
                $salon = $espacio["Salon_numero_salon"];
                $edificio = $espacio ["nombre_edificio"];

                if($grupo != $espacio["Grupo_num_grupo"]) {
                    $grupo = $espacio["Grupo_num_grupo"];
                    echo "<li><strong>Grupo: $grupo</strong></li>";
                    echo "<br>";
                    echo "<li>$dia - $franja - $edificio - $salon - $profesor</li>";
                } else if ($grupo==$espacio["Grupo_num_grupo"]) {
                    echo "<li>$dia - $franja - $edificio - $salon - $profesor</li>";
                }
                $indice = $indice+1;

            }while ($indice < $longitud);
          }

        ?>
      </ul>
    </div>
  </main>
</body>
</html>




