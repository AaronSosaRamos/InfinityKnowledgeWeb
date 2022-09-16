<?php require_once('plantillas/head.php'); 
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/DocenteDAO.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/UsuarioDAO.php');

    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/RegistroAsistencias.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/RegistroAsistenciasDAO.php');

    $registroAsistenciasDAO = new RegistroAsistenciasDAO();
    
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
            <h4> Modificar registro de asistencia: </h4>
            <br>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="  " method="post">
            <?php
                if($_SERVER["REQUEST_METHOD"]=="POST"){
                    $registroAsistencias = new RegistroAsistencias();
                    $registroAsistencias->construirObjeto($_POST["idDocente"],$_POST["idEstudiante"],$_POST["idCurso"],$_POST["salonClases"],$_POST["asistencias"],
                    $_POST["justificaciones"],$_POST["fechaDeEmision"]);

                    $banderaErrores = false;
                    $arrayMensajes = $registroAsistencias->validarCampos();
    
                    if(count($arrayMensajes)>0){
                        $banderaErrores = true;
                    }
                    else{
                        try{
                            $registroAsistenciasDAO->actualizar($registroAsistencias);
                            $banderaErrores = false;
                        }
                        catch(Exception $e){
                            $arrayMensajes[]=$e->getMessage();
                            $banderaErrores = true;
                        }
                    }
    
                    if(!$banderaErrores){
                        echo "<p> Registro de asistencia modificado satisfactoriamente </p>";
                        header("Location: gestionar_asistencias_docente.php?id=".$registroAsistencias->getCursoId());
                    }
                    else{
                        foreach($arrayMensajes as $mensaje){
                            echo "<p>".$mensaje."</p>";
                        }
                    }
                }
                else{
                    $registro = $registroAsistenciasDAO->buscarRegistroEspecifico($_GET['idEstudiante'],$_GET['idDocente'],$_GET['idCurso']);
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
                <label for="">N. de asistencias:</label>
                <input name="asistencias" type="text" value="<?php echo $registro[3]->getNAsistenciasRealizadas(); ?>">
                <br><br>
                <label for="">N. de faltas:</label>
                <input name="faltas" type="text" value="<?php echo $registro[3]->getNFaltasRealizadas(); ?>">
                <br><br>
                <label for="">N. de justificaciones:</label>
                <input name="justificaciones" type="text" value="<?php echo $registro[3]->getNJustificacionesRealizadas(); ?>">
                <br><br>
                <label for="">Total:</label>
                <input name="total" type="text" value="<?php echo $registro[3]->getNTotalAsistencias(); ?>">
                <br><br>
                <label for="">Fecha de emisión:</label>
                <input name="fechaDeEmision" type="date" value="<?php echo $registro[3]->getFechaEmision(); ?>">
                <br><br>
                <input name="idEstudiante" type="hidden" required="" value="<?php echo $registro[3]->getEstudianteId(); ?>">
                <input name="idDocente" type="hidden" required="" value="<?php echo $registro[3]->getDocenteId(); ?>">
                <input name="idCurso" type="hidden" required="" value="<?php echo $registro[3]->getCursoId(); ?>">
                <button type="submit"> Enviar </button>
                <a href="<?php echo "gestionar_asistencias_docente.php?id=".$registro[3]->getCursoId(); ?>"> Regresar </a>
            </form>
        </div>
    </section>
</body>
</html>