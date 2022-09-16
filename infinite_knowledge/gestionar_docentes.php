<?php require_once('plantillas/head.php'); 
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/AuxiliarAcademicoDAO.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/DirectorAcademicoDAO.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/UsuarioDAO.php');

    if((empty($_SESSION['dni']) && empty($_SESSION['rol'])) || (($_SESSION['rol']!=2) && ($_SESSION["rol"]!=1))){
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
            <h3> Gestionar docentes: </h3>
            <table class="modeloTabla">
                <thead>
                    <tr>
                        <th>  Id </th>
                        <th>  DNI </th>
                        <th>  Nombre completo </th>
                        <th>  Fecha de Nacimiento </th>
                        <th>  Número telefónico </th>
                        <th>  Género </th>
                        <th>  Grado académico </th>
                        <th>  Especialidad académica </th>
                        <th>  Acciones </th>
                    </tr>
                </thead>
                <?php
                    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/DocenteDAO.php');
                    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/Docente.php');

                    $docenteDAO = new DocenteDAO();
                    $docentesListados = $docenteDAO->listar();

                    foreach($docentesListados as $docente){
                ?> 
                <tr>
                    <td> <?php echo $docente->getMiembroId(); ?> </td>
                    <td> <?php echo $docente->getDNI(); ?> </td>
                    <td> <?php echo $docente->getNombreCompleto(); ?> </td>
                    <td> <?php echo $docente->getFechaNacimiento(); ?> </td>
                    <td> <?php echo $docente->getNumeroTelefonico(); ?> </td>
                    <td> <?php echo $docente->getGenero(); ?> </td>
                    <td> <?php echo $docente->getGradoAcademico(); ?> </td>
                    <td> <?php echo $docente->getEspecialidadAcademica(); ?> </td>
                    <td> 
                        <a href="modificar_docente.php?idDocente=<?php echo $docente->getMiembroId(); ?>"> Modificar </a> <br>
                        <a href="eliminar_docente.php?idDocente=<?php echo $docente->getMiembroId(); ?>"> Eliminar </a> <br>
                    </td>
                </tr>
                <?php
                    }
                ?>
            </table>
            <br>
            <button> <a href="<?php
                if($_SESSION["rol"]==1){
                    echo "director_academico_principal";
                }
                else{
                    echo "auxiliar_academico_principal";
                }
            ?>.php"> Regresar </a> </button>
        </div>
    </section>
</body>
</html>