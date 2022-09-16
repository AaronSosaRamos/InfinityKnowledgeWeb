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
            <br>
            <?php $estudianteDAO = new EstudianteDAO(); $usuarioDAO = new UsuarioDAO(); ?>
                <br>
                <br>
                <h3> <?php echo $estudianteDAO->buscarNombreCompletoPorDNI($_SESSION['dni']); ?> </h3>
                <h3> <?php echo $usuarioDAO->buscarCorreoPorDNI($_SESSION['dni']); ?> </h3>
            <br><br>
            <table class="modeloTabla">
                <thead>
                    <tr>
                        <th>  Estudiante  </th>
                        <th>  Docente  </th>
                        <th>  Curso  </th>
                        <th>  Salón  </th>
                        <th>  Calificación 1  </th>
                        <th>  Calificación 2  </th>
                        <th>  Calificación 3  </th>
                        <th>  Promedio Final  </th>
                        <th>  Estado  </th>
                        <th>  Fecha de emisión  </th>
                    </tr>
                </thead>
                <?php
                
                    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/RegistroCalificaciones.php');
                    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/RegistroCalificacionesDAO.php');
                    $registroCalificacionesDAO = new RegistroCalificacionesDAO();

                    $registros = $registroCalificacionesDAO->buscarPorDNIEstudiante($_SESSION['dni'],$_GET['id']);

                    foreach($registros as $registro){
                ?>
                <tr>
                    <td> <?php echo $registro[0]->getNombreCompleto() ?> </td>
                    <td> <?php echo $registro[1]->getNombreCompleto() ?> </td>
                    <td> <?php echo $registro[2]->getNombre() ?> </td>
                    <td> <?php echo $registro[3]->getSalonClases() ?> </td>
                    <td> <?php echo $registro[3]->getCalif1() ?> </td>
                    <td> <?php echo $registro[3]->getCalif2() ?> </td>
                    <td> <?php echo $registro[3]->getCalif3() ?> </td>
                    <td> <?php echo $registro[3]->getPromedioFinal() ?> </td>
                    <td> <?php echo $registro[3]->getEstadoAprobacion() ?> </td>
                    <td> <?php echo $registro[3]->getFechaEmision() ?> </td>
                </tr>
                <?php } ?>
            </table>
            <br>
            <button> <a href="seleccion_curso_calificaciones_estudiante.php"> Regresar </a> </button>
        </div>
    </section>
</body>
</html>