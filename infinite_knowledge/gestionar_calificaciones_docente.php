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
                        <th>  Acciones  </th>
                    </tr>
                </thead>
                <?php
                
                    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/RegistroCalificaciones.php');
                    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/RegistroCalificacionesDAO.php');
                    $registroCalificacionesDAO = new RegistroCalificacionesDAO();

                    $registros = $registroCalificacionesDAO->buscarParaDocente($_SESSION['dni'],$_GET['id']);

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
                    <td> <a href="<?php echo "modificar_registro_calificaciones.php?idDocente=".$registro[3]->getDocenteId()."&idEstudiante=".$registro[3]->getEstudianteId()."&idCurso=".$registro[3]->getCursoId(); ?>"> Modificar </a>
                    <br> 
                    <a href="<?php echo "eliminar_registro_calificaciones.php?idDocente=".$registro[3]->getDocenteId()."&idEstudiante=".$registro[3]->getEstudianteId()."&idCurso=".$registro[3]->getCursoId(); ?>"> Eliminar </td>
                </tr>
                <?php } ?>
            </table>
            <br>
            <button> <a href="insertar_registro_calificaciones.php "> Insertar calificaciones </a> </button>
            <BUtton>Generar Reporte</BUtton>
            <br><br>
            <button> <a href="seleccion_curso_calificaciones_docentes.php"> Regresar </a> </button>
        </div>
    </section>
</body>
</html>