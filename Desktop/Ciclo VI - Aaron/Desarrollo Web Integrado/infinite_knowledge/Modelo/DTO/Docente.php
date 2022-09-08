<?php

    require_once('../ValidacionDeDatos/TestInput.php');
    require_once('../ValidacionDeDatos/ValidatorAtributosGenerales.php');

    class Docente extends Miembro{

        //------------------Atributos exclusivos de Docente-----------------------
        private $gradoAcademicoId;
        private $especialidadAcademicaId;
        //-----------------------------------------------------

        //------------------Constructor-----------------------
        public function __construct(){
            $this->setTipoMiembro("docente");
        }
        //-----------------------------------------------------

        //------------------Construir Objeto-----------------------
        public function construirObjeto($miembroId,$dni,$nombre,$apellidoPaterno,
        $apellidoMaterno,$fechaNacimiento,$generoId,$numeroTelefonico,$gradoAcademicoId,
        $especialidadAcademicaId){
            parent::construirObjetoMiembro($miembroId,$dni,$nombre,$apellidoPaterno,$apellidoMaterno,$fechaNacimiento,$generoId,$numeroTelefonico);
            $this->setGradoAcademicoId($gradoAcademicoId);
            $this->setEspecialidadAcademicaId($especialidadAcademicaId);
        }
        //-----------------------------------------------------
        
        //------------------Validar campos en común entre los miembros-----------------------
        public function validarCampos(){
            $arrayMensajes = parent::validarCampos();

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

            //------------------Validar campo del Id de la Especialidad Académica-----------------------
            if(!empty($this->getEspecialidadAcademicaId())){
                $this->setEspecialidadAcademicaId(TestInput::test_input($this->getEspecialidadAcademicaId()));
                if(!ValidatorAtributosGenerales::isEntidadId($this->getEspecialidadAcademicaId())){
                    $arrayMensajes[] = "La especialidad académica del ".$this->getTipoMiembro()." ingresado posee un formato no adecuado";
                }
            }
            else{
                $arrayMensajes[] = "La especialidad académica del ".$this->getTipoMiembro()." no ha sido ingresado";
            }
            //-----------------------------------------------------

            return $arrayMensajes;
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

        //------------------Getter y Setter del Id de la Especialidad Académica-----------------------
        public function getEspecialidadAcademicaId()
        {
                return $this->especialidadAcademicaId;
        }
        //-----------------------------------------------------

        //-----------------------------------------------------
        public function setEspecialidadAcademicaId($especialidadAcademicaId)
        {
                $this->especialidadAcademicaId = $especialidadAcademicaId;

                return $this;
        }
        //-----------------------------------------------------
    }
?>