<?php

    require_once('../ValidacionDeDatos/TestInput.php');
    require_once('../ValidacionDeDatos/ValidatorRegistro.php');

    class RegistroCalificaciones extends Registro{

        //------------------Atributos exclusivos del Registro de Calificaciones-----------------------
        private $estadoAprobacion;
        private $calif1;
        private $calif2;
        private $calif3;
        private $promedioFinal;
        //-----------------------------------------------------

        //------------------Constructor vacío-----------------------
        public function __construct(){

        }
        //-----------------------------------------------------

        //------------------Construir Objeto-----------------------
        public function construirObjeto($docenteId,$estudianteId,$cursoId,$salonClases,
        $calif1,$calif2,$calif3,$fechaEmision){
            parent::construirObjetoRegistro($docenteId,$estudianteId,$cursoId,$salonClases,$fechaEmision);
            $this->calif1 = $calif1;
            $this->calif2 = $calif2;
            $this->calif3 = $calif3;
        }
        //-----------------------------------------------------

        //------------------Validar campos del Registro de Calificaciones-----------------------
        public function validarCampos(){

            $arrayMensajes = parent::validarCampos();

            //------------------Validar campo de la Primera Calificación-----------------------
            if(!empty($this->getCalif1())){
                $this->setCalif1(TestInput::test_input($this->getCalif1()));
                if(!ValidatorRegistro::isCalificacion($this->getCalif1())){
                    $arrayMensajes[] = "La primera calificación ingresada posee un formato no adecuado";
                }
            }
            //-----------------------------------------------------

            //------------------Validar campo de la Segunda Calificación-----------------------
            if(!empty($this->getCalif2())){
                $this->setCalif2(TestInput::test_input($this->getCalif2()));
                if(!ValidatorRegistro::isCalificacion($this->getCalif2())){
                    $arrayMensajes[] = "La segunda calificación ingresada posee un formato no adecuado";
                }
            }
            //-----------------------------------------------------

            //------------------Validar campo de la Tercera Calificación-----------------------
            if(!empty($this->getCalif3())){
                $this->setCalif3(TestInput::test_input($this->getCalif3()));
                if(!ValidatorRegistro::isCalificacion($this->getCalif3())){
                    $arrayMensajes[] = "La tercera calificación ingresada posee un formato no adecuado";
                }
            }
            //-----------------------------------------------------

            return $arrayMensajes;
        }
        //-----------------------------------------------------

        //------------------Getter y Setter del Id del Estado de Aprobación-----------------------
        public function getEstadoAprobacionId()
        {
                return $this->estadoAprobacionId;
        }
        //-----------------------------------------------------
        
        //-----------------------------------------------------
        public function setEstadoAprobacionId($estadoAprobacionId)
        {
                $this->estadoAprobacionId = $estadoAprobacionId;

                return $this;
        }
        //-----------------------------------------------------

        //------------------Getter y Setter de la Primera Calificación-----------------------
        public function getCalif1()
        {
                return $this->calif1;
        }
        //-----------------------------------------------------

        //-----------------------------------------------------
        public function setCalif1($calif1)
        {
                $this->calif1 = $calif1;

                return $this;
        }
        //-----------------------------------------------------

        //------------------Getter y Setter de la Segunda Calificación-----------------------
        public function getCalif2()
        {
                return $this->calif2;
        }
        //-----------------------------------------------------

        //-----------------------------------------------------
        public function setCalif2($calif2)
        {
                $this->calif2 = $calif2;

                return $this;
        }
        //-----------------------------------------------------

        //------------------Getter y Setter de la Tercera Calificación-----------------------
        public function getCalif3()
        {
                return $this->calif3;
        }
        //-----------------------------------------------------

        //-----------------------------------------------------
        public function setCalif3($calif3)
        {
                $this->calif3 = $calif3;

                return $this;
        }
        //-----------------------------------------------------

        //------------------Getter y Setter del Promedio Final-----------------------
        public function getPromedioFinal()
        {
                return $this->promedioFinal;
        }
        //-----------------------------------------------------

        //-----------------------------------------------------
        public function setPromedioFinal($promedioFinal)
        {
                $this->promedioFinal = $promedioFinal;

                return $this;
        }
        //-----------------------------------------------------

    }

?>