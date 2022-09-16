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
            <h3> Gestionar auxiliar académico: </h3>
            <table class="modeloTabla">
                <thead>
                    <tr>
                        <th>  Id  </th>
                        <th>  DNI  </th>
                        <th>  Nombre completo  </th>
                        <th>  Fecha de Nacimiento  </th>
                        <th>  Número telefónico  </th>
                        <th>  Género  </th>
                        <th>  Grado académico  </th>
                        <th>  N. de docentes a cargo  </th>
                        <th>  Acciones  </th>
                    </tr>
                </thead>
                <?php
                    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/AuxiliarAcademicoDAO.php');
                    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/AuxiliarAcademico.php');

                    $auxiliarAcademicoDAO = new AuxiliarAcademicoDAO();
                    $auxiliarAcademico = $auxiliarAcademicoDAO->buscarPorId();

                    if(!empty($auxiliarAcademico->getMiembroId())){
                ?> 
                <tr>
                    <td> <?php echo $auxiliarAcademico->getMiembroId(); ?> </td>
                    <td> <?php echo $auxiliarAcademico->getDNI(); ?> </td>
                    <td> <?php echo $auxiliarAcademico->getNombreCompleto(); ?> </td>
                    <td> <?php echo $auxiliarAcademico->getFechaNacimiento(); ?> </td>
                    <td> <?php echo $auxiliarAcademico->getNumeroTelefonico(); ?> </td>
                    <td> <?php echo $auxiliarAcademico->getGenero(); ?> </td>
                    <td> <?php echo $auxiliarAcademico->getGradoAcademico(); ?> </td>
                    <td> <?php echo $auxiliarAcademico->getNDocentesACargo(); ?> </td>
                    <td> 
                        <a href="modificar_auxiliar_academico.php"> Modificar </a> <br>
                        <a href="eliminar_auxiliar_academico.php"> Eliminar </a> <br>
                    </td>
                </tr>
                <?php }?>
            </table>
            <br>
            <button> <a href="director_academico_principal.php"> Regresar </a> </button>
        </div>
    </section>
</body>
</html>