<?php require_once('plantillas/head.php'); 
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/DirectorAcademicoDAO.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/UsuarioDAO.php');

    if((empty($_SESSION['dni']) && empty($_SESSION['rol'])) || ($_SESSION['rol']!=1)){
        header("Location:index.php");
        exit;
    }
?>

<body>
    <section>
        <div class="container">
            <img src="img/logo.png" alt="">
            <h3> Director Académico: </h3>
            <?php $directorAcademicoDAO = new DirectorAcademicoDAO(); $usuarioDAO = new UsuarioDAO(); ?>
            <br>
            <h3> <?php echo $directorAcademicoDAO->buscarNombreCompleto(); ?> </h3>
            <h3> <?php echo $usuarioDAO->buscarCorreoPorDNI($_SESSION['dni']); ?> </h3>
            <br><br>
            <?php
                require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/AuxiliarAcademicoDAO.php');
                require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/AuxiliarAcademico.php');
                $auxiliarAcademicoDAO = new AuxiliarAcademicoDAO();

                if($_SERVER["REQUEST_METHOD"]=="POST"){
                    $auxiliarAcademicoDAO->eliminar();
                    header("Location:gestionar_auxiliar_academico.php");
                }
                else{
                    $auxiliarAcademico = $auxiliarAcademicoDAO->buscarPorId();                    
                }

            ?>
            <h3> Eliminar auxiliar académico: </h3>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="" method="post">
                <label for="">DNI:</label>
                <input name="dniAuxiliarAcademico" type="text" value = "<?php echo $auxiliarAcademico->getDni(); ?>" >
                <br><br>
                <label for="">Nombre:</label>
                <input name="nombreAuxiliarAcademico" type="text" value = "<?php echo $auxiliarAcademico->getNombre(); ?>">
                <br><br>
                <label for="">Apellido Paterno:</label>
                <input name="apellidoPaternoAuxiliarAcademico" type="text" value = "<?php echo $auxiliarAcademico->getApellidoPaterno(); ?>">
                <br><br>
                <label for="">Apellido Materno:</label>
                <input name="apellidoMaternoAuxiliarAcademico" type="text" value = "<?php echo $auxiliarAcademico->getApellidoMaterno(); ?>">
                <br><br>
                <label for="">Fecha de Nacimiento:</label>
                <input name="fechaNacimientoAuxiliarAcademico" type="date" value = "<?php echo $auxiliarAcademico->getFechaNacimiento(); ?>">
                <br><br>
                <label for="">Número Telefónico:</label>
                <input name="numeroTelefonico" type="text" value = "<?php echo $auxiliarAcademico->getNumeroTelefonico(); ?>">
                <br><br>
                <label for="">Grado Académico:</label>
                <select name="gradoAcademico" id="">
                    <option value="Licenciado" <?php if($auxiliarAcademico->getGradoAcademico()=='Licenciado'){ ?> selected <?php } ?> >Licenciado</option>
                    <option value="Magister" <?php if($auxiliarAcademico->getGradoAcademico()=='Magister'){ ?> selected <?php } ?>>Magister</option>
                    <option value="Doctor" <?php if($auxiliarAcademico->getGradoAcademico()=='Doctor'){ ?> selected <?php } ?>>Doctor</option>
                </select>
                <br><br>
                <input name="idAuxiliarAcademico" type="hidden" value = "<?php echo $auxiliarAcademico->getMiembroId(); ?>">
                <input name="genero" type="hidden" value = "<?php echo $auxiliarAcademico->getGenero(); ?>">
                <input name="nDocentesACargo" type="hidden" value = "<?php echo $auxiliarAcademico->getNDocentesACargo(); ?>">
                <button type="submit"> Enviar </button>
                <a href="gestionar_auxiliar_academico.php"> Regresar </a>
            </form>
        </div>
    </section>
</body>
</html>