<?php require_once('plantillas/head.php'); 
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/DocenteDAO.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/UsuarioDAO.php');
    
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
            <br><br>
            <table class="modeloTabla">
            <h2>Gestión de asistencias:</h2>
            <br><br>
            <table class="modeloTabla">
                <thead>
                    <tr>
                        <th> Estudiante </th>
                        <th> Docente </th>
                        <th> Curso </th>
                        <th> Salón </th>
                        <th> N. de Asistencias </th>
                        <th> N. de Faltas </th>
                        <th> N. de Justificaciones </th>
                        <th> Total </th>
                        <th> Fecha de emisión </th>
                        <th> Acciones </th>
                    </tr>
                </thead>
                <?php
                
                    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/RegistroAsistencias.php');
                    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/RegistroAsistenciasDAO.php');
                    $registroAsistenciasDAO = new RegistroAsistenciasDAO();

                    $registros = $registroAsistenciasDAO->buscarParaDocente($_SESSION['dni'],$_GET['id']);

                    foreach($registros as $registro){
                ?>
                <tr>
                    <td> <?php echo $registro[0]->getNombreCompleto() ?> </td>
                    <td> <?php echo $registro[1]->getNombreCompleto() ?> </td>
                    <td> <?php echo $registro[2]->getNombre() ?> </td>
                    <td> <?php echo $registro[3]->getSalonClases() ?> </td>
                    <td> <?php echo $registro[3]->getNAsistenciasRealizadas() ?> </td>
                    <td> <?php echo $registro[3]->getNFaltasRealizadas() ?> </td>
                    <td> <?php echo $registro[3]->getNJustificacionesRealizadas() ?> </td>
                    <td> <?php echo $registro[3]->getNTotalAsistencias() ?> </td>
                    <td> <?php echo $registro[3]->getFechaEmision() ?> </td>
                    <td> <a href="<?php echo "modificar_registro_asistencia.php?idDocente=".$registro[3]->getDocenteId()."&idEstudiante=".$registro[3]->getEstudianteId()."&idCurso=".$registro[3]->getCursoId(); ?>"> Modificar </a>
                    <br> 
                    <a href="<?php echo "eliminar_registro_asistencia.php?idDocente=".$registro[3]->getDocenteId()."&idEstudiante=".$registro[3]->getEstudianteId()."&idCurso=".$registro[3]->getCursoId(); ?>"> Eliminar </td>
                </tr>
                <?php } ?>
            </table>
            <br>
            <button> <a href="insertar_registro_asistencia.php"> Insertar </a> </button>
            <button>Generar Reporte</button>
            <br><br>
            <button> <a href="seleccion_curso_asistencias_docentes.php "> Regresar </a> </button>
        </div>
    </section>
</body>
</html>