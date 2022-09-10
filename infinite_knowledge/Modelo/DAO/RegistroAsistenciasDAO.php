<?php

    require_once('../DTO/RegistroAsistencias.php');

    require_once('../DTO/Estudiante.php');
    require_once('../DTO/Docente.php');
    require_once('../DTO/Curso.php');

    require_once('../Conexion/Conexion.php');


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
                $query->bindValue(5,$registroAsistencia->getNAsistenciasRealizadas());
                $query->bindValue(6,$registroAsistencia->getNJustificacionesRealizadas());
                $query->bindValue(7,$registroAsistencia->getFechaEmision());

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
                $query->bindValue(5,$registroAsistencia->getNAsistenciasRealizadas());
                $query->bindValue(6,$registroAsistencia->getNJustificacionesRealizadas());
                $query->bindValue(7,$registroAsistencia->getFechaEmision());

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

                $matrizObjetos = array();

                while($row = $query->fetch()){
                    $estudiante = new Estudiante();
                    $docente = new Docente();
                    $curso = new Curso();
                    $registroAsistencia = new RegistroAsistencias();

                    $estudiante->setNombreCompleto($row["estudiante"]);
                    $docente->setNombreCompleto($row["docente"]);
                    $curso->setNombre($row["curso"]);

                    $registroAsistencia->construirObjeto(NULL,NULL,NULL,
                    $row["salon_clases"],$row["asistencias"],$row["justificaciones"],$row["emision"]);

                    $listaObjetos = array();

                    $listaObjetos[] = $estudiante;
                    $listaObjetos[] = $docente;
                    $listaObjetos[] = $curso;
                    $listaObjetos[] = $registroAsistencia;

                    $matrizObjetos[] = $listaObjetos;
                }
            }
            
            catch(PDOException $e){
                throw $e;
                exit;
            }
        }

        public function buscarPorDNIEstudiante($dniEstudiante){
            try{
                
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_registro_asistencias_buscar_por_dni_de_estudiante(?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$dniEstudiante);
                
                $query->setFetchMode(PDO::FETCH_ASSOC);
                $query->execute();

                $matrizObjetos = array();

                while($row = $query->fetch()){
                    $estudiante = new Estudiante();
                    $docente = new Docente();
                    $curso = new Curso();
                    $registroAsistencia = new RegistroAsistencias();

                    $estudiante->setNombreCompleto($row["estudiante"]);
                    $docente->setNombreCompleto($row["docente"]);
                    $curso->setNombre($row["curso"]);

                    $registroAsistencia->construirObjeto(NULL,NULL,NULL,
                    $row["salon_clases"],$row["asistencias"],$row["justificaciones"],$row["emision"]);

                    $listaObjetos = array();

                    $listaObjetos[] = $estudiante;
                    $listaObjetos[] = $docente;
                    $listaObjetos[] = $curso;
                    $listaObjetos[] = $registroAsistencia;

                    $matrizObjetos[] = $listaObjetos;
                }
            }
            
            catch(PDOException $e){
                throw $e;
                exit;
            }
        }

        public function buscarParaDocente($dniDocente, $cursoId){
            try{
                
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_registro_asistencias_buscar_por_dni_de_estudiante(?,?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$dniDocente);
                $query->bindValue(2,$cursoId);
                
                $query->setFetchMode(PDO::FETCH_ASSOC);
                $query->execute();

                $matrizObjetos = array();

                while($row = $query->fetch()){
                    $estudiante = new Estudiante();
                    $docente = new Docente();
                    $curso = new Curso();
                    $registroAsistencia = new RegistroAsistencias();

                    $estudiante->setNombreCompleto($row["estudiante"]);
                    $docente->setNombreCompleto($row["docente"]);
                    $curso->setNombre($row["curso"]);

                    $registroAsistencia->construirObjeto(NULL,NULL,NULL,
                    $row["salon_clases"],$row["asistencias"],$row["justificaciones"],$row["emision"]);

                    $listaObjetos = array();

                    $listaObjetos[] = $estudiante;
                    $listaObjetos[] = $docente;
                    $listaObjetos[] = $curso;
                    $listaObjetos[] = $registroAsistencia;

                    $matrizObjetos[] = $listaObjetos;
                }
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