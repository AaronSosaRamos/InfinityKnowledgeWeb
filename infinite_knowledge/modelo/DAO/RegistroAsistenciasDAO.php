<?php

    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/RegistroAsistencias.php');

    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/Estudiante.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/Docente.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/Curso.php');

    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/Conexion/Conexion.php');


    class RegistroAsistenciasDAO{

        public function insertar(RegistroAsistencias $registroAsistencia){
            try{
                
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_registro_asistencias_insertar(?,?,?,?,?,?,?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$registroAsistencia->getDocenteId());
                $query->bindValue(2,$registroAsistencia->getEstudianteId());
                $query->bindValue(3,$registroAsistencia->getCursoId());
                $query->bindValue(4,$registroAsistencia->getSalonClases());

                if(empty($registroAsistencia->getNAsistenciasRealizadas())){
                    $query->bindValue(5,'NULL',PDO::PARAM_NULL);
                }
                else{
                    $query->bindValue(5,$registroAsistencia->getNAsistenciasRealizadas());
                }

                if(empty($registroAsistencia->getNJustificacionesRealizadas())){
                    $query->bindValue(6,'NULL',PDO::PARAM_NULL);
                }
                else{
                    $query->bindValue(6,$registroAsistencia->getNJustificacionesRealizadas());
                }

                if(empty($registroAsistencia->getFechaEmision())){
                    $query->bindValue(7,'NULL',PDO::PARAM_NULL);
                }
                else{
                    $query->bindValue(7,$registroAsistencia->getFechaEmision());
                }

                $query->execute();

            }
            
            catch(PDOException $e){
                throw $e;
                exit;
            }
        }   


        public function actualizar(RegistroAsistencias $registroAsistencia){
            try{
                
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_registro_asistencias_actualizar(?,?,?,?,?,?,?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$registroAsistencia->getDocenteId());
                $query->bindValue(2,$registroAsistencia->getEstudianteId());
                $query->bindValue(3,$registroAsistencia->getCursoId());
                $query->bindValue(4,$registroAsistencia->getSalonClases());

                if(empty($registroAsistencia->getNAsistenciasRealizadas())){
                    $query->bindValue(5,'NULL',PDO::PARAM_NULL);
                }
                else{
                    $query->bindValue(5,$registroAsistencia->getNAsistenciasRealizadas());
                }

                if(empty($registroAsistencia->getNJustificacionesRealizadas())){
                    $query->bindValue(6,'NULL',PDO::PARAM_NULL);
                }
                else{
                    $query->bindValue(6,$registroAsistencia->getNJustificacionesRealizadas());
                }

                if(empty($registroAsistencia->getFechaEmision())){
                    $query->bindValue(7,'NULL',PDO::PARAM_NULL);
                }
                else{
                    $query->bindValue(7,$registroAsistencia->getFechaEmision());
                }

                $query->execute();

            }
            
            catch(PDOException $e){
                throw $e;
                exit;
            }
            
        }

        public function buscarPorIdEstudiante($estudianteId){
            try{
                
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_registro_asistencias_buscar_por_id_de_estudiante(?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$estudianteId);
                
                $query->setFetchMode(PDO::FETCH_ASSOC);
                $query->execute();

                $matrizRegistroAsistencias = array();

                while($row = $query->fetch()){
                    $estudiante = new Estudiante();
                    $docente = new Docente();
                    $curso = new Curso();
                    $registroAsistencia = new RegistroAsistencias();

                    $estudiante->setNombreCompleto($row["estudiante"]);
                    $docente->setNombreCompleto($row["docente"]);
                    $curso->setNombre($row["curso"]);

                    $registroAsistencia->construirObjeto($row["docente_id"],$row["estudiante_id"],$row["curso_id"],
                    $row["salon_clases"],$row["asistencias"],$row["justificaciones"],$row["emision"]);

                    $registrosAsistenciaListados = array();

                    $registrosAsistenciaListados[] = $estudiante;
                    $registrosAsistenciaListados[] = $docente;
                    $registrosAsistenciaListados[] = $curso;
                    $registrosAsistenciaListados[] = $registroAsistencia;

                    $matrizRegistroAsistencias[] = $registrosAsistenciaListados;
                }

                return $matrizRegistroAsistencias;
            }
            
            catch(PDOException $e){
                throw $e;
                exit;
            }
        }

        public function buscarPorDNIEstudiante($dniEstudiante,$cursoId){
            try{
                
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_registro_asistencias_buscar_por_dni_de_estudiante(?,?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$dniEstudiante);
                $query->bindValue(2,$cursoId);
                
                $query->setFetchMode(PDO::FETCH_ASSOC);
                $query->execute();

                $matrizRegistroAsistencias = array();

                while($row = $query->fetch()){
                    $estudiante = new Estudiante();
                    $docente = new Docente();
                    $curso = new Curso();
                    $registroAsistencia = new RegistroAsistencias();

                    $estudiante->setNombreCompleto($row["estudiante"]);
                    $docente->setNombreCompleto($row["docente"]);
                    $curso->setNombre($row["curso"]);

                    $registroAsistencia->construirObjeto($row["docente_id"],$row["estudiante_id"],$row["curso_id"],
                    $row["salon_clases"],$row["asistencias"],$row["justificaciones"],$row["emision"]);

                    $registrosAsistenciaListados = array();

                    $registrosAsistenciaListados[] = $estudiante;
                    $registrosAsistenciaListados[] = $docente;
                    $registrosAsistenciaListados[] = $curso;
                    $registrosAsistenciaListados[] = $registroAsistencia;

                    $matrizRegistroAsistencias[] = $registrosAsistenciaListados;
                }

                return $matrizRegistroAsistencias;
            }
            
            catch(PDOException $e){
                throw $e;
                exit;
            }
        }

        public function buscarParaDocente($dniDocente, $cursoId){
            try{
                
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_registro_asistencias_buscar_para_docente(?,?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$dniDocente);
                $query->bindValue(2,$cursoId);
                
                $query->setFetchMode(PDO::FETCH_ASSOC);
                $query->execute();

                $matrizRegistroAsistencias = array();

                while($row = $query->fetch()){
                    $estudiante = new Estudiante();
                    $docente = new Docente();
                    $curso = new Curso();
                    $registroAsistencia = new RegistroAsistencias();

                    $estudiante->setNombreCompleto($row["estudiante"]);
                    $docente->setNombreCompleto($row["docente"]);
                    $curso->setNombre($row["curso"]);

                    $registroAsistencia->construirObjeto($row["docente_id"],$row["estudiante_id"],$row["curso_id"],
                    $row["salon_clases"],$row["asistencias"],$row["justificaciones"],$row["emision"]);

                    $registrosAsistenciaListados = array();

                    $registrosAsistenciaListados[] = $estudiante;
                    $registrosAsistenciaListados[] = $docente;
                    $registrosAsistenciaListados[] = $curso;
                    $registrosAsistenciaListados[] = $registroAsistencia;

                    $matrizRegistroAsistencias[] = $registrosAsistenciaListados;
                }

                return $matrizRegistroAsistencias;
            }
            
            catch(PDOException $e){
                throw $e;
                exit;
            }
        }
        
        public function buscarRegistroEspecifico($estudianteId, $docenteId, $cursoId){
            try{
                
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_registro_asistencias_buscar_registro_especifico(?,?,?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$estudianteId);
                $query->bindValue(2,$docenteId);
                $query->bindValue(3,$cursoId);
                
                $query->setFetchMode(PDO::FETCH_ASSOC);
                $query->execute();

                $registrosAsistenciaListados = array();

                while($row = $query->fetch()){
                    $estudiante = new Estudiante();
                    $docente = new Docente();
                    $curso = new Curso();
                    $registroAsistencia = new RegistroAsistencias();

                    $estudiante->setNombreCompleto($row["estudiante"]);
                    $docente->setNombreCompleto($row["docente"]);
                    $curso->setNombre($row["curso"]);

                    $registroAsistencia->construirObjeto($row["docente_id"],$row["estudiante_id"],$row["curso_id"],
                    $row["salon_clases"],$row["asistencias"],$row["justificaciones"],$row["emision"]);

                    $registrosAsistenciaListados[] = $estudiante;
                    $registrosAsistenciaListados[] = $docente;
                    $registrosAsistenciaListados[] = $curso;
                    $registrosAsistenciaListados[] = $registroAsistencia;
                }

                return $registrosAsistenciaListados;
            }
            
            catch(PDOException $e){
                throw $e;
                exit;
            }
        }

        public function eliminar(RegistroAsistencias $registroAsistencia){
            try{
                
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_registro_asistencias_eliminar(?,?,?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$registroAsistencia->getDocenteId());
                $query->bindValue(2,$registroAsistencia->getEstudianteId());
                $query->bindValue(3,$registroAsistencia->getCursoId());

                $query->execute();
            }
            
            catch(PDOException $e){
                throw $e;
                exit;
            }
        }
    }