<?php
    class Estudiante extends Miembro{

        //------------------Constructor-----------------------
        public function __construct(){
            $this->setTipoMiembro("estudiante");
        }
        //-----------------------------------------------------
        
        //------------------Construir Objeto-----------------------
        public function construirObjeto($miembroId,$dni,$nombre,$apellidoPaterno,
        $apellidoMaterno,$fechaNacimiento,$genero,$numeroTelefonico){
            parent::construirObjetoMiembro($miembroId,$dni,$nombre,$apellidoPaterno,$apellidoMaterno,$fechaNacimiento,$genero,$numeroTelefonico);
        }
        //-----------------------------------------------------
    }
?>