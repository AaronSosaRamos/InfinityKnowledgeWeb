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
                <h1> Gestionar cursos: </h1>
                <table class="modeloTabla">
                    <thead>
                        <tr>
                            <th> Id </th>
                            <th> Nombre </th>
                            <th> Número de horas </th>
                            <th> Enfoque de curso </th>
                            <th> Acciones </th>
                        </tr>
                    </thead>
                    <?php
                        require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/CursoDAO.php');
                        require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/Curso.php');

                        $cursoDAO = new CursoDAO();
                        $cursosListados = $cursoDAO->listar();

                        foreach($cursosListados as $curso){
                    ?>
                    <tr>
                        <td> <?php echo $curso->getCursoId(); ?> </td>
                        <td> <?php echo $curso->getNombre(); ?> </td>
                        <td> <?php echo $curso->getNHoras(); ?> </td>
                        <td> <?php echo $curso->getEnfoqueCurso(); ?> </td>
                        <td> <a href="modificar_curso.php?id=<?php echo $curso->getCursoId(); ?>"> Modificar </a> <br>
                        <a href="eliminar_curso.php?id=<?php echo $curso->getCursoId(); ?>"> Eliminar </a> </td>
                    </tr>
                    <?php } ?>
                </table>
                <button type="button"> <a href="insertar_curso_director_academico.php"> Insertar </a> </button>
                <button type="button"> <a href="director_academico_principal.php"> Regresar </a> </button>
            </div>
        </section>
    </body>
</html>