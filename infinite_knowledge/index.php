<?php require_once('plantillas/head.php'); 

    if(!empty($_SESSION['dni']) && !empty($_SESSION['rol'])){
        
        switch($_SESSION['rol']){
            case 1:
                header("Location:director_academico_principal.php");
                break;
            case 2:
                header("Location:auxiliar_academico_principal.php");
                break;
            case 3:
                header("Location:docente_principal.php");
                break;
            case 4:
                header("Location:estudiante_principal.php");
                break;
        }
        
        exit;
    }

?>

    <body>
        <section id="iniciar-sesion">
            <div class="container">
                <img class="imagen" src="img/logo.png" alt="">
                <br>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" name="inicioSesion" method="post">
                    <h2>Colegio de Alto Rendimiento</h2>
                    <br><br>
                    <label for="">Correo Electrónico</label>
                    <br><br>
                    <input name="correoElectronico" type="email" required="">
                    <br><br>
                    <label for="">Contraseña</label>
                    <br><br>
                    <input name="contrasenia" type="password" required="">
                    <br><br>
                    <button type="submit"> Iniciar Sesion  </button>
                    <a href="seleccionar_rol_de_registro.php"> Registrar </a>
                    <br><br>
                    <a href="">¿Olvidó la contraseña?</a>
                </form>
            </div>
        </section>
        <?php
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/Usuario.php');
                require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/UsuarioDAO.php');
                require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/Validator/TestInput.php');
                $usuarioDAO = new UsuarioDAO();
                $respuestaInicioSesion = $usuarioDAO->realizarInicioSesion(TestInput::test_input($_POST["correoElectronico"]),TestInput::test_input($_POST["contrasenia"]));
                if($respuestaInicioSesion){
                    $_SESSION["dni"]=$respuestaInicioSesion->getDni();
                    $_SESSION["rol"]=$respuestaInicioSesion->getRol();
                    switch($respuestaInicioSesion->getRol()){
                        case 1:
                            header("Location:director_academico_principal.php");
                            break;
                        case 2:
                            header("Location:auxiliar_academico_principal.php");
                            break;
                        case 3:
                            header("Location:docente_principal.php");
                            break;
                        case 4:
                            header("Location:estudiante_principal.php");
                            break;
                    }
                }
            }
        ?>
    </body>
</html>