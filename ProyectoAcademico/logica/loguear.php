<?php
require 'conexion.php';
session_start();
//Variables que traen los datos de nombre de usuario y contraseña
//$usuario = $_POST['username'];
//$clave = $_POST['password'];
$usuario = $_SESSION['username'];

/*
//creacion de las consultas a la base de datos para login
$q = "SELECT COUNT(*) as contar_est FROM estudiante where usuario = '$usuario' and contrasena = '$clave'";
$q2= "SELECT COUNT(*) as contar_prof FROM profesor where usuario_profesor = '$usuario' and contrasena_profesor = '$clave'";
$q3= "SELECT COUNT(*) as contar_admin FROM administrador where usuario = '$usuario' and contrasena = '$clave'";


$consulta_est = mysqli_query($conexion,$q);
$array_est = mysqli_fetch_array($consulta_est);


$consulta_prof = mysqli_query($conexion,$q2);
$array_prof = mysqli_fetch_array($consulta_prof);


$consulta_admin = mysqli_query($conexion,$q3);
$array_admin = mysqli_fetch_array($consulta_admin);

*/

// DATOS PERSONALES ESTUDIANTE
$datos = "call pr_datosPersonales ('$usuario');";
$res = mysqli_query($conexion,$datos);

$rowDatos= mysqli_fetch_assoc($res);


$nombre = $rowDatos['nombres'];
$_SESSION['nombreEstudiante'] = $nombre;

$tipo_documento = $rowDatos['tipo_documento'];
$_SESSION['tipoDocumentoEstudiante'] = $tipo_documento;

$documento_Estudiante = $rowDatos['documento_est'];
$_SESSION['documentoEstudiante'] = $documento_Estudiante;

$apellidoEstudiante = $rowDatos['apellidos'];
$_SESSION['apellidoEstudiante'] = $apellidoEstudiante;

$sexo = $rowDatos['sexo'];
$_SESSION['sexoEstudiante'] = $sexo;

$etnia = $rowDatos['etnia'];
$_SESSION['etniaEstudiante'] = $etnia;

$telefono_Estudiante = $rowDatos['telefono_movil'];
$_SESSION['telefonoEstudiante'] = $telefono_Estudiante;

$correo_Estudiante = $rowDatos['correo_personal'];
$_SESSION['correoEstudiante'] = $correo_Estudiante;

$estrato_Estudiante = $rowDatos['estrato'];
$_SESSION['estratoEstudiante'] = $estrato_Estudiante;

$direccion_Estudiante = $rowDatos['descripcion_dir'];
$_SESSION['direccionEstudiante'] = $direccion_Estudiante;

$ciudad_muni_Estudiante = $rowDatos['ciudad_muni_residencia'];
$_SESSION['ciudadMuniEstudiante'] = $ciudad_muni_Estudiante;

$depto_resi_Estudiante = $rowDatos['depto_residencia'];
$_SESSION['deptoResiEstudiante'] = $depto_resi_Estudiante;

$postal_Estudiante = $rowDatos['codigo_postal'];
$_SESSION['postalEstudiante'] = $postal_Estudiante;

mysqli_free_result($res);
mysqli_next_result($conexion);


// NOTAS ESTUDIANTE 


$horario = "call pr_horario_estudiante ('$usuario', 2023, 1);";
$horario2 = array();

    if (mysqli_multi_query($conexion,$horario)) {
        do {
            if ($result = mysqli_store_result($conexion)) {
                // Process each result set
                while ($rowHorario = mysqli_fetch_assoc($result)) {
                    // Access the values of each row
                    // Example: echo $row['column_name'];
                    $horario2[$rowHorario['codigo_asignatura']] = array($rowHorario['nombre_asignatura'], $rowHorario['definitiva']);
                    //print_r($rowHorario);
                }
                mysqli_free_result($result);
            }
        } while (mysqli_next_result($conexion));
    } else {
        echo "Error: " . mysqli_error($conexion);
    }

//print_r($horario2);

$llaves_horario = array_keys($horario2);

$_SESSION['llavesHorario'] = $llaves_horario;
$_SESSION['nombresHorario'] = $horario2;



//horario academico

if (mysqli_multi_query($conexion,$horario)) {
    $count = 0;
    do {
        if ($result2 = mysqli_store_result($conexion)) {
            // Process each result set
            while ($rowHorario2 = mysqli_fetch_assoc($result2)) {
                // Access the values of each row
                // Example: echo $row['column_name'];
                $horario3[$count] = $rowHorario2;
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

//print_r($horario3);

$llaves_horario2 = array_keys($horario3);

$_SESSION['llavesHorario2'] = $llaves_horario2;
$_SESSION['nombresHorario2'] = $horario3;


// historia académica

$historia = "call pr_historia_acd('$usuario');";
$resHistoria = mysqli_query($conexion,$historia);

$rowDatosHistoria= mysqli_fetch_assoc($resHistoria);

$codigo_historia = $rowDatosHistoria['codigo_historia_aca'];
$_SESSION['codigoHistoria'] = $codigo_historia;

$papa = $rowDatosHistoria['P.A.P.A'];
$_SESSION['PAPA'] = $papa;

$pa = $rowDatosHistoria['P.A'];
$_SESSION['PA'] = $pa;

$avance = $rowDatosHistoria['avance_carrera'];
$_SESSION['avanceCarrera'] = $avance;

$creditos_aprobados = $rowDatosHistoria['creditos_aprobados'];
$_SESSION['creditosAprobados'] = $creditos_aprobados;

$creditos_disponibles = $rowDatosHistoria['creditos_disponibles'];
$_SESSION['creditosDisponibles'] = $creditos_disponibles;

$creditos_inscritos = $rowDatosHistoria['creditos_inscritos'];
$_SESSION['creditosInscritos'] = $creditos_inscritos;

$estado = $rowDatosHistoria['estado'];
$_SESSION['estadoHistoria'] = $estado;

$ano = $rowDatosHistoria['Semestre_ano'];
$_SESSION['ano'] = $ano;

$periodo = $rowDatosHistoria['Semestre_periodo'];
$_SESSION['periodo'] = $periodo;

$nombre_carrera = $rowDatosHistoria['nombre_carrera'];
$_SESSION['carrera'] = $nombre_carrera;

mysqli_free_result($resHistoria);
mysqli_next_result($conexion);


// notas historia academica 

$notasHistoria = "CALL pr_horario_estudiante_historia ('$usuario');";
$notasHistoria2 = array();

    if (mysqli_multi_query($conexion,$notasHistoria)) {
        do {
            if ($result5 = mysqli_store_result($conexion)) {
                // Process each result set
                while ($rowNotasHistoria = mysqli_fetch_assoc($result5)) {
                    // Access the values of each row
                    // Example: echo $row['column_name'];
                    $notasHistoria2[$rowNotasHistoria['codigo_asignatura']] = array($rowNotasHistoria['nombre_asignatura'], $rowNotasHistoria['definitiva']);
                    //print_r($rowHorario);
                }
                mysqli_free_result($result5);
            }
        } while (mysqli_next_result($conexion));
    } else {
        echo "Error: " . mysqli_error($conexion);
    }

//print_r($horario2);

$llaves_historia = array_keys($notasHistoria2);

$_SESSION['llavesHistoria'] = $llaves_historia;
$_SESSION['nombresHistoria'] = $notasHistoria2;


// cita de inscripcion

$cita = "call pr_citaInscripcion('$usuario', 2023, 1);";
$cita2 = array();

if (mysqli_multi_query($conexion,$cita)) {
    $count = 0;
    do {
        if ($resultCita = mysqli_store_result($conexion)) {
            // Process each result set
            while ($rowCita = mysqli_fetch_assoc($resultCita)) {
                // Access the values of each row
                // Example: echo $row['column_name'];
                $cita2[$count] = $rowCita;
                $count = $count +1;
                //print_r($rowHorario2);
                //print_r($horario3);
            }
            mysqli_free_result($resultCita);
        }
    } while (mysqli_next_result($conexion));
} else {
    echo "Error: " . mysqli_error($conexion);
}

//print_r($cita2);

$_SESSION['nombresCita'] = $cita2;



// asignaturas pendientes 

$pendientes = "call pr_asig_pendientes ('$usuario');";
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

print_r($pendientes2);

$_SESSION['nombresPendientes'] = $pendientes2;


header("location: ../estudiante/paginaPrincipalEstudiante.php");


/*
$result_datos = $datos2;
    $q4 = $result_datos;
    $q5 = $result_datos["apellidos"];
    $q6 = $result_datos["tipo_documento"];
    $q7 = $result_datos["sexo"];
    $q8 = $result_datos["documento_est"];
    $q9 = $result_datos["etnia"];
    $q10 = $result_datos["telefono_movil"];
    $q11 = $result_datos["correo_personal"];
    $q12 = $result_datos["estrato"];
    $q13 = $result_datos["descripcion_dir"];
    $q14 = $result_datos["ciudad_muni_residencia"];
    $q15 = $result_datos["depto_residencia"];
    $q16 = $result_datos["codigo_postal"];
*/

//------------------------------------------------------



//realizar la comprobacion teniendo en cuenta los resultados de las consultas en la base de datos
/*
if($array_est['contar_est']>0){
    $_SESSION['username'] = $usuario;
    header("location: ../estudiante/paginaPrincipalEstudiante.php");
} else {
    echo "<h1> Datos incorrectos </h1>";
    echo "<a href='../login.php'> VOLVER AL MENÚ DE LOGIN </a>";
}
*/
//validaciones para datos personales
/*
if ($result_nombre->num_rows > 0) {
    // Obtener el nombre del estudiante y guardarlo en una variable de sesión
    $row = $result_nombre->fetch_assoc();
    $nombreEstudiante = $row["nombres"];
    $_SESSION['nombreEstudiante'] = $nombreEstudiante;
    header("Location: ../estudiante/paginaPrincipalEstudiante.php");
} else {
    echo "No se encontraron registros.";
}




if ($result_apellido->num_rows > 0) {
    $row = $result_apellido->fetch_assoc();
    $apellidoEstudiante = $row["apellidos"];
    $_SESSION['apellidoEstudiante'] = $apellidoEstudiante;
    header("Location: ../estudiante/paginaPrincipalEstudiante.php");
} else {
    echo "No se encontraron registros.";
}

if ($result_sexo->num_rows > 0) {
    $row = $result_sexo->fetch_assoc();
    $sexo_Estudiante = $row["sexo"];
    $_SESSION['sexoEstudiante'] = $sexo_Estudiante;
    header("Location: ../estudiante/paginaPrincipalEstudiante.php");
} else {
    echo "No se encontraron registros.";
}

if ($result_documento->num_rows > 0) {
    $row = $result_documento->fetch_assoc();
    $documento_Estudiante = $row["documento_est"];
    $_SESSION['documentoEstudiante'] = $documento_Estudiante;
    header("Location: ../estudiante/paginaPrincipalEstudiante.php");
} else {
    echo "No se encontraron registros.";
}

if ($result_tipo_documento->num_rows > 0) {
    $row = $result_tipo_documento->fetch_assoc();
    $tipo_documento_Estudiante = $row["tipo_documento"];
    $_SESSION['tipoDocumentoEstudiante'] = $tipo_documento_Estudiante;
    header("Location: ../estudiante/paginaPrincipalEstudiante.php");
} else {
    echo "No se encontraron registros.";
}

if ($result_etnia->num_rows > 0) {
    $row = $result_etnia->fetch_assoc();
    $etnia_Estudiante = $row["etnia"];
    $_SESSION['etniaEstudiante'] = $etnia_Estudiante;
    header("Location: ../estudiante/paginaPrincipalEstudiante.php");
} else {
    echo "No se encontraron registros.";
}

if ($result_telefono->num_rows > 0) {
    $row = $result_telefono->fetch_assoc();
    $telefono_Estudiante = $row["telefono_movil"];
    $_SESSION['telefonoEstudiante'] = $telefono_Estudiante;
    header("Location: ../estudiante/paginaPrincipalEstudiante.php");
} else {
    echo "No se encontraron registros.";
}

if ($result_correo->num_rows > 0) {
    $row = $result_correo->fetch_assoc();
    $correo_Estudiante = $row["correo_personal"];
    $_SESSION['correoEstudiante'] = $correo_Estudiante;
    header("Location: ../estudiante/paginaPrincipalEstudiante.php");
} else {
    echo "No se encontraron registros.";
}

if ($result_estrato->num_rows > 0) {
    $row = $result_estrato->fetch_assoc();
    $estrato_Estudiante = $row["estrato"];
    $_SESSION['estratoEstudiante'] = $estrato_Estudiante;
    header("Location: ../estudiante/paginaPrincipalEstudiante.php");
} else {
    echo "No se encontraron registros.";
}

if ($result_direccion->num_rows > 0) {
    $row = $result_direccion->fetch_assoc();
    $direccion_Estudiante = $row["descripcion_dir"];
    $_SESSION['direccionEstudiante'] = $direccion_Estudiante;
    header("Location: ../estudiante/paginaPrincipalEstudiante.php");
} else {
    echo "No se encontraron registros.";
}

if ($result_ciudad_muni->num_rows > 0) {
    $row = $result_ciudad_muni->fetch_assoc();
    $ciudad_muni_Estudiante = $row["ciudad_muni_residencia"];
    $_SESSION['ciudadMuniEstudiante'] = $ciudad_muni_Estudiante;
    header("Location: ../estudiante/paginaPrincipalEstudiante.php");
} else {
    echo "No se encontraron registros.";
}

if ($result_depto_residencia->num_rows > 0) {
    $row = $result_depto_residencia->fetch_assoc();
    $depto_resi_Estudiante = $row["depto_residencia"];
    $_SESSION['deptoResiEstudiante'] = $depto_resi_Estudiante;
    header("Location: ../estudiante/paginaPrincipalEstudiante.php");
} else {
    echo "No se encontraron registros.";
}

if ($result_postal->num_rows > 0) {
    $row = $result_postal->fetch_assoc();
    $postal_Estudiante = $row["codigo_postal"];
    $_SESSION['postalEstudiante'] = $postal_Estudiante;
    header("Location: ../estudiante/paginaPrincipalEstudiante.php");
} else {
    echo "No se encontraron registros.";
}

*/






?>