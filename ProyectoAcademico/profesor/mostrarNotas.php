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

    
        <?php
        // Aquí puedes obtener los datos personales de la base de datos

        
        



        // Imprime los datos personales en la página
        

        

        ?>
      </ul>
    </div>
  </main>
</body>
</html>