<?php require_once('plantillas/head.php'); 
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/AuxiliarAcademicoDAO.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/DirectorAcademicoDAO.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/UsuarioDAO.php');

    if((empty($_SESSION['dni']) && empty($_SESSION['rol'])) ||  (($_SESSION['rol']!=2) && ($_SESSION["rol"]!=1))){
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
                    echo "Auxiliar Académico"; 
                }
                ?> 
            </h3>
            <?php $usuarioDAO = new UsuarioDAO(); 
                if($_SESSION["rol"]==1){ 
                    $directorAcademicoDAO = new DirectorAcademicoDAO(); 
                }
                else{
                    $auxiiarAcadémicoDAO = new AuxiliarAcademicoDAO(); 
                } 
                ?>
            <br>
            <h3> <?php                 
                if($_SESSION["rol"]==1){ 
                    echo $directorAcademicoDAO->buscarNombreCompleto();
                }
                else{
                    echo $auxiiarAcadémicoDAO->buscarNombreCompleto(); 
                } 
                ?> 
            </h3>
            <h3> <?php echo $usuarioDAO->buscarCorreoPorDNI($_SESSION['dni']); ?> </h3>
            <br><br>
            <h3> Eliminar docente: </h3>
            <?php
                require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/DocenteDAO.php');

                if($_SERVER["REQUEST_METHOD"]=="POST"){
                    $docenteDAO = new DocenteDAO();
                    $docenteDAO->eliminar($_POST["idDocente"]);
                    header("Location:gestionar_docentes.php");
                }
                else{
                    $docenteDAO = new DocenteDAO();
                    $docente = $docenteDAO->buscarPorId($_GET["idDocente"]);                    
                }

            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="" method="post">
                <label for="">DNI:</label>
                <input name="dniDocente" type="text" required="" value = "<?php echo $docente->getDni(); ?>" >
                <br><br>
                <label for="">Nombre:</label>
                <input name="nombreDocente" type="text" value = "<?php echo $docente->getNombre(); ?>">
                <br><br>
                <label for="">Apellido Paterno:</label>
                <input name="apellidoPaternoDocente" type="text" value = "<?php echo $docente->getApellidoPaterno(); ?>">
                <br><br>
                <label for="">Apellido Materno:</label>
                <input name="apellidoMaternoDocente" type="text" value = "<?php echo $docente->getApellidoMaterno(); ?>">
                <br><br>
                <label for="">Fecha de Nacimiento:</label>
                <input name="fechaNacimientoDocente" type="date" value = "<?php echo $docente->getFechaNacimiento(); ?>">
                <br><br>
                <label for="">Número Telefónico:</label>
                <input name="numeroTelefonico" type="text" value = "<?php echo $docente->getNumeroTelefonico(); ?>">
                <br><br>
                <label for="">Grado Académico:</label>
                <select name="gradoAcademico" id="">
                    <option value="Licenciado" <?php if($docente->getGradoAcademico()=='Licenciado'){ ?> selected <?php } ?> >Licenciado</option>
                    <option value="Magister" <?php if($docente->getGradoAcademico()=='Magister'){ ?> selected <?php } ?>>Magister</option>
                    <option value="Doctor" <?php if($docente->getGradoAcademico()=='Doctor'){ ?> selected <?php } ?>>Doctor</option>
                </select>
                <br><br>
                <label for="">Especialidad Académica:</label>
                <select name="especialidadAcademica" id="">
                    <option value="Ciencias" <?php if($docente->getEspecialidadAcademica()=='Ciencias'){ ?> selected <?php } ?> >Ciencias</option>
                    <option value="Humanidades" <?php if($docente->getEspecialidadAcademica()=='Humanidades'){ ?> selected <?php } ?>>Humanidades</option>
                </select>
                <br><br>
                <input name="idDocente" type="hidden" value = "<?php echo $docente->getMiembroId(); ?>">
                <input name="genero" type="hidden" value = "<?php echo $docente->getGenero(); ?>">
                <button type="submit"> Enviar </button>
                <a href="gestionar_docentes.php"> Regresar </a>
            </form>
        </div>
    </section>
</body>
</html>