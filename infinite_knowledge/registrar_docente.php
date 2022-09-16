<?php require_once('plantillas/head.php'); ?>

<body>
    <section>
        <div class="container">
            <img src="img/logo.png" alt="">
            <h4>Seleccionar su rol para registrarse:</h4>
            <br><br>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="registrarDocente" method="post">
                <label for="">DNI:</label>
                <input name="dniDocente" type="text" required="">
                <br><br>
                <label for="">Nombre:</label>
                <input name="nombreDocente" type="text">
                <br><br>
                <label for="">Apellido Paterno:</label>
                <input name="apellidoPaternoDocente" type="text">
                <br><br>
                <label for="">Apellido Materno:</label>
                <input name="apellidoMaternoDocente" type="text">
                <br><br>
                <label for="">Fecha de Nacimiento:</label>
                <input name="fechaNacimientoDocente" type="date">
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
                <label for="">Grado Académico:</label>
                <select name="gradoAcademico" id="">
                    <option value="Licenciado">Licenciado</option>
                    <option value="Magister">Magister</option>
                    <option value="Doctor">Doctor</option>
                </select>
                <br><br>
                <label for="">Especialidad Académica:</label>
                <select name="especialidadAcademica" id="">
                    <option value="Ciencias">Ciencias</option>
                    <option value="Humanidades">Humanidades</option>
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
            require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/Docente.php');
            require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/DocenteDAO.php');

            require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/Usuario.php');
            require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/UsuarioDAO.php');

            $docente = new Docente();
            $docente->construirObjeto(0,$_POST["dniDocente"],$_POST["nombreDocente"],$_POST["apellidoPaternoDocente"],$_POST["apellidoMaternoDocente"],
            $_POST["fechaNacimientoDocente"],$_REQUEST["genero"],$_POST["numeroTelefonico"],$_REQUEST["gradoAcademico"],$_REQUEST["especialidadAcademica"]);
            
            $usuarioDocente = new Usuario();
            $usuarioDocente->construirObjeto(0,$_POST["dniDocente"],$_POST["correoElectronico"],$_POST["contrasenia"],$_POST["contraseniaRepetida"],3);

            $banderaErrores = false;
            $arrayMensajes = array_merge($docente->validarCampos(),$usuarioDocente->validarCampos());

            if(count($arrayMensajes)>0){
                $banderaErrores = true;
            }
            else{
                try{
                    $usuarioDAO = new UsuarioDAO();
                    $docenteDAO = new DocenteDAO();

                    $docenteDAO->insertar($docente);
                    $usuarioDAO->insertar($usuarioDocente);

                    $banderaErrores = false;
                }
                catch(Exception $e){
                    $arrayMensajes[]=$e->getMessage();
                    $banderaErrores = true;
                }
            }

            if(!$banderaErrores){
                echo "<p> Docente registrado satisfactoriamente </p>";
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