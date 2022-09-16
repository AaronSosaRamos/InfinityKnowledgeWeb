<?php require_once('plantillas/head.php'); 
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/DocenteDAO.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/UsuarioDAO.php');

    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/RegistroCalificaciones.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/RegistroCalificacionesDAO.php');

    $registroCalificacionesDAO = new RegistroCalificacionesDAO();
    
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
            <br>
            <h4> Eliminar registro de calificaciones: </h4>
            <br>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="  " method="post">
            <?php
                if($_SERVER["REQUEST_METHOD"]=="POST"){
                    $registroCalificaciones = new RegistroCalificaciones();
                    $registroCalificaciones->construirObjeto($_POST["idDocente"],$_POST["idEstudiante"],$_POST["idCurso"],$_POST["salonClases"],intval($_POST["calif1"]),
                    intval($_POST["calif2"]),intval($_POST["calif3"]),$_POST["fechaDeEmision"]);

                    $registroCalificacionesDAO->eliminar($registroCalificaciones);
                    header("Location: gestionar_calificaciones_docente.php?id=".$registroCalificaciones->getCursoId());
                }
                else{
                    $registro = $registroCalificacionesDAO->buscarRegistroEspecifico($_GET['idEstudiante'],$_GET['idDocente'],$_GET['idCurso']);
                }
            ?>
                <label for="">Estudiante:</label>
                <input name="estudiante" type="text" required="" value="<?php echo $registro[0]->getNombreCompleto(); ?>">
                <br><br>
                <label for="">Docente:</label>
                <input name="docente" type="text" value="<?php echo $registro[1]->getNombreCompleto(); ?>">
                <br><br>
                <label for="">Curso:</label>
                <input name="curso" type="text" value="<?php echo $registro[2]->getNombre(); ?>">
                <br><br>
                <label for="">Salón de clases:</label>
                <input name="salonClases" type="text" value="<?php echo $registro[3]->getSalonClases(); ?>">
                <br><br>
                <label for="">Calificación 1:</label>
                <input name="calif1" type="text" value="<?php echo $registro[3]->getCalif1(); ?>">
                <br><br>
                <label for="">Calificación 2:</label>
                <input name="calif2" type="text" value="<?php echo $registro[3]->getCalif2(); ?>">
                <br><br>
                <label for="">Calificación 3:</label>
                <input name="calif3" type="text" value="<?php echo $registro[3]->getCalif3(); ?>">
                <br><br>
                <label for="">Promedio final:</label>
                <input name="promedioFinal" type="text" value="<?php echo $registro[3]->getPromedioFinal(); ?>">
                <br><br>
                <label for="">Estado:</label>
                <input name="estado" type="text" value="<?php echo $registro[3]->getEstadoAprobacion(); ?>">
                <br><br>
                <label for="">Fecha de emisión:</label>
                <input name="fechaDeEmision" type="date" value="<?php echo $registro[3]->getFechaEmision(); ?>">
                <br><br>
                <input name="idEstudiante" type="hidden" required="" value="<?php echo $registro[3]->getEstudianteId(); ?>">
                <input name="idDocente" type="hidden" required="" value="<?php echo $registro[3]->getDocenteId(); ?>">
                <input name="idCurso" type="hidden" required="" value="<?php echo $registro[3]->getCursoId(); ?>">
                <button type="submit"> Enviar </button>
                <a href="<?php echo "gestionar_calificaciones_docente.php?id=".$registro[3]->getCursoId(); ?>">  Regresar </a>
            </form>
        </div>
    </section>
</body>
</html>