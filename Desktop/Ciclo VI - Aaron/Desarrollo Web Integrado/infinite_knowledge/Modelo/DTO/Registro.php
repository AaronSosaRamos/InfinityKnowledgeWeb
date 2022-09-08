<?php

    require_once('../ValidacionDeDatos/TestInput.php');
    require_once('../ValidacionDeDatos/ValidatorAtributosGenerales.php');

    class Registro{

        //------------------Atributos en común entre los registros estudiantiles-----------------------
        private $docenteId;
        private $estudianteId;
        private $salonClasesId;
        private $cursoId;
        private $fechaEmision;
        //-----------------------------------------------------

        //------------------Constructor vacío-----------------------
        public function __construct(){

        }
        //-----------------------------------------------------

        //------------------Construir Objeto-----------------------
        public function construirObjetoRegistro($docenteId,$estudianteId,$salonClasesId,$cursoId,$fechaEmision){
            $this->docenteId = $docenteId;
            $this->estudianteId = $estudianteId;
            $this->salonClasesId = $salonClasesId;
            $this->cursoId = $cursoId;
            $this->fechaEmision = $fechaEmision;
        }
        //-----------------------------------------------------

        //------------------Validar campos en común entre los registros estudiantiles-----------------------
        public function validarCampos(){

            $arrayMensajes = array();

            //------------------Validar campo del Id del Docente-----------------------
            if(!empty($this->getDocenteId())){
                $this->setDocenteId(TestInput::test_input($this->getDocenteId()));
                if(!ValidatorAtributosGenerales::isEntidadId($this->getDocenteId())){
                    $arrayMensajes[] = "El docente ingresado posee un formato no adecuado";
                }
            }
            else{
                $arrayMensajes[] = "El docente no ha sido ingresado";
            }
            //-----------------------------------------------------

            //------------------Validar campo del Id del Estudiante-----------------------
            if(!empty($this->getEstudianteId())){
                $this->setEstudianteId(TestInput::test_input($this->getEstudianteId()));
                if(!ValidatorAtributosGenerales::isEntidadId($this->getEstudianteId())){
                    $arrayMensajes[] = "El estudiante ingresado posee un formato no adecuado";
                }
            }
            else{
                $arrayMensajes[] = "El estudiante no ha sido ingresado";
            }
            //-----------------------------------------------------

            //------------------Validar campo del Id del Salón de Clases-----------------------
            if(!empty($this->getSalonClasesId())){
                $this->setSalonClasesId(TestInput::test_input($this->getSalonClasesId()));
                if(!ValidatorAtributosGenerales::isEntidadId($this->getSalonClasesId())){
                    $arrayMensajes[] = "El salón de clases ingresado posee un formato no adecuado";
                }
            }
            else{
                $arrayMensajes[] = "El salón de clases no ha sido ingresado";
            }
            //-----------------------------------------------------

            //------------------Validar campo del Id del Curso-----------------------
            if(!empty($this->getCursoId())){
                $this->setCursoId(TestInput::test_input($this->getCursoId()));
                if(!ValidatorAtributosGenerales::isEntidadId($this->getCursoId())){
                    $arrayMensajes[] = "El curso ingresado posee un formato no adecuado";
                }
            }
            else{
                $arrayMensajes[] = "El curso no ha sido ingresado";
            }
            //-----------------------------------------------------

            $this->setFechaEmision(estInput::test_input($this->getFechaEmision()));

            return $arrayMensajes;
        }
        //-----------------------------------------------------

        //------------------Getter y Setter del Id del Docente-----------------------
        public function getDocenteId()
        {
                return $this->docenteId;
        }
        //-----------------------------------------------------

        //-----------------------------------------------------
        public function setDocenteId($docenteId)
        {
                $this->docenteId = $docenteId;

                return $this;
        }
        //-----------------------------------------------------

        //------------------Getter y Setter del Id del Estudiante-----------------------
        public function getEstudianteId()
        {
                return $this->estudianteId;
        }
        //-----------------------------------------------------

        //-----------------------------------------------------
        public function setEstudianteId($estudianteId)
        {
                $this->estudianteId = $estudianteId;

                return $this;
        }
        //-----------------------------------------------------

        //------------------Getter y Setter del Id del Salón de Clases-----------------------
        public function getSalonClasesId()
        {
                return $this->salonClasesId;
        }
        //-----------------------------------------------------

        //-----------------------------------------------------
        public function setSalonClasesId($salonClasesId)
        {
                $this->salonClasesId = $salonClasesId;

                return $this;
        }
        //-----------------------------------------------------

        //------------------Getter y Setter del Id del Curso-----------------------
        public function getCursoId()
        {
                return $this->cursoId;
        }
        //-----------------------------------------------------

        //-----------------------------------------------------
        public function setCursoId($cursoId)
        {
                $this->cursoId = $cursoId;

                return $this;
        }
        //-----------------------------------------------------

        //------------------Getter y Setter de la Fecha de Emisión-----------------------
        public function getFechaEmision()
        {
                return $this->fechaEmision;
        }
        //-----------------------------------------------------

        //-----------------------------------------------------
        public function setFechaEmision($fechaEmision)
        {
                $this->fechaEmision = $fechaEmision;

                return $this;
        }
        //-----------------------------------------------------
    }

?>  