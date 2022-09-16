<?php require_once('plantillas/head.php'); 
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/DocenteDAO.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/DirectorAcademicoDAO.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/UsuarioDAO.php');

    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/Estudiante.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/EstudianteDAO.php');

    $estudianteDAO = new EstudianteDAO();
    
    if((empty($_SESSION['dni']) && empty($_SESSION['rol'])) || (($_SESSION['rol']!=3) && ($_SESSION["rol"]!=1))){
        header("Location:index.php");
        exit;
    }
?>

<body>
    <section>
        <div class="container">
            <img src="img/logo.png" alt="">
            <h3> <?php 
                if($_SESSION["rol"]==1){ 
                    echo "Director Académico"; 
                } 
                else { 
                    echo "Docente"; 
                }
                ?> 
            </h3>
            <?php $usuarioDAO = new UsuarioDAO(); 
                if($_SESSION["rol"]==1){ 
                    $directorAcademicoDAO = new DirectorAcademicoDAO(); 
                }
                else{
                    $docenteDAO = new DocenteDAO(); 
                } 
                ?>
            <br>
            <h3> <?php                 
                if($_SESSION["rol"]==1){ 
                    echo $directorAcademicoDAO->buscarNombreCompleto();
                }
                else{
                    echo $docenteDAO->buscarNombreCompletoPorDNI($_SESSION['dni']); 
                } 
                ?> 
            </h3>
            <h3> <?php echo $usuarioDAO->buscarCorreoPorDNI($_SESSION['dni']); ?> </h3>
            <br><br>
            <h4>Modificar estudiante:</h4>
            <br><br>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="modificarEstudianteDocente" method="post">
            <?php
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                $estudiante = new Estudiante();
                $estudiante->construirObjeto($_POST["idEstudiante"],$_POST["dniEstudiante"],$_POST["nombreEstudiante"],$_POST["apellidoPaternoEstudiante"],$_POST["apellidoMaternoEstudiante"],
                $_POST["fechaNacimientoEstudiante"],$_POST["genero"],$_POST["numeroTelefonico"]);
                
                $banderaErrores = false;
                $arrayMensajes = $estudiante->validarCampos();

                if(count($arrayMensajes)>0){
                    $banderaErrores = true;
                }
                else{
                    try{
                        $estudianteDAO->actualizar($estudiante);
                        $banderaErrores = false;
                    }
                    catch(Exception $e){
                        $arrayMensajes[]=$e->getMessage();
                        $banderaErrores = true;
                    }
                }

                if(!$banderaErrores){
                    echo "<p> Estudiante modificado satisfactoriamente </p>";
                    header("Location: gestionar_estudiantes.php");
                }
                else{
                    foreach($arrayMensajes as $mensaje){
                        echo "<p>".$mensaje."</p>";
                    }
                }
            }
            else{
                $estudianteAsignado = $estudianteDAO->buscarPorId($_GET['id']);
            }
            ?> 
                <input name="idEstudiante" type="hidden" required value="<?php echo $estudianteAsignado->getMiembroId(); ?>">
                <label for="">DNI:</label>
                <input name="dniEstudiante" type="text" required value="<?php echo $estudianteAsignado->getDni(); ?>">
                <br><br>
                <label for="">Nombre:</label>
                <input name="nombreEstudiante" type="text" value="<?php echo $estudianteAsignado->getNombre(); ?>">
                <br><br>
                <label for="">Apellido Paterno:</label>
                <input name="apellidoPaternoEstudiante" type="text" value="<?php echo $estudianteAsignado->getApellidoPaterno(); ?>">
                <br><br>
                <label for="">Apellido Materno:</label>
                <input name="apellidoMaternoEstudiante" type="text" value="<?php echo $estudianteAsignado->getApellidoMaterno(); ?>">
                <br><br>
                <label for="">Fecha de Nacimiento:</label>
                <input name="fechaNacimientoEstudiante" type="date" value="<?php echo $estudianteAsignado->getFechaNacimiento(); ?>">
                <br><br>
                <label for="">Número Telefónico:</label>
                <input name="numeroTelefonico" type="text" value="<?php echo $estudianteAsignado->getNumeroTelefonico(); ?>">
                <br><br>
                <input name="genero" type="hidden" required value="<?php echo $estudianteAsignado->getGenero(); ?>">
                <button type="submit"> Enviar </button>
                <a href="gestionar_estudiantes.php"> Regresar </a>
            </form>
        </div>

    </section>
</body>