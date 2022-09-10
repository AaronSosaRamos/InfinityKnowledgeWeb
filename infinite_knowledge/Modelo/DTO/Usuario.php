<?php

    require_once('../ValidacionDeDatos/TestInput.php');
    require_once('../ValidacionDeDatos/ValidatorUsuario.php');

    class Usuario{
        //------------------Atributos exclusivos de Usuario-----------------------
        private $usuarioId;
        private $dni;
        private $correoElectronico;
        private $contrasenia;
        private $rol;
        //-----------------------------------------------------

        //------------------Constructor vacío-----------------------
        public function __construct(){

        }
        //-----------------------------------------------------

        //------------------Construir Objeto-----------------------
        public function construirObjeto($usuarioId,$correoElectronico,$contrasenia,$rol){
            $this->usuarioId = $usuarioId;
            $this->correoElectronico = $correoElectronico;
            $this->contrasenia = $contrasenia;
            $this->rol = $rol;        
        }
        //-----------------------------------------------------

        //------------------Validar campos en común entre los miembros-----------------------
        public function validarCampos(){

            $arrayMensajes = array();

            //------------------Validar campo del Correo Electrónico-----------------------
            if(!empty($this->getCorreoElectronico())){
                $this->setCorreoElectronico(TestInput::test_input($this->getCorreoElectronico()));
                if(!ValidatorUsuario::isEmail($this->getCorreoElectronico())){
                    $arrayMensajes[] = "El correo electrónico del Usuario ingresado posee un formato no adecuado";        
                }
                if(strlen($this->getCorreoElectronico())>100){
                    $arrayMensajes[] = "El correo electrónico del Usuario ingresado excede del límite de caracteres establecido (100 caracteres)";        
                }
            }
            else{
                $arrayMensajes[] = "El correo electrónico del Usuario no ha sido ingresado"; 
            }
            //-----------------------------------------------------

            //------------------Validar campo de la Contraseña-----------------------
            if(!empty($this->getContrasenia())){
                $this->setContrasenia(TestInput::test_input($this->getContrasenia()));
                if(!ValidatorUsuario::isPassword($this->getContrasenia())){
                    $arrayMensajes[] = "La contraseña del Usuario ingresado posee un formato no adecuado";        
                }
            }
            else{
                $arrayMensajes[] = "La contraseña del Usuario no ha sido ingresado"; 
            }
            //-----------------------------------------------------

            //------------------Validar campo del Rol-----------------------
            if(!empty($this->getRol())){
                $this->setRol(TestInput::test_input($this->getRol()));
                if(!ValidatorUsuario::isRol($this->getRol())){
                    $arrayMensajes[] = "El rol del Usuario ingresado posee un formato no adecuado";        
                }
            }
            else{
                $arrayMensajes[] = "El rol del Usuario no ha sido ingresado"; 
            }
            //-----------------------------------------------------

            return $arrayMensajes;
        }
        
        //------------------Getter u Setter del Id de Usuario-----------------------
        public function getUsuarioId()
        {
                return $this->usuarioId;
        }
        //-----------------------------------------------------

        //-----------------------------------------------------
        public function setUsuarioId($usuarioId)
        {
                $this->usuarioId = $usuarioId;

                return $this;
        }
        //-----------------------------------------------------

        //------------------Getter u Setter del DNI del usuario-----------------------
        public function getDni()
        {
                return $this->dni;
        }
        //-----------------------------------------------------

        //-----------------------------------------------------
        public function setDni($dni)
        {
                $this->dni = $dni;

                return $this;
        }
        //-----------------------------------------------------

        //------------------Getter u Setter del Correo Electrónico-----------------------
        public function getCorreoElectronico()
        {
                return $this->correoElectronico;
        }
        //-----------------------------------------------------

        //-----------------------------------------------------
        public function setCorreoElectronico($correoElectronico)
        {
                $this->correoElectronico = $correoElectronico;

                return $this;
        }
        //-----------------------------------------------------

        //------------------Getter u Setter de la Contraseña----------------------
        public function getContrasenia()
        {
                return $this->contrasenia;
        }
        //-----------------------------------------------------

        //-----------------------------------------------------
        public function setContrasenia($contrasenia)
        {
                $this->contrasenia = $contrasenia;

                return $this;
        }
        //-----------------------------------------------------

        //------------------Getter u Setter del Rol----------------------
        public function getRol()
        {
                return $this->rol;
        }
        //-----------------------------------------------------

        //-----------------------------------------------------
        public function setRol($rol)
        {
                $this->rol = $rol;

                return $this;
        }
        //-----------------------------------------------------

    }

?>