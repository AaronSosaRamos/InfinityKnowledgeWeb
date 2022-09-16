<?php require_once('plantillas/head.php'); 

    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/DocenteDAO.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/UsuarioDAO.php');
    
    if((empty($_SESSION['dni']) && empty($_SESSION['rol'])) || ($_SESSION['rol']!=3)){
        header("Location:index.php");
        exit;
    }
?>

    <body>
        <section id="iniciar-sesion">
            <div class="container">
                <img class="imagen" src="img/logo.png" alt="">
                <br>
                <h3> Docente: </h3>
                <?php $docenteDAO = new DocenteDAO(); $usuarioDAO = new UsuarioDAO(); ?>
                <br>
                <br>
                <h3> <?php echo $docenteDAO->buscarNombreCompletoPorDNI($_SESSION['dni']); ?> </h3>
                <h3> <?php echo $usuarioDAO->buscarCorreoPorDNI($_SESSION['dni']); ?> </h3>
                <h1> Seleccione la opción que dese </h1>
                <button type="button"> <a href="subir_material_de_clase_docente.php"> Subir material de clase </a> </button>
                <button type="button"> <a href="gestionar_estudiantes.php"> Gestionar estudiantes </a> </button>
                <button type="button"> <a href="seleccion_curso_asistencias_docentes.php"> Gestionar asistencias </a> </button>
                <button type="button"> <a href="seleccion_curso_calificaciones_docentes.php"> Gestionar calificaciones </a> </button>
                <button type="button"> <a href="cerrar_sesion.php"> Cerrar sesión </a> </button>
            </div>
        </section>
    </body>
</html>