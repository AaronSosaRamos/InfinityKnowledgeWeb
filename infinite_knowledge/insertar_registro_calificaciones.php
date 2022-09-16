<?php require_once('plantillas/head.php'); 
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/DocenteDAO.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/UsuarioDAO.php');

    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/Estudiante.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/EstudianteDAO.php');

    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/Docente.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/DocenteDAO.php');

    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/Curso.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/CursoDAO.php');

    $estudianteDAO = new EstudianteDAO(); $estudiantesListados = $estudianteDAO->listarNombres();
    $docenteDAO = new DocenteDAO(); $docente = $docenteDAO->buscarPorDNI($_SESSION["dni"]);
    $cursoDAO = new CursoDAO(); $cursosListados = $cursoDAO->listarCursosParaDocente($_SESSION["dni"]);
    
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
            <h4> Insertar registro de calificaciones: </h4>
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
                <label for="">Calificación 1:</label>
                <input name="calif1" type="text">
                <br><br>
                <label for="">Calificación 2:</label>
                <input name="calif2" type="text">
                <br><br>
                <label for="">Calificación 3:</label>
                <input name="calif3" type="text">
                <br><br>
                <label for="">Promedio final:</label>
                <input name="promedioFinal" type="text">
                <br><br>
                <label for="">Estado:</label>
                <input name="estado" type="text">
                <br><br>
                <label for="">Fecha de emisión:</label>
                <input name="fechaDeEmision" type="date">
                <br><br>
                <button type="submit"> Enviar </button>
                <a href="seleccion_curso_calificaciones_docentes.php">  Regresar </a>
            </form>
        </div>
    </section>
    <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/RegistroCalificaciones.php');
            require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/RegistroCalificacionesDAO.php');

            $registroCalificacionesDAO = new RegistroCalificacionesDAO();

            $registroCalificaciones = new RegistroCalificaciones();
            $registroCalificaciones->construirObjeto($docente->getMiembroId(),$_REQUEST["estudiante"],$_REQUEST["curso"],$_POST["salonClases"],intval($_POST["calif1"]),
            intval($_POST["calif2"]),intval($_POST["calif3"]),$_POST["fechaDeEmision"]);

            $banderaErrores = false;
            $arrayMensajes = $registroCalificaciones->validarCampos();
    
            if(count($arrayMensajes)>0){
                $banderaErrores = true;
            }
            else{
                try{
                    $registroCalificacionesDAO->insertar($registroCalificaciones);
                    $banderaErrores = false;
                }
                catch(Exception $e){
                    $arrayMensajes[]=$e->getMessage();
                    $banderaErrores = true;
                }
            }
    
            if(!$banderaErrores){
                echo "<p> Registro de calificaciones modificado satisfactoriamente </p>";
                header("Location: gestionar_calificaciones_docente.php?id=".$registroCalificaciones->getCursoId());
            }
            else{
                foreach($arrayMensajes as $mensaje){
                    echo "<p>".$mensaje."</p>";
                }
            }
        }
    ?>
</body>
</html>