<?php require_once('plantillas/head.php'); 
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/DocenteDAO.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/DirectorAcademicoDAO.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/UsuarioDAO.php');
    
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
            <h2>Registro de estudiantes</h2>
            <br><br>
            <table class="modeloTabla">
                <thead>
                    <tr>
                        <th> Id </th>
                        <th> DNI </th>
                        <th> Nombre completo </th>
                        <th> Fecha de Nacimiento </th>
                        <th> Número telefónico </th>
                        <th> Género </th>
                        <th> Acciones </th>
                    </tr>
                </thead>
                <?php
                
                    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/Estudiante.php');
                    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/EstudianteDAO.php');
                    $estudianteDAO = new EstudianteDAO();

                    if($_SESSION["rol"]==1){
                        $estudiantes = $estudianteDAO->listar();
                    }
                    else{
                        $estudiantes = $estudianteDAO->listarParaDocente($_SESSION['dni']);
                    }

                    foreach($estudiantes as $estudiante){
                ?>
                <tr>
                    <td> <?php echo $estudiante->getMiembroId(); ?> </td>
                    <td> <?php echo $estudiante->getDni(); ?> </td>
                    <td> <?php echo $estudiante->getNombreCompleto(); ?> </td>
                    <td> <?php echo $estudiante->getFechaNacimiento(); ?> </td>
                    <td> <?php echo $estudiante->getNumeroTelefonico(); ?> </td>
                    <td> <?php echo $estudiante->getGenero(); ?> </td>
                    <td> <a href="<?php echo "modificar_estudiante.php?id=".$estudiante->getMiembroId(); ?>"> Modificar 
                    <br> 
                    <a href="<?php echo "eliminar_estudiante.php?id=".$estudiante->getMiembroId(); ?>"> Eliminar </td>
                </tr>
                <?php } ?>
            </table>
            <br>
            <br><br>
            <button> <a href="<?php
                if($_SESSION["rol"]==1){
                    echo "director_academico_principal";
                }
                else{
                    echo "docente_principal";
                }
            ?>.php"> Regresar </a> </button>
        </div>
    </section>
</body>
</html>