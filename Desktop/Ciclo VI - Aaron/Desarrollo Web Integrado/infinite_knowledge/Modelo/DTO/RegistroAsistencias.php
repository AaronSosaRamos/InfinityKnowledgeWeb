<?php

    require_once('../ValidacionDeDatos/TestInput.php');
    require_once('../ValidacionDeDatos/ValidatorRegistro.php');

    class RegistroAsistencias extends Registro{

        private $nAsistenciasRealizadas;
        private $nFaltasRealizadas;
        private $nJustificacionesRealizadas;
        private $nTotalAsistencias;

        //------------------Constructor vacío-----------------------
        public function __construct(){

        }
        //-----------------------------------------------------

        //------------------Construir Objeto-----------------------
        public function construirObjeto($docenteId,$estudianteId,$salonClasesId,$cursoId,
        $nAsistenciasRealizadas,$nJustificacionesRealizadas,$fechaEmision){
            parent::construirObjetoRegistro($docenteId,$estudianteId,$salonClasesId,$cursoId,$fechaEmision);
            $this->nAsistenciasRealizadas = $nAsistenciasRealizadas;
            $this->nJustificacionesRealizadas = $nJustificacionesRealizadas;
        }
        //-----------------------------------------------------
    
        //------------------Validar campos del Registro de Asistencias-----------------------
        public function validarCampos(){

            $arrayMensajes = parent::validarCampos();
            
            //------------------Validar campo del Número de Asistencias Realizadas-----------------------
            if(!empty($this->getNAsistenciasRealizadas())){
                $this->setNAsistenciasRealizadas(TestInput::test_input($this->getNAsistenciasRealizadas()));
                if(!ValidatorRegistro::isValorAsistencia($this->getNAsistenciasRealizadas())){
                    $arrayMensajes[] = "El número de asistencias realizadas ingresado no posee un formato no adecuado";     
                }
            }
            //-----------------------------------------------------
            
            //------------------Validar campo del Número de Justificaciones Realizadas-----------------------
            if(!empty($this->getNJustificacionesRealizadas())){
                $this->setNJustificacionesRealizadas(TestInput::test_input($this->getNJustificacionesRealizadas()));
                if(!ValidatorRegistro::isValorAsistencia($this->getNJustificacionesRealizadas())){
                    $arrayMensajes[] = "El número de justificaciones realizadas ingresado no posee un formato no adecuado";     
                }
            }
            //-----------------------------------------------------

            return $arrayMensajes;
        }
        //-----------------------------------------------------

        //------------------Getter y Setter del Número de Asistencias Realizadas-----------------------
        public function getNAsistenciasRealizadas()
        {
                return $this->nAsistenciasRealizadas;
        }
        //-----------------------------------------------------

        //-----------------------------------------------------
        public function setNAsistenciasRealizadas($nAsistenciasRealizadas)
        {
                $this->nAsistenciasRealizadas = $nAsistenciasRealizadas;

                return $this;
        }
        //-----------------------------------------------------
        
        //------------------Getter y Setter del Número de Faltas Realizadas-----------------------
        public function getNFaltasRealizadas()
        {
                return $this->nFaltasRealizadas;
        }
        //-----------------------------------------------------

        //-----------------------------------------------------
        public function setNFaltasRealizadas($nFaltasRealizadas)
        {
                $this->nFaltasRealizadas = $nFaltasRealizadas;

                return $this;
        }
        //-----------------------------------------------------

        //------------------Getter y Setter del Número de Justificaciones Realizadas-----------------------
        public function getNJustificacionesRealizadas()
        {
                return $this->nJustificacionesRealizadas;
        }
        //-----------------------------------------------------

        //-----------------------------------------------------
        public function setNJustificacionesRealizadas($nJustificacionesRealizadas)
        {
                $this->nJustificacionesRealizadas = $nJustificacionesRealizadas;

                return $this;
        }
        //-----------------------------------------------------

        //------------------Getter y Setter del Número Total de Asistencias-----------------------
        public function getNTotalAsistencias()
        {
                return $this->nTotalAsistencias;
        }
        //-----------------------------------------------------

        //-----------------------------------------------------
        public function setNTotalAsistencias($nTotalAsistencias)
        {
                $this->nTotalAsistencias = $nTotalAsistencias;

                return $this;
        }
        //-----------------------------------------------------

    }

?>