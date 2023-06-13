<?php
    session_start();
    $usuario = $_SESSION['username'];
    $nombreEstudiante = $_SESSION['nombreEstudiante'];
    $apellidoEstudiante =  $_SESSION['apellidoEstudiante'];
    $tipo_documento_estudiante = $_SESSION['tipoDocumentoEstudiante'];
    $sexo_Estudiante = $_SESSION['sexoEstudiante'];
    $documento_estudiante = $_SESSION['documentoEstudiante'];
    $etnia_estudiante = $_SESSION['etniaEstudiante'];
    $telefono_estudiante =  $_SESSION['telefonoEstudiante'];
    $correo_estudiante = $_SESSION['correoEstudiante'];
    $estrato_estudiante = $_SESSION['estratoEstudiante'];
    $direccion_estudiante = $_SESSION['direccionEstudiante'];
    $ciudad_muni_estudiante = $_SESSION['ciudadMuniEstudiante'];
    $depto_resi_estudiante = $_SESSION['deptoResiEstudiante'];
    $postal_estudiante = $_SESSION['postalEstudiante'];
    if(!isset($usuario)){
        header("location: ../login.php");
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Datos Personales</title>
  <link rel="stylesheet" href="../css/estudiante_css/datos_personales.css">
</head>
<body>
<header>
    <div class="user-corner">
      <h1>Datos Personales</h1>
      <span class="welcome-message">Bienvenido a sus datos personales, <?php echo $usuario ?></span>
    </div>
    <a href="paginaPrincipalEstudiante.php" class="btn-volver">Volver</a>
  </header>
  <main>
    <h2>Datos Personales</h2>
    <div class="datos-container">
      <ul class="datos-list">
        <?php
        // Aquí puedes obtener los datos personales de la base de datos
        $nombres = $nombreEstudiante;
        $apellidos = $apellidoEstudiante;
        $tipoDocumento = $tipo_documento_estudiante;
        $numeroDocumento = $documento_estudiante;
        $sexo = $sexo_Estudiante;
        $etnia = $etnia_estudiante;
        $telefonoMovil = $telefono_estudiante;
        $correoPersonal = $correo_estudiante;
        $estrato = $estrato_estudiante;
        $direccion = $direccion_estudiante;
        $ciudad_muni = $ciudad_muni_estudiante;
        $departamento_resi = $depto_resi_estudiante;
        $codigo_postal = $postal_estudiante;
        
        // Imprime los datos personales en la página
        echo "<li><strong>Nombres:</strong> $nombres </li>";
        echo "<li><strong>Apellidos:</strong> $apellidos</li>";
        echo "<li><strong>Tipo de documento:</strong> $tipoDocumento</li>";
        echo "<li><strong>Número de documento:</strong> $numeroDocumento</li>";
        echo "<li><strong>Sexo:</strong> $sexo</li>";
        echo "<li><strong>Etnia:</strong> $etnia</li>";
        echo "<li><strong>Teléfono móvil:</strong> $telefonoMovil</li>";
        echo "<li><strong>Correo personal:</strong> $correoPersonal</li>";
        echo "<li><strong>Estrato:</strong> $estrato</li>";
        echo "<li><strong>Dirección:</strong> $direccion</li>";
        echo "<li><strong>Ciudad/Municipio:</strong> $ciudad_muni</li>";
        echo "<li><strong>Departamento de residencia:</strong> $departamento_resi</li>";
        echo "<li><strong>Codigo postal:</strong> $codigo_postal</li>";
        ?>
      </ul>
    </div>
  </main>
</body>
</html>
