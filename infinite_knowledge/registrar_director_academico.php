<?php require_once('plantillas/head.php'); ?>

<body>
    <section>
        <div class="container">
            <img src="img/logo.png" alt="">
            <h4>Seleccionar su rol para registrarse:</h4>
            <br><br>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="registrarDirectorAcademico" method="post">
                <label for="">DNI:</label>
                <input name="dniDirector" type="text" required="">
                <br><br>
                <label for="">Nombre:</label>
                <input name="nombreDirector" type="text">
                <br><br>
                <label for="">Apellido Paterno:</label>
                <input name="apellidoPaternoDirector" type="text">
                <br><br>
                <label for="">Apellido Materno:</label>
                <input name="apellidoMaternoDirector" type="text">
                <br><br>
                <label for="">Fecha de Nacimiento:</label>
                <input name="fechaNacimientoDirector" type="date">
                <br><br>
                <label for="">Número Telefónico:</label>
                <input name="numeroTelefonico" type="text">
                <br><br>
                <label for="">Género:</label>
                <select name="genero" id="">
                    <option value="Hombre">Hombre</option>
                    <option value="Mujer">Mujer</option>
                </select>
                <br><br>
                <label for="">Años de labor:</label>
                <input name="aniosLabor" type="text">
                <br><br>
                <label for="">Grado Académico:</label>
                <select name="gradoAcademico" id="">
                    <option value="Licenciado">Licenciado</option>
                    <option value="Magister">Magister</option>
                    <option value="Doctor">Doctor</option>
                </select>
                <br><br>
                <label for="">Correo Electrónico:</label>
                <input name="correoElectronico" type="email">
                <br><br>
                <label for="">Contraseña:</label>
                <input name="contrasenia" type="password" required="">
                <br><br>
                <label for="">Repetir Contraseña:</label>
                <input name="contraseniaRepetida" type="password" required="">
                <br><br>
                <button type="submit"> Enviar </button>
                <a href="index.php"> Regresar </a>
            </form>
        </div>
    </section>
    <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/DirectorAcademico.php');
            require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/DirectorAcademicoDAO.php');

            require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/Usuario.php');
            require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/UsuarioDAO.php');

            $directorAcademico = new DirectorAcademico();
            $directorAcademico->construirObjeto(0,$_POST["dniDirector"],$_POST["nombreDirector"],$_POST["apellidoPaternoDirector"],$_POST["apellidoMaternoDirector"],
            $_POST["fechaNacimientoDirector"],$_REQUEST["genero"],$_POST["numeroTelefonico"],intval($_POST["aniosLabor"]),$_REQUEST["gradoAcademico"]);
            
            $usuarioDirectorAcademico = new Usuario();
            $usuarioDirectorAcademico->construirObjeto(0,$_POST["dniDirector"],$_POST["correoElectronico"],$_POST["contrasenia"],$_POST["contraseniaRepetida"],1);

            $banderaErrores = false;
            $arrayMensajes = array_merge($directorAcademico->validarCampos(),$usuarioDirectorAcademico->validarCampos());

            if(count($arrayMensajes)>0){
                $banderaErrores = true;
            }
            else{
                try{
                    $usuarioDAO = new UsuarioDAO();

                    if($usuarioDAO->contarUsuarioPorRol(1)>0){
                        $arrayMensajes[]="Ya existe un usuario de Director Académico registrado";
                        $banderaErrores = true;
                    }
                    else{
                        $directorAcademicoDAO = new DirectorAcademicoDAO();
                        $directorAcademicoDAO->insertar($directorAcademico);
                        $usuarioDAO->insertar($usuarioDirectorAcademico);
                        $banderaErrores = false;
                    }
                    
                }
                catch(Exception $e){
                    $arrayMensajes[]=$e->getMessage();
                    $banderaErrores = true;
                }
            }

            if(!$banderaErrores){
                echo "<p> Director académico registrado satisfactoriamente </p>";
            }
            else{
                foreach($arrayMensajes as $mensaje){
                    echo "<p>".$mensaje."</p>";
                }
            }
        }
    ?>
</body>
</html>