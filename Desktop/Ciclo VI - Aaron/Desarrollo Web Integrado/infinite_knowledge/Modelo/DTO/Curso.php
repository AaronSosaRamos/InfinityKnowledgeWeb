<?php

    require_once('../ValidacionDeDatos/TestInput.php');
    require_once('../ValidacionDeDatos/ValidatorMiembro.php');
    require_once('../ValidacionDeDatos/ValidatorAtributosGenerales.php');

    class Curso{
        //------------------Atributos exclusivos de Curso-----------------------
        private $cursoId;
        private $nombre;
        private $nHoras;
        private $dificultadCursoId;
        private $enfoqueCursoId;
        //-----------------------------------------------------

        //------------------Constructor vacío-----------------------
        public function __construct(){

        }
        //-----------------------------------------------------

        //------------------Construir Objeto-----------------------
        public function construirObjeto($cursoId,$nombre,$nHoras,
        $dificultadCursoId,$enfoqueCursoId){
            $this->cursoId = $cursoId;
            $this->nombre = $nombre;
            $this->nHoras = $nHoras;
            $this->dificultadCursoId = $dificultadCursoId;
            $this->enfoqueCursoId = $enfoqueCursoId;
        }
        //-----------------------------------------------------

        //------------------Validar campos de Curso-----------------------
        public function validarCampos(){

            $arrayMensajes = array();
            
            //------------------Validar campo del Nombre-----------------------
            if(!empty($this->getNombre())){
                $this->setNombre(TestInput::test_input($this->getNombre()));
                if(!ValidatorMiembro::isNombreOApellido($this->getNombre())){
                    $arrayMensajes[] = "El nombre del Curso ingresado posee un formato no adecuado";
                }
                if(strlen($this->getNombre())>45){
                    $arrayMensajes[] = "El nombre del Curso ingresado excede el límite de caracteres establecido (45 caracteres) ";
                }
            }
            else{
                $arrayMensajes[] = "El nombre del Curso no ha sido ingresado";
            }
            //-----------------------------------------------------
            
            //------------------Validar campo del Número de Horas-----------------------
            if(!empty($this->getNHoras())){
                $this->setNHoras(TestInput::test_input($this->getNHoras()));
                if(!ValidatorAtributosGenerales::isValorEnteroPositivo($this->getNHoras())){
                    $arrayMensajes[] = "El nombre del Curso ingresado posee un formato no adecuado";        
                }
            }
            else{
                $arrayMensajes[] = "El nombre del Curso no ha sido ingresado";  
            }
            //-----------------------------------------------------

            //------------------Validar campo del Id de la Dificultad de Curso-----------------------
            if(!empty($this->getDificultadCursoId())){
                $this->setDificultadCursoId(TestInput::test_input($this->getDificultadCursoId()));
                if(!ValidatorAtributosGenerales::isEntidadId($this->getDificultadCursoId())){
                    $arrayMensajes[] = "La dificultad del Curso ingresada posee un formato no adecuado";        
                }
            }
            else{
                $arrayMensajes[] = "La dificultad del Curso no ha sido ingresada";  
            }
            //-----------------------------------------------------

            //------------------Validar campo del Id del Enfoque de Curso-----------------------
            if(!empty($this->getEnfoqueCursoId())){
                $this->setEnfoqueCursoId(TestInput::test_input($this->getEnfoqueCursoId()));
                if(!ValidatorAtributosGenerales::isEntidadId($this->getEnfoqueCursoId())){
                    $arrayMensajes[] = "El enfoque del Curso ingresado posee un formato no adecuado";        
                }
            }
            else{
                $arrayMensajes[] = "El enfoque del Curso no ha sido ingresado";  
            }
            //-----------------------------------------------------

            return $arrayMensajes;
        }

        //------------------Getter y Setter del Id de Curso-----------------------
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

        //------------------Getter y Setter del Nombre de Curso-----------------------
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

        //------------------Getter y Setter del Número de Horas-----------------------
        public function getNHoras()
        {
                return $this->nHoras;
        }
        //-----------------------------------------------------

        //-----------------------------------------------------
        public function setNHoras($nHoras)
        {
                $this->nHoras = $nHoras;

                return $this;
        }
        //-----------------------------------------------------

        //------------------Getter y Setter del Id de la Dificultad de Curso-----------------------
        public function getDificultadCursoId()
        {
                return $this->dificultadCursoId;
        }
        //-----------------------------------------------------

        //-----------------------------------------------------
        public function setDificultadCursoId($dificultadCursoId)
        {
                $this->dificultadCursoId = $dificultadCursoId;

                return $this;
        }
        //-----------------------------------------------------

        //------------------Getter y Setter del Id del Enfoque de Curso-----------------------
        public function getEnfoqueCursoId()
        {
                return $this->enfoqueCursoId;
        }
        //-----------------------------------------------------

        //-----------------------------------------------------
        public function setEnfoqueCursoId($enfoqueCursoId)
        {
                $this->enfoqueCursoId = $enfoqueCursoId;

                return $this;
        }
        //-----------------------------------------------------
    }
?>