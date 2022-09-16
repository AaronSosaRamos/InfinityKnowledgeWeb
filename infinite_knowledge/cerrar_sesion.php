<?php require_once('plantillas/head.php');

    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/DirectorAcademicoDAO.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/AuxiliarAcademicoDAO.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/DocenteDAO.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/EstudianteDAO.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/UsuarioDAO.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/Usuario.php');

    if(empty($_SESSION['dni'])){
        header("Location:index.php");
        exit;
    }

?>

    <body>
        <section id="iniciar-sesion">
            <div class="container">
                <img class="imagen" src="img/logo.png" alt="">
                <br>
                <h3> 
                <?php $usuarioDAO = new UsuarioDAO();
                switch($usuarioDAO->buscarRolPorDNI($_SESSION['dni'])){
                    case 1:
                        $miembroDAO = new DirectorAcademicoDAO();
                        echo "Director Académico: <br>";
                        echo $miembroDAO->buscarNombreCompleto();
                        break;
                    case 2:
                        $miembroDAO = new AuxiliarAcademicoDAO();
                        echo "Auxiliar Académico: <br>";
                        echo $miembroDAO->buscarNombreCompleto();
                        break;
                    case 3:
                        $miembroDAO = new DocenteDAO();
                        echo "Docente: <br>";
                        echo $miembroDAO->buscarNombreCompletoPorDNI($_SESSION['dni']);
                        break;
                    case 4:
                        $miembroDAO = new EstudianteDAO();
                        echo "Estudiante: <br>";
                        echo $miembroDAO->buscarNombreCompletoPorDNI($_SESSION['dni']);
                        break;
                }
                ?> 
                </h3>
                <h3> <?php echo $usuarioDAO->buscarCorreoPorDNI($_SESSION['dni']); ?> </h3>
                <h1> Cerrar sesión: </h1>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <button type="submit">  Cerrar sesión </button>
                </form>
                <button> <a href="<?php switch($usuarioDAO->buscarRolPorDNI($_SESSION['dni'])){
                        case 1:
                            echo "director_academico_principal";
                            break;
                        case 2:
                            echo "auxiliar_academico_principal";
                            break;
                        case 3:
                            echo "docente_principal";
                            break;
                        case 4:
                            echo "estudiante_principal";
                            break;
                    }?>.php "> Regresar </a> </button>
            </div>
        </section>
        <?php
            if($_SERVER['REQUEST_METHOD']=='POST'){
                session_start();
                session_destroy();
                header("Location:index.php");
            }
        ?>
    </body>
</html>