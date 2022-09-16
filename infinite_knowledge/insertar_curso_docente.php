<?php require_once('plantillas/head.php'); 
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/DocenteDAO.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/UsuarioDAO.php');

    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/Docente.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/DocenteDAO.php');

    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/Curso.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/CursoDAO.php');

    $docenteDAO = new DocenteDAO(); $docente = $docenteDAO->buscarPorDNI($_SESSION["dni"]);
    $cursoDAO = new CursoDAO(); $cursosListados = $cursoDAO->listar();
    
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
            <h4> Insertar curso para docente: </h4>
            <br>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="  " method="post">
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
                <button type="submit"> Enviar </button>
                <a href="subir_material_de_clase_docente.php">  Regresar </a>
            </form>
        </div>
    </section>
    <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $cursoDAO->insertarParaDocente($docente->getMiembroId(),$_REQUEST["curso"]);
            header("Location: subir_material_de_clase_docente.php");
        }
    ?>
</body>
</html>