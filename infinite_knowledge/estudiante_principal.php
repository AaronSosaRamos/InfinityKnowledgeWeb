<?php require_once('plantillas/head.php'); 

    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/EstudianteDAO.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/UsuarioDAO.php');
    
    if((empty($_SESSION['dni']) && empty($_SESSION['rol'])) || ($_SESSION['rol']!=4)){
        header("Location:index.php");
        exit;
    }
?>

    <body>
        <section id="iniciar-sesion">
            <div class="container">
                <img class="imagen" src="img/logo.png" alt="">
                <h3> Estudiante: </h3>
                <br>
                <?php $estudianteDAO = new EstudianteDAO(); $usuarioDAO = new UsuarioDAO(); ?>
                <br>
                <br>
                <h3> <?php echo $estudianteDAO->buscarNombreCompletoPorDNI($_SESSION['dni']); ?> </h3>
                <h3> <?php echo $usuarioDAO->buscarCorreoPorDNI($_SESSION['dni']); ?> </h3>
                <h1> Seleccione la opción que dese </h1>
                <button type="button"> <a href="ver_material_de_clase_estudiante.php"> Ver material de clase </a> </button>
                <button type="button"> <a href="seleccion_curso_asistencias_estudiante.php"> Ver asistencias </a> </button>
                <button type="button"> <a href="seleccion_curso_calificaciones_estudiante.php"> Ver calificaciones </a> </button>
                <button type="button"> <a href="cerrar_sesion.php"> Cerrar sesión </a> </button>
            </div>
        </section>
    </body>
</html>