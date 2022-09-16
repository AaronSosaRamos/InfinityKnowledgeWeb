<?php require_once('plantillas/head.php'); ?>

<body>
    <section>
        <div class="container">
            <img src="img/logo.png" alt="">
            <h4>Seleccionar su rol para registrarse:</h4>
            <br><br>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="registrarEstudiante" method="post">
                <label for="">DNI:</label>
                <input name="dniEstudiante" type="text" required="">
                <br><br>
                <label for="">Nombre:</label>
                <input name="nombreEstudiante" type="text">
                <br><br>
                <label for="">Apellido Paterno:</label>
                <input name="apellidoPaternoEstudiante" type="text">
                <br><br>
                <label for="">Apellido Materno:</label>
                <input name="apellidoMaternoEstudiante" type="text">
                <br><br>
                <label for="">Fecha de Nacimiento:</label>
                <input name="fechaNacimientoEstudiante" type="date">
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
            require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/Estudiante.php');
            require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/EstudianteDAO.php');

            require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/Usuario.php');
            require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/UsuarioDAO.php');

            $estudiante = new Estudiante();
            $estudiante->construirObjeto(0,$_POST["dniEstudiante"],$_POST["nombreEstudiante"],$_POST["apellidoPaternoEstudiante"],$_POST["apellidoMaternoEstudiante"],
            $_POST["fechaNacimientoEstudiante"],$_REQUEST["genero"],$_POST["numeroTelefonico"]);
            
            $usuarioEstudiante = new Usuario();
            $usuarioEstudiante->construirObjeto(0,$_POST["dniEstudiante"],$_POST["correoElectronico"],$_POST["contrasenia"],$_POST["contraseniaRepetida"],4);

            $banderaErrores = false;
            $arrayMensajes = array_merge($estudiante->validarCampos(),$usuarioEstudiante->validarCampos());

            if(count($arrayMensajes)>0){
                $banderaErrores = true;
            }
            else{
                try{
                    $usuarioDAO = new UsuarioDAO();
                    $estudianteDAO = new EstudianteDAO();

                    $estudianteDAO->insertar($estudiante);
                    $usuarioDAO->insertar($usuarioEstudiante);

                    $banderaErrores = false;
                }
                catch(Exception $e){
                    $arrayMensajes[]=$e->getMessage();
                    $banderaErrores = true;
                }
            }

            if(!$banderaErrores){
                echo "<p> Estudiante registrado satisfactoriamente </p>";
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