<?php require_once('plantillas/head.php'); 
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/DocenteDAO.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/UsuarioDAO.php');
    
    if((empty($_SESSION['dni']) && empty($_SESSION['rol'])) || ($_SESSION['rol']!=3)){
        header("Location:index.php");
        exit;
    }

?>

<body>
    <section>
        <div class="container">
            <img src="img/logo.png" alt="">
            <h3> Docente: </h3>
            <?php $docenteDAO = new DocenteDAO(); $usuarioDAO = new UsuarioDAO(); ?>
            <h3> <?php echo $docenteDAO->buscarNombreCompletoPorDNI($_SESSION['dni']); ?> </h3>
            <h3> <?php echo $usuarioDAO->buscarCorreoPorDNI($_SESSION['dni']); ?> </h3>
            <br><br>
            <table class="modeloTabla">
            <h2>Seleccionar curso</h2>
            <br><br>
            <table class="modeloTabla">
                <thead>
                    <tr>
                        <th>Curso</th>
                    </tr>
                </thead>
                <?php
                
                    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/Curso.php');
                    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/CursoDAO.php');
                    $cursoDAO = new CursoDAO();

                    $cursos = $cursoDAO->listarCursosParaDocente($_SESSION['dni']);

                    foreach($cursos as $curso){
                ?>
                <tr>
                    <td> <a href="<?php echo "gestionar_calificaciones_docente.php?id=".$curso->getCursoId(); ?>"> <?php echo $curso->getNombre(); ?> </a> </td>
                </tr>
                <?php } ?>
            </table>
            <br>
            <br><br>
            <button> <a href="insertar_registro_calificaciones.php "> Insertar calificaciones </a> </button>
            <button> <a href="docente_principal.php "> Regresar </a> </button>
        </div>
    </section>
</body>
</html>