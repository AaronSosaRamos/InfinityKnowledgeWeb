<?php require_once('plantillas/head.php'); 

    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/DirectorAcademicoDAO.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/UsuarioDAO.php');
    
    if((empty($_SESSION['dni']) && empty($_SESSION['rol'])) || ($_SESSION['rol']!=1)){
        header("Location:index.php");
        exit;
    }
?>


<body>
        <section id="iniciar-sesion">
            <div class="container">
                <img class="imagen" src="img/logo.png" alt="">
                <br>
                <h3> Director Académico: </h3>
                <?php $directorAcadémicoDAO = new DirectorAcademicoDAO(); $usuarioDAO = new UsuarioDAO(); ?>
                <br>
                <h3> <?php echo $directorAcadémicoDAO->buscarNombreCompleto(); ?> </h3>
                <h3> <?php echo $usuarioDAO->buscarCorreoPorDNI($_SESSION['dni']); ?> </h3>
                <br><br>
                <h1> Seleccione el miembro: </h1>
                <button type="button"> <a href="gestionar_director_academico.php"> Director Académico </a> </button>
                <button type="button"> <a href="gestionar_auxiliar_academico.php"> Auxiliar Académico </a> </button>
                <button type="button"> <a href="gestionar_docentes.php"> Docente </a> </button>
                <button type="button"> <a href="gestionar_estudiantes.php"> Estudiante </a> </button>
                <button type="button"> <a href="director_academico_principal.php"> Regresar </a> </button>
            </div>
        </section>
    </body>
</html>