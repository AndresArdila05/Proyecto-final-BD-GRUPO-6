<?php
    require '../logica/conexion.php';
    session_start();
    $usuario = $_SESSION['usernameProfesor'];

    if(!isset($usuario)){
        header("location: ../login.php");
    }
    
    $horario = $_SESSION['horarioProfesor'];
    $llaves_horario = array_keys($horario);
    $codigo_materia = $_GET['parametro1'];
    $grupo_materia = $_GET['parametro2'];

?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Insertar</title>
  <link rel="stylesheet" href="../css/estudiante_css/calificaciones.css">
  
</head>
<body>
  <header>
    <div class="user-corner">
      <h1>Insertar calificaciones</h1>
      <span class="welcome-message">Bienvenido a sus Calificaciones, <?php echo $usuario; ?></span>
    </div>
    <a href="calificacionesProfesor.php" class="btn-volver">Volver</a>
  </header>

  <main>
    <h2 class="title">Insertar calificaciones</h2>
    <div class="datos-container">
      <ul class="datos-list">


      <form method="POST">
            <label for="descripcion">
                <span>Descripción:</span>
                <input id="descripcion" name="descripcion" placeholder="Digite descripcion" required autocomplete="off"/>
            </label>
            <br>
            <br>
            <label for="peso">
                <span>Peso de la nota:</span>
                <input type = "number" min = 0 max = 100 step = 1 id="peso" name="peso" placeholder="Digite el peso de la nota" required/>
            </label>
            <br>
            <br>
            <button type="submit" class="submit-btn">Guardar nota</button>
        </form>
        <?php
        // Aquí puedes obtener los datos personales de la base de datos
        if(isset($_POST['descripcion']) and isset($_POST['peso'])) {
            $descripcion = $_POST['descripcion'];
            $peso = $_POST['peso'];

            $crearNota = "call pr_insert_notas (?,?,?,?);";
            $stm = $conexion -> prepare($crearNota);
            $stm -> bind_param("iisi",$codigo_materia, $grupo_materia, $descripcion, $peso);
            $stm -> execute();
            $stm -> close();
        }
        

        $pendientes = "call pr_lista_estudiante ($codigo_materia, $grupo_materia);";
        $pendientes2 = array();
        
        if (mysqli_multi_query($conexion,$pendientes)) {
            $count = 0;
            do {
                if ($resultPendientes = mysqli_store_result($conexion)) {
                    // Process each result set
                    while ($rowPendientes = mysqli_fetch_assoc($resultPendientes)) {
                        // Access the values of each row
                        // Example: echo $row['column_name'];
                        $pendientes2[$count] = $rowPendientes;
                        $count = $count +1;
                        //print_r($rowHorario2);
                        //print_r($horario3);
                    }
                    mysqli_free_result($resultPendientes);
                }
            } while (mysqli_next_result($conexion));
        } else {
            echo "Error: " . mysqli_error($conexion);
        }
        $documento_estudiante = 0;
        foreach ($pendientes2 as $lista) {
            if($lista["documento_est"]!=$documento_estudiante) {
                $documento_estudiante = $lista["documento_est"];
                $nombres = $lista["nombres"];
                $apellidos = $lista["apellidos"];
                echo"<h3>Documento estudiante: $documento_estudiante Nombre estudiante: $nombres $apellidos </h3>";
            }
        
            $calificacion = $lista["calificacion"];
            $descripcion2 = $lista["descripcion"];
            $peso2 = $lista["peso"];
            echo"<li><strong>Descripción: </strong> $descripcion2 <strong>Peso: </strong> $peso2 <strong>Calificación: </strong> $calificacion</li>";

        
        }

        // Imprime los datos personales en la página
        

        

        ?>
      </ul>
    </div>
  </main>
</body>
</html>