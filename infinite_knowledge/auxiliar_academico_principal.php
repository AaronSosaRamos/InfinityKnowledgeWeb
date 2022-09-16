<?php require_once('plantillas/head.php'); 

    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/AuxiliarAcademicoDAO.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/UsuarioDAO.php');
    
    if((empty($_SESSION['dni']) && empty($_SESSION['rol'])) || ($_SESSION['rol']!=2)){
        header("Location:index.php");
        exit;
    }
?>

    <body>
        <section id="iniciar-sesion">
            <div class="container">
                <img class="imagen" src="img/logo.png" alt="">
                <br>
                <h3> Auxiliar Académico: </h3>
                <?php $auxiiarAcadémicoDAO = new AuxiliarAcademicoDAO(); $usuarioDAO = new UsuarioDAO(); ?>
                <br>
                <h3> <?php echo $auxiiarAcadémicoDAO->buscarNombreCompleto(); ?> </h3>
                <h3> <?php echo $usuarioDAO->buscarCorreoPorDNI($_SESSION['dni']); ?> </h3>
                <br><br>
                <h1> Seleccione la opción que dese </h1>
                <button type="button"> <a href="gestionar_docentes.php"> Gestionar docentes </a> </button>
                <button type="button"> <a href="cerrar_sesion.php"> Cerrar sesión </a> </button>
            </div>
        </section>
    </body>
</html>