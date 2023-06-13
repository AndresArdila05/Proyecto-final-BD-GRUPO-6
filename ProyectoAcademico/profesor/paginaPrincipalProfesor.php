
<?php
    require '../logica/conexion.php';
    session_start();
    $usuario = $_SESSION['usernameProfesor'];
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
    if(!isset($usuario)){
        header("location: ../login.php");
    } else { 
        echo "<h2> Bienvenido $usuario </h2>";


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
    
}
?>
        <form action="../logica/salir.php" method="post">
            <input type="submit" value="SALIR" class="logout-button">
        </form>
    </div>
  </header>
  <nav>
    <ul>
      <li><a href="#">Información Académica</a>
        <ul>
          <li><a href="calificacionesProfesor.php">Calificaciones</a></li>
          <li><a href="horarioProfesor.php">Horario</a></li>
        </ul>
      </li>
      <li><a href="#">Buscador de Cursos</a>
        <ul>
          <li><a href="../estudiante/buscador_cursos.php">Buscador</a></li>
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


