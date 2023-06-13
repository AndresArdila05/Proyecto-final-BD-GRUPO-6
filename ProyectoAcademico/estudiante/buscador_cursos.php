<?php
    session_start();
    
    if (isset($_SESSION['username'])){
      $usuario = $_SESSION['username'];
      $volver = "paginaPrincipalEstudiante.php";
      if(!isset($usuario) ){
        header("location: ../login.php");
      } 
    }
    
    if (isset($_SESSION['usernameProfesor'])){
      $usuarioProfesor = $_SESSION['usernameProfesor'];
      $volver = "../profesor/paginaPrincipalProfesor.php";
      if(!isset($usuarioProfesor)){
        header("location: ../login.php");
      } 
    }

    
    

?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buscador de Cursos</title>
  <link rel="stylesheet" href="../css/estudiante_css/buscador_cursos.css">
</head>
<body>
  <header>
    <div class="user-corner">
      <h1>Buscador de cursos</h1>
      <span class="welcome-message">Bienvenido al buscador de cursos</span>
    </div>
    <?php
    echo "<a href=$volver class='btn-volver'>Volver</a>";
    ?>
  </header>

  <main>
  <div class="datos-container">
    <h2 class="title">Buscador de Cursos</h2>
    <form action="../logica/buscador.php" method="POST">
      <div class="form-group">
        <label for="nivel-estudio">Nivel de estudio:</label>
        <select id="nivel-estudio" name="nivel_estudio">
          <option value="" selected>-- Seleccionar una opción --</option>
          <option value="pregrado">Pregrado</option>
        </select>
      </div>
      <div class="form-group">
        <label for="sede">Sede:</label>
        <select id="sede" name="sede">
          <option value="" selected>-- Seleccionar una opción --</option>
          <option value="bogota">Sede Bogotá</option>
          <option value="medellin">Sede Medellín</option>
        </select>
      </div>
      <div class="form-group">
        <label for="facultad">Facultad:</label>
        <select id="facultad" name="facultad">
          <option value="" selected>-- Seleccionar una opción --</option>
          <option value="f_artes">Facultad de Artes</option>
          <option value="f_ciencias">Facultad de Ciencias</option>
          <option value="f_ciencias_agrarias">Facultad de Ciencias agrarias</option>
          <option value="f_ciencias_economicas">Facultad de Ciencias económicas</option>
          <option value="f_ciencias_humanas">Facultad de Ciencias humanas</option>
          <option value="f_derecho_cp">Facultad de Derecho y Ciencia política</option>
          <option value="f_enfermeria">Facultad de enfermería</option>
          <option value="f_ingenieria">Facultad de ingeniería</option>
          <option value="f_medicina">Facultad de medicina</option>
          <option value="f_medicina_vet_zoot">Facultad de medicina veterinaria y zootecnia</option>
          <option value="f_odontologia">Facultad de odontología</option>
        </select>
      </div>
      <div class="form-group">
        <label for="plan_estudios">Plan de estudios:</label>
        <select id="plan_estudios" name="plan_estudios">
          <option value="" selected>-- Seleccionar una opción --</option>
          <option value="ing_agricola">Ingeniería agrícola</option>
          <option value="ing_civil">Ingeniería civil</option>
          <option value="ing_sistemas_comp">Ingeniería de sistemas y computación</option>
          <option value="ing_industrial">Ingeniería industrial</option>
          <option value="ing_electrica">Ingeniería eléctrica</option>
          <option value="ing_electronica">Ingeniería electrónica</option>
          <option value="ing_mecanica">Ingeniería mecánica</option>
          <option value="ing_mecatronica">Ingeniería mecatrónica</option>
          <option value="ing_quimica">Ingeniería química</option>
        </select>
      </div>
      <div class="form-group">
        <label for="tipologia_asignatura">Tipología de asignatura:</label>
        <select id="tipologia_asignatura" name="tipologia_asignatura">
          <option value="" selected>-- Seleccionar una opción --</option>
          <option value="todas_menos_le">Todas menos libre elección</option>
          <option value="disciplinar_obli">Disciplinar obligatoria</option>
          <option value="nivelacion">Nivelación</option>
          <option value="trabajo_grado">Trabajo de grado</option>
          <option value="fundament_obli">Fundamentación obligatoria</option>
          <option value="disciplinar_opta">Disciplinar optativa</option>
          <option value="fundament_opta">Fundamentación optativa</option>
          <option value="libre_eleccion">Libre elección</option>
        </select>
      </div>
      <input type="hidden" id="plan_estudios_hidden" name="plan_estudios_hidden">
      <button type="submit" class="btn-submit">Buscar</button>
    </form>
  </div>
</main>
<script>
    // Obtener los elementos select de facultad y plan de estudios
    const facultadSelect = document.getElementById("facultad");
    const planEstudiosSelect = document.getElementById("plan_estudios");
    const planEstudiosHiddenInput = document.getElementById("plan_estudios_hidden");

    // Definir los planes de estudios disponibles para cada facultad
    const planesEstudiosPorFacultad = {
      f_artes: ["Plan de estudios 1", "Plan de estudios 2", "Plan de estudios 3"],
      f_ciencias: ["Física", "Ciencias de la Computación"],
      f_ciencias_agrarias: ["Plan de estudios 7", "Plan de estudios 8"],
      f_ciencias_economicas: ["Plan de estudios 9", "Plan de estudios 10"],
      f_ciencias_humanas: ["Plan de estudios 11", "Plan de estudios 12"],
      f_derecho_cp: ["Plan de estudios 13", "Plan de estudios 14"],
      f_enfermeria: ["Plan de estudios 15", "Plan de estudios 16"],
      f_ingenieria: ["Ingeniería agrícola", "Ingeniería civil", "Ingeniería de sistemas y computación", "Ingeniería industrial", "Ingeniería eléctrica", "Ingeniería electrónica", "Ingeniería mecánica", "Ingeniería mecatrónica", "Ingeniería química"],
      f_medicina: ["Plan de estudios 19", "Plan de estudios 20"],
      f_medicina_vet_zoot: ["Plan de estudios 21", "Plan de estudios 22"],
      f_odontologia: ["Plan de estudios 23", "Plan de estudios 24"],
    };

    // Función para actualizar las opciones de plan de estudios según la facultad seleccionada
    function actualizarOpcionesPlanEstudios() {
      const facultadSeleccionada = facultadSelect.value;
      const planesEstudios = planesEstudiosPorFacultad[facultadSeleccionada] || [];

      // Reiniciar el select de plan de estudios
      planEstudiosSelect.innerHTML = '<option value="" selected>-- Seleccionar una opción --</option>';

      // Agregar las opciones correspondientes a la facultad seleccionada
      planesEstudios.forEach((plan) => {
        const option = document.createElement("option");
        option.value = plan;
        option.textContent = plan;
        planEstudiosSelect.appendChild(option);
      });
    }

    // Escuchar el evento de cambio en el select de facultad y actualizar las opciones de plan de estudios
    facultadSelect.addEventListener("change", actualizarOpcionesPlanEstudios);

    // Llamar a la función inicialmente para mostrar las opciones correctas según la facultad seleccionada
    actualizarOpcionesPlanEstudios();


    planEstudiosSelect.addEventListener("change", () => {
    planEstudiosHiddenInput.value = planEstudiosSelect.value;
  });

  </script>

</body>
</html>
