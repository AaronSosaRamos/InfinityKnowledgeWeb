<?php require_once('plantillas/head.php'); 
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/DocenteDAO.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/UsuarioDAO.php');

    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/Estudiante.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/EstudianteDAO.php');

    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/Docente.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/DocenteDAO.php');

    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/Curso.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/CursoDAO.php');

    if((empty($_SESSION['dni']) && empty($_SESSION['rol'])) || ($_SESSION['rol']!=3)){
        header("Location:index.php");
        exit;
    }

    $estudianteDAO = new EstudianteDAO(); $estudiantesListados = $estudianteDAO->listarNombres();
    $docenteDAO = new DocenteDAO(); $docente = $docenteDAO->buscarPorDNI($_SESSION["dni"]);
    $cursoDAO = new CursoDAO(); $cursosListados = $cursoDAO->listarCursosParaDocente($_SESSION["dni"]);

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
            <h4> Insertar registro de asistencia: </h4>
            <br>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="  " method="post">
                <label for="">Estudiante:</label>
                <select name="estudiante" id="">
                    <?php
                        foreach($estudiantesListados as $estudiante){
                    ?>
                    <option value="<?php echo $estudiante->getMiembroId(); ?>"> <?php echo $estudiante->getNombreCompleto(); ?> </option>
                    <?php
                        }
                    ?>
                </select>
                <br><br>
                <label for="">Docente:</label>
                <input name="docente" type="text" value="<?php echo $docente->getNombreCompleto() ?>">
                <br><br>
                <label for="">Curso:</label>
                <select name="curso" id="">
                    <?php
                        foreach($cursosListados as $curso){
                    ?>
                    <option value="<?php echo $curso->getCursoId(); ?>"> <?php echo $curso->getNombre(); ?> </option>
                    <?php
                        }
                    ?>
                </select>
                <br><br>
                <label for="">Salón de clases:</label>
                <input name="salonClases" type="text">
                <br><br>
                <label for="">N. de asistencias:</label>
                <input name="asistencias" type="text">
                <br><br>
                <label for="">N. de justificaciones:</label>
                <input name="justificaciones">
                <br><br>
                <label for="">Fecha de emisión:</label>
                <input name="fechaDeEmision" type="date">
                <br><br>
                <button type="submit"> Enviar </button>
                <a href="docente_principal.php"> Regresar </a>
            </form>
            <?php
                if($_SERVER["REQUEST_METHOD"]=="POST"){
                    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/RegistroAsistencias.php');
                    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/RegistroAsistenciasDAO.php');

                    $registroAsistencias = new RegistroAsistencias();
                    $registroAsistencias->construirObjeto($docente->getMiembroId(),$_REQUEST["estudiante"],$_REQUEST["curso"],$_POST["salonClases"],$_POST["asistencias"],
                    $_POST["justificaciones"],$_POST["fechaDeEmision"]);

                    $banderaErrores = false;
                    $arrayMensajes = $registroAsistencias->validarCampos();
    
                    if(count($arrayMensajes)>0){
                        $banderaErrores = true;
                    }
                    else{
                        try{
                            $registroAsistenciasDAO = new RegistroAsistenciasDAO();
                            $registroAsistenciasDAO->insertar($registroAsistencias);
                            $banderaErrores = false;
                        }
                        catch(Exception $e){
                            $arrayMensajes[]=$e->getMessage();
                            $banderaErrores = true;
                        }
                    }
    
                    if(!$banderaErrores){
                        echo "<p> Registro de asistencia insertado satisfactoriamente </p>";
                        header("Location: gestionar_asistencias_docente.php?id=".$registroAsistencias->getCursoId());
                    }
                    else{
                        foreach($arrayMensajes as $mensaje){
                            echo "<p>".$mensaje."</p>";
                        }
                    }
                }
            ?>
        </div>
    </section>
</body>
</html>