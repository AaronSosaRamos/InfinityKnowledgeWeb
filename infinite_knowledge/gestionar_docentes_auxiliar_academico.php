<?php require_once('plantillas/head.php'); 
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/AuxiliarAcademicoDAO.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/UsuarioDAO.php');

    if((empty($_SESSION['dni']) && empty($_SESSION['rol'])) || ($_SESSION['rol']!=2)){
        header("Location:index.php");
        exit;
    }
?>
<body>
    <section>
        <div class="container">
            <img src="img/logo.png" alt="">
            <h3> Auxiliar Académico: </h3>
            <?php $auxiiarAcadémicoDAO = new AuxiliarAcademicoDAO(); $usuarioDAO = new UsuarioDAO(); ?>
            <br>
            <h3> <?php echo $auxiiarAcadémicoDAO->buscarNombreCompleto(); ?> </h3>
            <h3> <?php echo $usuarioDAO->buscarCorreoPorDNI($_SESSION['dni']); ?> </h3>
            <br><br>
            <h3> Gestionar docentes: </h3>
            <table class="modeloTabla">
                <thead>
                    <tr>
                        <th>  Id </th>
                        <th>  DNI </th>
                        <th>  Apellidos y Nombres </th>
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
                        <a href="modificar_docente_auxiliar_academico.php?idDocente=<?php echo $docente->getMiembroId(); ?>"> Modificar </a> <br>
                        <a href="eliminar_docente_auxiliar_academico.php?idDocente=<?php echo $docente->getMiembroId(); ?>"> Eliminar </a> <br>
                    </td>
                </tr>
                <?php
                    }
                ?>
            </table>
            <br>
            <button> <a href="auxiliar_academico_principal.php"> Regresar </a> </button>
        </div>
    </section>
</body>
</html>