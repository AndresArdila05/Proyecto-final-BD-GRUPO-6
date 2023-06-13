<?php
    session_start();
    $usuario = $_SESSION['username'];

    if(!isset($usuario)){
        header("location: ../login.php");
    }

    $codigoHistoria = $_SESSION['codigoHistoria'];
    $PAPA = $_SESSION['PAPA'];
    $PA = $_SESSION['PA'];
    $avance = $_SESSION['avanceCarrera'];
    $creditosAprobados = $_SESSION['creditosAprobados'];
    $creditosDisponibles = $_SESSION['creditosDisponibles'];
    $creditosInscritos = $_SESSION['creditosInscritos'];
    $estado = $_SESSION['estadoHistoria'];
    $semestre_ano = $_SESSION['ano'];
    $semestre_periodo = $_SESSION['periodo'];
    $nombre_carrera = $_SESSION['carrera'];


    $llaves = $_SESSION['llavesHistoria'];
    $nombres_horario = $_SESSION['nombresHistoria']; 
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Historia académica</title>
  <link rel="stylesheet" href="../css/estudiante_css/historia_academica.css">
</head>
<body>
  <header>
    <div class="user-corner">
      <h1>Historia académica</h1>
      <span class="welcome-message">Bienvenido a su historia académica, <?php echo $usuario; ?></span>
    </div>
    <a href="paginaPrincipalEstudiante.php" class="btn-volver">Volver</a>
  </header>


  <main>
    <h2 class="title">Historia académica</h2>
    <div class="datos-container">
      <ul class="datos-list">
        <?php
        // Aquí puedes obtener los datos personales de la base de datos

        // Imprime los datos personales en la página
                // Aquí puedes obtener los datos personales de la base de datos
                if($estado == 1){
                  $estado = "Activa";
                } else {
                  $estado = "Inactiva";
                }
                
                // Imprime los datos personales en la página
                echo "<li><strong>Codigo historia:</strong> $codigoHistoria </li>";
                echo "<li><strong>Estado:</strong> $estado</li>";
                echo "<li><strong>Semestre:</strong> $semestre_ano - $semestre_periodo</li>";
                echo "<li><strong>Carrera del estudiante:</strong> $nombre_carrera</li>";
                echo "<li><strong>P.A.P.A:</strong><h2> $PAPA</h2></li>";
                echo "<li><strong>P.A:</strong><h2> $PA</h2></li>";
                foreach ($llaves as $curso) {
                  $arregloDefinitiva = $nombres_horario[$curso];
                  $nombre_curso = $arregloDefinitiva[0];
                  $definitiva = $arregloDefinitiva[1];
                  echo "<li><strong>Curso:</strong> $curso $nombre_curso</a> <strong>$definitiva</strong></li>";
                }
                echo "<br>";
                echo "<li><strong>Créditos inscritos:</strong> $creditosInscritos</li>";
                echo "<li><strong>Créditos disponibles:</strong> $creditosDisponibles</li>";
                echo "<li><strong>Créditos aprobados:</strong> $creditosAprobados</li>";
                echo "<li><strong>Créditos pendientes:</strong> 160</li>";
                echo "<li><strong>Avance:</strong> $avance % </li>";



        

        ?>
      </ul>
    </div>
  </main>
</body>
</html>