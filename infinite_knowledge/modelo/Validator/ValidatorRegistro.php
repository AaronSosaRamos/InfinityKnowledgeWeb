<?php
    /*Clase que permite validar el registro de calificaciones
    y el registro de asistencias estudiantiles
    */
    
    class ValidatorRegistro{

        //------------------Validar Calificaciones-----------------------
        public static function isCalificacion($calificacion){
            $bandera = true;
            if(!is_numeric($calificacion)){
                $bandera = false;
            }
            if(($calificacion<0)||($calificacion>20)){
                $bandera = false;
            }
            return $bandera;
        }
        //-----------------------------------------------------

        //------------------Validar Asistencias-----------------------
        public static function isValorAsistencia($valorAsistencia){
            $bandera = true;
            if(!is_numeric($valorAsistencia)){
                $bandera = false;
            }
            if(($valorAsistencia<0)||($valorAsistencia>365)){
                $bandera = false;
            }
            return $bandera;
        }
        //-----------------------------------------------------
        
    }
?>