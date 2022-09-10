<?php

    require_once('../DTO/Estudiante.php');
    require_once('../Conexion/Conexion.php');

    class AlumnoDAO{

        public function insertar(Estudiante $estudiante){
            try{
                
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_estudiante_insertar(?,?,?,?,?,?,?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$estudiante->getDni());
                $query->bindValue(2,$estudiante->getNombre());
                $query->bindValue(3,$estudiante->getApellidoPaterno());
                $query->bindValue(4,$estudiante->getApellidoMaterno());
                $query->bindValue(5,$estudiante->getFechaNacimiento());
                $query->bindValue(6,$estudiante->getGenero());
                $query->bindValue(7,$estudiante->getNumeroTelefonico());

                $query->execute();

            }
            
            catch(PDOException $e){
                if(str_contains($e->getMessage(),'idx_estudiante_dni')){
                    throw new Exception("El dni del estudiante ingresado ya existe en el sistema");
                }

                if(str_contains($e->getMessage(),'idx_estudiante_numero_telefonico')){
                    throw new Exception("El número telefónico del estudiante ingresado ya existe en el sistema");
                }

                throw $e;
                exit;
            }
        }

        public function buscarPorId($estudianteId){
            try{
                
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_estudiante_buscar_por_id(?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$estudianteId);
                
                $query->setFetchMode(PDO::FETCH_ASSOC);
                $query->execute();

                $estudiantesListados = array();

                while($row = $query->fetch()){
                    $estudiante = new Estudiante();

                    $estudiante -> construirObjeto($row["estudiante_id"],$row["dni"],$row["nombre"],$row["apellido_paterno"],
                    $row["apellido_materno"],$row["fecha_nacimiento"],$row["genero"],$row["numero_telefonico"]);
                
                    $estudiantesListados[] = $estudiante;
                }
            }
            
            catch(PDOException $e){
                throw $e;
                exit;
            }
        }

        public function buscarPorIdNombreConcatenado($estudianteId){
            try{
                
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_estudiante_buscar_por_id_nombre_concatenado(?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$estudianteId);
                
                $query->setFetchMode(PDO::FETCH_ASSOC);
                $query->execute();

                $estudiantesListados = array();

                while($row = $query->fetch()){
                    $estudiante = new Estudiante();

                    $estudiante -> construirObjeto($row["estudiante_id"],$row["dni"],NULL,NULL,
                    NULL,$row["fecha_nacimiento"],$row["genero"],$row["numero_telefonico"]);

                    $estudiante->setNombreCompleto($row["nombre_completo"]);
                
                    $estudiantesListados[] = $estudiante;
                }
            }
            
            catch(PDOException $e){
                throw $e;
                exit;
            }
        }

        public function buscarPorDNI($dniEstudiante){
            try{
                
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_estudiante_buscar_por_dni(?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$dniEstudiante);
                
                $query->setFetchMode(PDO::FETCH_ASSOC);
                $query->execute();

                $estudiantesListados = array();

                while($row = $query->fetch()){
                    $estudiante = new Estudiante();

                    $estudiante -> construirObjeto($row["estudiante_id"],$row["dni"],$row["nombre"],$row["apellido_paterno"],
                    $row["apellido_materno"],$row["fecha_nacimiento"],$row["genero"],$row["numero_telefonico"]);
                
                    $estudiantesListados[] = $estudiante;
                }
            }
            
            catch(PDOException $e){
                throw $e;
                exit;
            }
        }

        
        public function buscarPorDNINombreConcatenado($dniEstudiante){
            try{
                
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_estudiante_buscar_por_dni_nombre_concatenado(?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$dniEstudiante);
                
                $query->setFetchMode(PDO::FETCH_ASSOC);
                $query->execute();

                $estudiantesListados = array();

                while($row = $query->fetch()){
                    $estudiante = new Estudiante();

                    $estudiante -> construirObjeto($row["estudiante_id"],$row["dni"],NULL,NULL,
                    NULL,$row["fecha_nacimiento"],$row["genero"],$row["numero_telefonico"]);

                    $estudiante->setNombreCompleto($row["nombre_completo"]);
                
                    $estudiantesListados[] = $estudiante;
                }
            }
            
            catch(PDOException $e){
                throw $e;
                exit;
            }
        }

        public function buscarPorNombreCompleto($nombreCompleto){
            try{
                
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_estudiante_buscar_por_nombre_completo(?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$nombreCompleto);
                
                $query->setFetchMode(PDO::FETCH_ASSOC);
                $query->execute();

                $estudiantesListados = array();

                while($row = $query->fetch()){
                    $estudiante = new Estudiante();

                    $estudiante -> construirObjeto($row["estudiante_id"],$row["dni"],NULL,NULL,
                    NULL,$row["fecha_nacimiento"],$row["genero"],$row["numero_telefonico"]);

                    $estudiante->setNombreCompleto($row["nombre_completo"]);
                
                    $estudiantesListados[] = $estudiante;
                }
            }
            
            catch(PDOException $e){
                throw $e;
                exit;
            }
        }

        public function buscarNombreCompletoPorDNI($dniEstudiante){
            try{
                
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_estudiante_buscar_nombre_completo_por_dni(?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$dniEstudiante);
                
                $query->setFetchMode(PDO::FETCH_ASSOC);
                $query->execute();

                $estudiantesListados = array();

                while($row = $query->fetch()){
                    $estudiante = new Estudiante();

                    $estudiante->setNombreCompleto($row["nombre_completo"]);
                
                    $estudiantesListados[] = $estudiante;
                }
            }
            
            catch(PDOException $e){
                throw $e;
                exit;
            }
        }

        public function listar(){
            try{
                
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_estudiante_listar()";
                $query = $conexion->prepare($sql);
                
                $query->setFetchMode(PDO::FETCH_ASSOC);
                $query->execute();

                $estudiantesListados = array();

                while($row = $query->fetch()){
                    $estudiante = new Estudiante();

                    $estudiante -> construirObjeto($row["estudiante_id"],$row["dni"],NULL,NULL,
                    NULL,$row["fecha_nacimiento"],$row["genero"],$row["numero_telefonico"]);

                    $estudiante->setNombreCompleto($row["nombre_completo"]);
                
                    $estudiantesListados[] = $estudiante;
                }
            }
            
            catch(PDOException $e){
                throw $e;
                exit;
            }
        }

        public function eliminar($estudianteId){
            try{
                
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_estudiante_eliminar(?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$estudianteId);

                $query->execute();
            }
            
            catch(PDOException $e){
                throw $e;
                exit;
            }
        }

        public function actualizar(Estudiante $estudiante){
            try{
                
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_estudiante_actualizar(?,?,?,?,?,?,?,?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$estudiante->getMiembroId());
                $query->bindValue(2,$estudiante->getDni());
                $query->bindValue(3,$estudiante->getNombre());
                $query->bindValue(4,$estudiante->getApellidoPaterno());
                $query->bindValue(5,$estudiante->getApellidoMaterno());
                $query->bindValue(6,$estudiante->getFechaNacimiento());
                $query->bindValue(7,$estudiante->getGenero());
                $query->bindValue(8,$estudiante->getNumeroTelefonico());

                $query->execute();
            }
            
            catch(PDOException $e){
                if(str_contains($e->getMessage(),'idx_estudiante_dni')){
                    throw new Exception("El dni del estudiante ingresado ya existe en el sistema");
                }

                if(str_contains($e->getMessage(),'idx_estudiante_numero_telefonico')){
                    throw new Exception("El número telefónico del estudiante ingresado ya existe en el sistema");
                }

                throw $e;
                exit;
            }
        }
    }
?>