<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/AuxiliarAcademico.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/Conexion/Conexion.php');

    class AuxiliarAcademicoDAO{

        public function insertar(AuxiliarAcademico $auxiliarAcademico){
            try {
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_auxiliar_academico_insertar(?,?,?,?,?,?,?,?,?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$auxiliarAcademico->getDni());
                $query->bindValue(2,$auxiliarAcademico->getNombre());
                $query->bindValue(3,$auxiliarAcademico->getApellidoPaterno());
                $query->bindValue(4,$auxiliarAcademico->getApellidoMaterno());
                $query->bindValue(5,$auxiliarAcademico->getFechaNacimiento());
                $query->bindValue(6,$auxiliarAcademico->getNDocentesACargo());
                $query->bindValue(7,$auxiliarAcademico->getGenero());
                $query->bindValue(8,$auxiliarAcademico->getNumeroTelefonico());
                $query->bindValue(9,$auxiliarAcademico->getGradoAcademico());

                $query->execute();
            } 
            catch (PDOException $e) {
                if(str_contains($e->getMessage(),'idx_auxiliar_academico_dni')){
                    throw new Exception("El dni del auxiliar académico ingresado ya existe en el sistema");
                }

                if(str_contains($e->getMessage(),'idx_auxiliar_academico_numero_telefonico')){
                    throw new Exception("El número telefónico del auxiliar académico ingresado ya existe en el sistema");
                }

                throw $e;
                exit;
            }
        }

        public function buscarPorId(){
            try{
                    
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_auxiliar_academico_buscar_por_id()";
                $query = $conexion->prepare($sql);
                
                $query->setFetchMode(PDO::FETCH_ASSOC);
                $query->execute();

                $auxiliarAcademico = new AuxiliarAcademico();

                while($row = $query->fetch()){

                    $auxiliarAcademico -> construirObjeto($row["auxiliar_academico_id"],$row["dni"],$row["nombre"],$row["apellido_paterno"],
                    $row["apellido_materno"],$row["fecha_nacimiento"],$row["genero"],$row["numero_telefonico"],$row["n_docentes_a_cargo"],
                    $row["grado_academico"]);

                    $auxiliarAcademico->setNombreCompleto($row["nombre_completo"]);
                }

                return $auxiliarAcademico;
            }
            
            catch(PDOException $e){
                throw $e;
                exit;
            }
        }

        public function buscarPorDNI($dni){
            try{
                    
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_auxiliar_academico_buscar_por_dni(?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$dni);
                
                $query->setFetchMode(PDO::FETCH_ASSOC);
                $query->execute();

                $auxiliarAcademico = new AuxiliarAcademico();

                while($row = $query->fetch()){
                    $auxiliarAcademico -> construirObjeto($row["auxiliar_academico_id"],$row["dni"],$row["nombre"],$row["apellido_pateno"],
                    $row["apellido_materno"],$row["fecha_nacimiento"],$row["genero"],$row["numero_telefonico"],$row["n_docentes_a_cargo"],
                    $row["gradoAcademico"]);

                    $auxiliarAcademico->setNombreCompleto($row["nombre_completo"]);
                }

                return $auxiliarAcademico;
            }
            
            catch(PDOException $e){
                throw $e;
                exit;
            }
        }

        public function buscarDatosParaEmail(){
            try{
                
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_auxiliar_academico_buscar_datos_para_email()";
                $query = $conexion->prepare($sql);

                $query->setFetchMode(PDO::FETCH_ASSOC);
                $query->execute();

                $auxiliarAcademico = new AuxiliarAcademico();

                while($row = $query->fetch()){
                    $auxiliarAcademico -> construirObjeto($row["auxiliar_academico_id"],$row["dni"],null,null,
                    null,null,null,null,null,null);
                    $auxiliarAcademico->setNombreCompleto($row["nombre_completo"]);
                }

                return $auxiliarAcademico;
            }
            
            catch(PDOException $e){
                throw $e;
                exit;
            }
        }

        public function buscarNombreCompleto(){
            try{
                
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_auxiliar_academico_buscar_nombre_completo()";
                $query = $conexion->prepare($sql);

                $query->setFetchMode(PDO::FETCH_ASSOC);
                $query->execute();

                $nombreCompleto = "";

                while($row = $query->fetch()){
                    $nombreCompleto = $row["nombre_completo"];
                }

                return $nombreCompleto;
            }
            
            catch(PDOException $e){
                throw $e;
                exit;
            }
        }

        public function eliminar(){
            try{
                
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_auxiliar_academico_eliminar()";
                $query = $conexion->prepare($sql);

                $query->execute();
            }
            
            catch(PDOException $e){
                throw $e;
                exit;
            }
        }

        public function actualizar(AuxiliarAcademico $auxiliarAcademico){
            try{
                
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_auxiliar_academico_actualizar(?,?,?,?,?,?,?,?,?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$auxiliarAcademico->getDni());
                $query->bindValue(2,$auxiliarAcademico->getNombre());
                $query->bindValue(3,$auxiliarAcademico->getApellidoPaterno());
                $query->bindValue(4,$auxiliarAcademico->getApellidoMaterno());
                $query->bindValue(5,$auxiliarAcademico->getFechaNacimiento());
                $query->bindValue(6,$auxiliarAcademico->getNDocentesACargo());
                $query->bindValue(7,$auxiliarAcademico->getGenero());
                $query->bindValue(8,$auxiliarAcademico->getNumeroTelefonico());
                $query->bindValue(9,$auxiliarAcademico->getGradoAcademico());

                $query->execute();
            }
            
            catch(PDOException $e){
                if(str_contains($e->getMessage(),'idx_auxiliar_academico_dni')){
                    throw new Exception("El dni del auxiliar académico ingresado ya existe en el sistema");
                }

                if(str_contains($e->getMessage(),'idx_auxiliar_academico_numero_telefonico')){
                    throw new Exception("El número telefónico del auxiliar académico ingresado ya existe en el sistema");
                }
                
                throw $e;
                exit;
            }
        }

    }

?>