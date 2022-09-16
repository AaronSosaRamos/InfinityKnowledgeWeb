<?php require_once('plantillas/head.php'); 
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/EstudianteDAO.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/UsuarioDAO.php');
    
    if((empty($_SESSION['dni']) && empty($_SESSION['rol'])) || ($_SESSION['rol']!=4)){
        header("Location:index.php");
        exit;
    }

?>

<body>
    <section>
        <div class="container">
            <img src="img/logo.png" alt="">
            <h3> Estudiante: </h3>
            <?php $estudianteDAO = new EstudianteDAO(); $usuarioDAO = new UsuarioDAO(); ?>
                <h3> <?php echo $estudianteDAO->buscarNombreCompletoPorDNI($_SESSION['dni']); ?> </h3>
                <h3> <?php echo $usuarioDAO->buscarCorreoPorDNI($_SESSION['dni']); ?> </h3>
            <br>
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

                    $cursos = $cursoDAO->listarNombresPorDNIEstudiante($_SESSION['dni']);

                    foreach($cursos as $curso){
                ?>
                <tr>
                    <td> <a href="<?php echo "ver_asistencia_de_estudiantes.php?id=".$curso->getCursoId(); ?>"> <?php echo $curso->getNombre(); ?> </a> </td>
                </tr>
                <?php } ?>
            </table>
            <br>
            <br><br>
            <button> <a href="estudiante_principal.php "> Regresar </a> </button>
        </div>
    </section>
</body>
</html>