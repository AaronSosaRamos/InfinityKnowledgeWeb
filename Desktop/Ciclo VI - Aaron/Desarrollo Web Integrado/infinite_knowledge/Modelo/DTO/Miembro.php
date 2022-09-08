<?php

    require_once('../ValidacionDeDatos/TestInput.php');
    require_once('../ValidacionDeDatos/ValidatorMiembro.php');
    require_once('../ValidacionDeDatos/ValidatorAtributosGenerales.php');
    
    class Miembro{

        //------------------Atributos en común entre los miembros-----------------------
        private $miembroId;
        private $dni;
        private $nombre;
        private $apellidoPaterno;
        private $apellidoMaterno;
        private $fechaNacimiento;
        private $generoId;
        private $numeroTelefonico;

        private $nombreCompleto;
        private $tipoMiembro;
        //-----------------------------------------------------

        //------------------Constructor vacío-----------------------
        public function __construct(){

        }
        //-----------------------------------------------------

        //------------------Construir Objeto-----------------------
        public function construirObjetoMiembro($miembroId,$dni,$nombre,$apellidoPaterno,
        $apellidoMaterno,$fechaNacimiento,$generoId,$numeroTelefonico){
            $this->setMiembroId($miembroId);
            $this->setDni($dni);
            $this->setNombre($nombre);
            $this->setApellidoPaterno($apellidoPaterno);
            $this->setApellidoMaterno($apellidoMaterno);
            $this->setFechaNacimiento($fechaNacimiento);
            $this->setGeneroId($generoId);
            $this->setNumeroTelefonico($numeroTelefonico);
        }
        //-----------------------------------------------------

        //------------------Validar campos en común entre los miembros-----------------------
        public function validarCampos(){
            $arrayMensajes = array();

            //------------------Validar campo del DNI-----------------------
            if(!empty($this->getDni())){
                $this->setDni(TestInput::test_input($this->getDni()));
                if(!ValidatorMiembro::isValorNumericoFijo($this->getDni())){
                    $arrayMensajes[] = "El DNI del ".$this->getTipoMiembro()." ingresado posee un formato no adecuado";
                }
                if(strlen($this->getDni())!=8){
                    $arrayMensajes[] = "El DNI del ".$this->getTipoMiembro()." ingresado es diferente de 8 dígitos";
                }
            }
            else{
                $arrayMensajes[] = "El DNI del ".$this->getTipoMiembro()." no ha sido ingresado";
            }
            //-----------------------------------------------------

            //------------------Validar campo del Nombre-----------------------
            if(!empty($this->getNombre())){
                $this->setNombre(TestInput::test_input($this->getNombre()));
                if(!ValidatorMiembro::isNombreOApellido($this->getNombre())){
                    $arrayMensajes[] = "El nombre del ".$this->getTipoMiembro()." ingresado posee un formato no adecuado";
                }
                if(strlen($this->getNombre())>50){
                    $arrayMensajes[] = "El nombre del ".$this->getTipoMiembro()." ingresado excede del límite de caracteres establecido (50 caracteres)";
                }
            }
            else{
                $arrayMensajes[] = "El nombre del ".$this->getTipoMiembro()." no ha sido ingresado";
            }
            //-----------------------------------------------------

            //------------------Validar campo del Apellido Paterno-----------------------
            if(!empty($this->getApellidoPaterno())){
                $this->setApellidoPaterno(TestInput::test_input($this->getApellidoPaterno()));
                if(!ValidatorMiembro::isNombreOApellido($this->getApellidoPaterno())){
                    $arrayMensajes[] = "El apellido paterno del ".$this->getTipoMiembro()." ingresado posee un formato no adecuado";
                }
                if(strlen($this->getApellidoPaterno())>50){
                    $arrayMensajes[] = "El apellido paterno del ".$this->getTipoMiembro()." ingresado excede del límite de caracteres establecido (50 caracteres)";
                }
            }
            else{
                $arrayMensajes[] = "El apellido paterno del ".$this->getTipoMiembro()." no ha sido ingresado";
            }
            //-----------------------------------------------------

            //------------------Validar campo del Apellido Materno-----------------------
            if(!empty($this->getApellidoMaterno())){
                $this->setApellidoMaterno(TestInput::test_input($this->getApellidoMaterno()));
                if(!ValidatorMiembro::isNombreOApellido($this->getApellidoMaterno())){
                    $arrayMensajes[] = "El apellido materno del ".$this->getTipoMiembro()." ingresado posee un formato no adecuado";
                }
                if(strlen($this->getApellidoMaterno())>50){
                    $arrayMensajes[] = "El apellido materno del ".$this->getTipoMiembro()." ingresado excede del límite de caracteres establecido (50 caracteres)";
                }
            }
            else{
                $arrayMensajes[] = "El apellido materno del ".$this->getTipoMiembro()." no ha sido ingresado";
            }
            //-----------------------------------------------------

            //------------------Validar campo de la Fecha de Nacimiento-----------------------
            if(empty($this->getFechaNacimiento())){
                $arrayMensajes[] = "La fecha de nacimiento del ".$this->getTipoMiembro()." no ha sido ingresado";
            }
            //-----------------------------------------------------

            //------------------Validar campo del Id del Género-----------------------
            if(!empty($this->getGeneroId())){
                $this->setGeneroId(TestInput::test_input($this->getGeneroId()));
                if(!ValidatorAtributosGenerales::isEntidadId($this->getGeneroId())){
                    $arrayMensajes[] = "El género del ".$this->getTipoMiembro()." ingresado posee un formato no adecuado";
                }
            }
            else{
                $arrayMensajes[] = "El género del ".$this->getTipoMiembro()." no ha sido ingresado";
            }
            //-----------------------------------------------------

            //------------------Validar campo del Número Telefónico-----------------------
            if(!empty($this->getNumeroTelefonico())){
                $this->setNumeroTelefonico(TestInput::test_input($this->getNumeroTelefonico()));
                if(!ValidatorMiembro::isValorNumericoFijo($this->getNumeroTelefonico())){
                    $arrayMensajes[] = "El número telefónico del ".$this->getTipoMiembro()." ingresado posee un formato no adecuado";
                }
                if(strlen($this->getNumeroTelefonico())!=9){
                    $arrayMensajes[] = "El número telefónico del ".$this->getTipoMiembro()." ingresado no posee 9 dígitos";
                }
            }
            else{
                $arrayMensajes[] = "El número telefónico del ".$this->getTipoMiembro()." no ha sido ingresado";
            }
            //-----------------------------------------------------

            return $arrayMensajes;
        }
        //-----------------------------------------------------

        //------------------Getter y Setter del Id del Miembro-----------------------
        public function getMiembroId()
        {
                return $this->miembroId;
        }
        //-----------------------------------------------------

        //-----------------------------------------------------
        public function setMiembroId($miembroId)
        {
                $this->miembroId = $miembroId;

                return $this;
        }
        //-----------------------------------------------------

        //------------------Getter y Setter del DNI del Miembro-----------------------
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

        //------------------Getter y Setter del Nombre del Miembro-----------------------
        public function getNombre()
        {
                return $this->nombre;
        }
        //-----------------------------------------------------

        //-----------------------------------------------------
        public function setNombre($nombre)
        {
                $this->nombre = $nombre;

                return $this;
        }
        //-----------------------------------------------------

        //------------------Getter y Setter del Apellido Paterno del Miembro-----------------------
        public function getApellidoPaterno()
        {
                return $this->apellidoPaterno;
        }
        //-----------------------------------------------------

        //-----------------------------------------------------
        public function setApellidoPaterno($apellidoPaterno)
        {
                $this->apellidoPaterno = $apellidoPaterno;

                return $this;
        }
        //-----------------------------------------------------

        //------------------Getter y Setter del Apellido Materno del Miembro-----------------------
        public function getApellidoMaterno()
        {
                return $this->apellidoMaterno;
        }
        //-----------------------------------------------------

        //-----------------------------------------------------
        public function setApellidoMaterno($apellidoMaterno)
        {
                $this->apellidoMaterno = $apellidoMaterno;

                return $this;
        }
        //-----------------------------------------------------
        
        //------------------Getter y Setter de la Fecha de Nacimiento del Miembro-----------------------
        public function getFechaNacimiento()
        {
                return $this->fechaNacimiento;
        }
        //-----------------------------------------------------

        //-----------------------------------------------------
        public function setFechaNacimiento($fechaNacimiento)
        {
                $this->fechaNacimiento = $fechaNacimiento;

                return $this;
        }
        //-----------------------------------------------------

        //------------------Getter y Setter del id de Género del Miembro-----------------------
        public function getGeneroId()
        {
                return $this->generoId;
        }
        //-----------------------------------------------------

        //-----------------------------------------------------
        public function setGeneroId($generoId)
        {
                $this->generoId = $generoId;

                return $this;
        }
        //-----------------------------------------------------

        //------------------Getter y Setter del Número Telefónico del Miembro-----------------------
        public function getNumeroTelefonico()
        {
                return $this->numeroTelefonico;
        }
        //-----------------------------------------------------

        //-----------------------------------------------------
        public function setNumeroTelefonico($numeroTelefonico)
        {
                $this->numeroTelefonico = $numeroTelefonico;

                return $this;
        }
        //-----------------------------------------------------

        //------------------Getter y Setter del Nombre Completo del Miembro-----------------------
        public function getNombreCompleto()
        {
                return $this->nombreCompleto;
        }
        //-----------------------------------------------------

        //-----------------------------------------------------
        public function setNombreCompleto($nombreCompleto)
        {
                $this->nombreCompleto = $nombreCompleto;

                return $this;
        }
        //-----------------------------------------------------

        //------------------Getter y Setter del Tipo de Miembro en la Organización-----------------------
        public function getTipoMiembro()
        {
                return $this->tipoMiembro;
        }
        //-----------------------------------------------------

        //-----------------------------------------------------
        public function setTipoMiembro($tipoMiembro)
        {
                $this->tipoMiembro = $tipoMiembro;

                return $this;
        }
        //-----------------------------------------------------
    }
?>