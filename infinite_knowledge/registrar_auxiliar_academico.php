<?php require_once('plantillas/head.php'); ?>

<body>
    <section>
        <div class="container">
            <img src="img/logo.png" alt="">
            <h4>Seleccionar su rol para registrarse:</h4>
            <br><br>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="registrarAuxiliarAcademico" method="post">
                <label for="">DNI:</label>
                <input name="dniAuxiliar" type="text" required="">
                <br><br>
                <label for="">Nombre:</label>
                <input name="nombreAuxiliar" type="text">
                <br><br>
                <label for="">Apellido Paterno:</label>
                <input name="apellidoPaternoAuxiliar" type="text">
                <br><br>
                <label for="">Apellido Materno:</label>
                <input name="apellidoMaternoAuxiliar" type="text">
                <br><br>
                <label for="">Fecha de Nacimiento:</label>
                <input name="fechaNacimientoAuxiliar" type="date">
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
                <label for="">Correo Electrónico:</label>
                <input name="correoElectronico" type="email">
                <br><br>
                <label for="">Contraseña:</label>
                <input name="contrasenia" type="password" required="">
                <br><br>
                <label for="">Repetir Contraseña:</label>
                <input name="contraseniaRepetida" type="password" required="">
                <input name="nDocentesACargo" type="hidden" value="<?php 
                    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/UsuarioDAO.php');
                    $usuarioDAO = new UsuarioDAO();
                    echo $usuarioDAO->contarUsuarioPorRol(3);
                ?>">
                <br><br>
                <button type="submit"> Enviar </button>
            </form>
            <a href="index.php"> Regresar </a>
        </div>
    </section>
    <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/AuxiliarAcademico.php');
            require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DAO/AuxiliarAcademicoDAO.php');

            require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/Usuario.php');

            $auxiliarAcademico = new AuxiliarAcademico();
            $auxiliarAcademico->construirObjeto(0,$_POST["dniAuxiliar"],$_POST["nombreAuxiliar"],$_POST["apellidoPaternoAuxiliar"],$_POST["apellidoMaternoAuxiliar"],
            $_POST["fechaNacimientoAuxiliar"],$_REQUEST["genero"],$_POST["numeroTelefonico"],intval($_POST["nDocentesACargo"]),$_REQUEST["gradoAcademico"]);
            
            $usuarioAuxiliarAcademico = new Usuario();
            $usuarioAuxiliarAcademico->construirObjeto(0,$_POST["dniAuxiliar"],$_POST["correoElectronico"],$_POST["contrasenia"],$_POST["contraseniaRepetida"],2);

            $banderaErrores = false;
            $arrayMensajes = array_merge($auxiliarAcademico->validarCampos(),$usuarioAuxiliarAcademico->validarCampos());

            if(count($arrayMensajes)>0){
                $banderaErrores = true;
            }
            else{
                try{
                    $usuarioDAO = new UsuarioDAO();

                    if($usuarioDAO->contarUsuarioPorRol(2)>0){
                        $arrayMensajes[]="Ya existe un usuario de Auxiliar Académico registrado";
                        $banderaErrores = true;
                    }
                    else{
                        $auxiliarAcademicoDAO = new AuxiliarAcademicoDAO();
                        $auxiliarAcademicoDAO->insertar($auxiliarAcademico);
                        $usuarioDAO->insertar($usuarioAuxiliarAcademico);
                        $banderaErrores = false;
                    }
                    
                }
                catch(Exception $e){
                    $arrayMensajes[]=$e->getMessage();
                    $banderaErrores = true;
                }
            }

            if(!$banderaErrores){
                echo "<p> Auxiliar académico registrado satisfactoriamente </p>";
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