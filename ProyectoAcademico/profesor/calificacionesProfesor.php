<?php
    require '../logica/conexion.php';
    session_start();
    $usuario = $_SESSION['usernameProfesor'];

    if(!isset($usuario)){
        header("location: ../login.php");
    }
    
    $horario = $_SESSION['horarioProfesor'];

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
    <a href="paginaPrincipalProfesor.php" class="btn-volver">Volver</a>
  </header>

  <main>
    <h2 class="title">Calificaciones</h2>
    <div class="datos-container">
      <ul class="datos-list">
        <?php
        // Aquí puedes obtener los datos personales de la base de datos

        // Imprime los datos personales en la página
        $grupo_asignatura=0;
        
        foreach ($horario as $curso) {
            $codigo_asignatura = $curso["codigo_asignatura"]; 
            $nombre_asignatura = $curso["nombre_asignatura"]; 
            
            if($grupo_asignatura != $curso["num_grupo"]) {
                $grupo_asignatura = $curso["num_grupo"];
                echo "<li><strong>Curso:</strong> $codigo_asignatura <a href='insertarNota.php?parametro1=$codigo_asignatura&parametro2=$grupo_asignatura'>$nombre_asignatura</a> <strong>Grupo: $grupo_asignatura</strong></li>";
            
            }
   
        
        }

        

        ?>
      </ul>
    </div>
  </main>
</body>
</html>