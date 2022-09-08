<?php

    require_once('../ValidacionDeDatos/TestInput.php');
    require_once('../ValidacionDeDatos/ValidatorAtributosGenerales.php');
    
    class AuxiliarAcademico extends Miembro{

        //------------------Atributos exclusivos de Auxiliar Académico-----------------------
        private $nDocentesACargo;
        private $gradoAcademicoId;
        //-----------------------------------------------------

        //------------------Constructor-----------------------
        public function __construct(){
            $this->setTipoMiembro("auxiliar académico");
        }
        //-----------------------------------------------------

        //------------------Construir Objeto-----------------------
        public function construirObjeto($miembroId,$dni,$nombre,$apellidoPaterno,
        $apellidoMaterno,$fechaNacimiento,$generoId,$numeroTelefonico,$nDocentesACargo,
        $gradoAcademicoId){
            parent::construirObjetoMiembro($miembroId,$dni,$nombre,$apellidoPaterno,$apellidoMaterno,$fechaNacimiento,$generoId,$numeroTelefonico);
            $this->nDocentesACargo($nDocentesACargo);
            $this->gradoAcademicoId($gradoAcademicoId);
        }
        //-----------------------------------------------------
    
        //------------------Validar campos en común entre los miembros-----------------------
        public function validarCampos(){
            $arrayMensajes = parent::validarCampos();

            //------------------Validar campo del Número de Docentes A Cargo-----------------------
            if(!empty($this->getNDocentesACargo())){
                $this->setNDocentesACargo(TestInput::test_input($this->getNDocentesACargo()));
                if(!ValidatorAtributosGenerales::isValorEnteroPositivo($this->getNDocentesACargo())){
                    $arrayMensajes[] = "El número de docentes a cargo del ".$this->getTipoMiembro()." ingresado posee un formato no adecuado";
                }
            }
            else{
                $arrayMensajes[] = "El número de docentes a cargo del ".$this->getTipoMiembro()." no ha sido ingresado";
            }
            //-----------------------------------------------------

            //------------------Validar campo del Id del Grado Académico-----------------------
            if(!empty($this->getGradoAcademicoId())){
                $this->setGradoAcademicoId(TestInput::test_input($this->getGradoAcademicoId()));
                if(!ValidatorAtributosGenerales::isEntidadId($this->getGradoAcademicoId())){
                    $arrayMensajes[] = "El grado académico del ".$this->getTipoMiembro()." ingresado posee un formato no adecuado";
                }
            }
            else{
                $arrayMensajes[] = "El grado académico del ".$this->getTipoMiembro()." no ha sido ingresado";
            }
            //-----------------------------------------------------

            return $arrayMensajes;
        }

        //------------------Getter y Setter del Número de Docentes a Cargo-----------------------
        public function getNDocentesACargo()
        {
                return $this->nDocentesACargo;
        }
        //-----------------------------------------------------

        //-----------------------------------------------------
        public function setNDocentesACargo($nDocentesACargo)
        {
                $this->nDocentesACargo = $nDocentesACargo;

                return $this;
        }
        //-----------------------------------------------------

        //------------------Getter y Setter del Id del Grado Académico-----------------------
        public function getGradoAcademicoId()
        {
                return $this->gradoAcademicoId;
        }
        //-----------------------------------------------------

        //-----------------------------------------------------
        public function setGradoAcademicoId($gradoAcademicoId)
        {
                $this->gradoAcademicoId = $gradoAcademicoId;

                return $this;
        }
        //-----------------------------------------------------

    }
?>