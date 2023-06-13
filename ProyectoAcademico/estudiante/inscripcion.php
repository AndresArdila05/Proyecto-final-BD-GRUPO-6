<?php
    require '../logica/conexion.php';
    session_start();
    $usuario = $_SESSION['username'];

    if(!isset($usuario)){
        header("location: ../login.php");
    }
    //$datosCita = $_SESSION['nombresCita'];
    $datosPendientes = $_SESSION['nombresPendientes'];
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscripción</title>
  <link rel="stylesheet" href="../css/estudiante_css/cita_inscripcion.css">
</head>
<body>
  <header>
    <div class="user-corner">
      <h1>Bienvenido a su inscripción</h1>
      <span class="welcome-message">Bienvenido a su inscripción, <?php echo $usuario; ?></span>
    </div>
    <a href="cita_inscripcion.php" class="btn-volver">Volver</a>
  </header>

  <main>
  <script>
    function mostrarAlerta() {
      alert("¡Has inscrito la materia!");
    }

    function cambiarTexto(elemento) {
      if (elemento.innerHTML === "Inscribir") {
        elemento.innerHTML = "Materia inscrita (clic para retirarla)";
      } else {
        elemento.innerHTML = "Inscribir";
      }
    }
  </script>
    <h2 class="title">Inscripción</h2>
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
                    echo "<li><strong>Grupo: $grupo</strong> <button onclick='mostrarAlerta(); cambiarTexto(this)' class='btn-volver'>Inscribir</button></li>";
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