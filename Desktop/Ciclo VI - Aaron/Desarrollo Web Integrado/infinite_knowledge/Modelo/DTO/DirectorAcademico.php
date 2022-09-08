<?php

    require_once('../ValidacionDeDatos/TestInput.php');
    require_once('../ValidacionDeDatos/ValidatorAtributosGenerales.php');

    class DirectorAcademico extends Miembro{

         //------------------Atributos exclusivos de Director Académico-----------------------
        private $aniosLabor;
        private $gradoAcademicoId;
        //-----------------------------------------------------

        //------------------Constructor-----------------------
        public function __construct(){
            $this->setTipoMiembro("director académico");
        }
        //-----------------------------------------------------

        //------------------Construir Objeto-----------------------
        public function construirObjeto($miembroId,$dni,$nombre,$apellidoPaterno,
        $apellidoMaterno,$fechaNacimiento,$generoId,$numeroTelefonico,$aniosLabor,
        $gradoAcademicoId){
            parent::construirObjetoMiembro($miembroId,$dni,$nombre,$apellidoPaterno,$apellidoMaterno,$fechaNacimiento,$generoId,$numeroTelefonico);
            $this->aniosLabor($aniosLabor);
            $this->gradoAcademicoId($gradoAcademicoId);
        }
        //-----------------------------------------------------
    
        //------------------Validar campos en común entre los miembros-----------------------
        public function validarCampos(){
            $arrayMensajes = parent::validarCampos();

            //------------------Validar campo de los Años de Labor-----------------------
            if(!empty($this->getAniosLabor())){
                $this->setAniosLabor(TestInput::test_input($this->getAniosLabor()));
                if(!ValidatorAtributosGenerales::isValorEnteroPositivo($this->getAniosLabor())){
                    $arrayMensajes[] = "Los años de labor a cargo del ".$this->getTipoMiembro()." ingresado posee un formato no adecuado";
                }
            }
            else{
                $arrayMensajes[] = "Los años de labor a cargo del ".$this->getTipoMiembro()." no ha sido ingresado";
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

        //------------------Getter y Setter de los Años de Labor-----------------------
        public function getAniosLabor()
        {
                return $this->aniosLabor;
        }

        public function setAniosLabor($aniosLabor)
        {
                $this->aniosLabor = $aniosLabor;

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