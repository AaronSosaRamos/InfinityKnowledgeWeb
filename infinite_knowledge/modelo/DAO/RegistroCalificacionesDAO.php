<?php

    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/RegistroCalificaciones.php');

    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/Estudiante.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/Docente.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/DTO/Curso.php');

    require_once($_SERVER['DOCUMENT_ROOT'].'/infinite_knowledge/modelo/Conexion/Conexion.php');

    class RegistroCalificacionesDAO{
        public function insertar(RegistroCalificaciones $registroCalificaciones){
            try{
                
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_registro_calificaciones_insertar(?,?,?,?,?,?,?,?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$registroCalificaciones->getDocenteId());
                $query->bindValue(2,$registroCalificaciones->getEstudianteId());
                $query->bindValue(3,$registroCalificaciones->getCursoId());
                $query->bindValue(4,$registroCalificaciones->getSalonClases());

                if(empty($registroCalificaciones->getCalif1())){
                    $query->bindValue(5,'NULL',PDO::PARAM_NULL);
                }
                else{
                    $query->bindValue(5,$registroCalificaciones->getCalif1());
                }

                if(empty($registroCalificaciones->getCalif2())){
                    $query->bindValue(6,'NULL',PDO::PARAM_NULL);
                }
                else{
                    $query->bindValue(6,$registroCalificaciones->getCalif2());
                }

                if(empty($registroCalificaciones->getCalif3())){
                    $query->bindValue(7,'NULL',PDO::PARAM_NULL);
                }
                else{
                    $query->bindValue(7,$registroCalificaciones->getCalif3());
                }

                if(empty($registroCalificaciones->getFechaEmision())){
                    $query->bindValue(8,'NULL',PDO::PARAM_NULL);
                }
                else{
                    $query->bindValue(8,$registroCalificaciones->getFechaEmision());
                }
                
                $query->execute();

            }
            
            catch(PDOException $e){
                throw $e;
                exit;
            }
            
        }

        public function actualizar(RegistroCalificaciones $registroCalificaciones){
            try{
                
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_registro_calificaciones_actualizar(?,?,?,?,?,?,?,?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$registroCalificaciones->getDocenteId());
                $query->bindValue(2,$registroCalificaciones->getEstudianteId());
                $query->bindValue(3,$registroCalificaciones->getCursoId());
                $query->bindValue(4,$registroCalificaciones->getSalonClases());

                if(empty($registroCalificaciones->getCalif1())){
                    $query->bindValue(5,'NULL',PDO::PARAM_NULL);
                }
                else{
                    $query->bindValue(5,$registroCalificaciones->getCalif1());
                }

                if(empty($registroCalificaciones->getCalif2())){
                    $query->bindValue(6,'NULL',PDO::PARAM_NULL);
                }
                else{
                    $query->bindValue(6,$registroCalificaciones->getCalif2());
                }

                if(empty($registroCalificaciones->getCalif3())){
                    $query->bindValue(7,'NULL',PDO::PARAM_NULL);
                }
                else{
                    $query->bindValue(7,$registroCalificaciones->getCalif3());
                }

                if(empty($registroCalificaciones->getFechaEmision())){
                    $query->bindValue(8,'NULL',PDO::PARAM_NULL);
                }
                else{
                    $query->bindValue(8,$registroCalificaciones->getFechaEmision());
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
                $sql = "CALL sp_registro_calificaciones_buscar_por_id_de_estudiante(?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$estudianteId);
                
                $query->setFetchMode(PDO::FETCH_ASSOC);
                $query->execute();

                $matrizRegistroCalificaciones = array();

                while($row = $query->fetch()){
                    $estudiante = new Estudiante();
                    $docente = new Docente();
                    $curso = new Curso();
                    $registroCalificaciones = new RegistroCalificaciones();

                    $estudiante->setNombreCompleto($row["estudiante"]);
                    $docente->setNombreCompleto($row["docente"]);
                    $curso->setNombre($row["curso"]);

                    $registroCalificaciones->construirObjeto(NULL,NULL,NULL,
                    $row["salon_clases"],$row["calif1"],$row["calif2"],$row["calif3"],$row["emision"]);

                    $registroCalificacionesListados = array();

                    $registroCalificacionesListados[] = $estudiante;
                    $registroCalificacionesListados[] = $docente;
                    $registroCalificacionesListados[] = $curso;
                    $registroCalificacionesListados[] = $registroCalificaciones;

                    $matrizRegistroCalificaciones[] = $registroCalificacionesListados;
                }
            }
            
            catch(PDOException $e){
                throw $e;
                exit;
            }
        }

        public function buscarPorDNIEstudiante($dniEstudiante,$cursoId){
            try{
                
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_registro_calificaciones_buscar_por_dni_de_estudiante(?,?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$dniEstudiante);
                $query->bindValue(2,$cursoId);
                
                $query->setFetchMode(PDO::FETCH_ASSOC);
                $query->execute();

                $matrizRegistroCalificaciones = array();

                while($row = $query->fetch()){
                    $estudiante = new Estudiante();
                    $docente = new Docente();
                    $curso = new Curso();
                    $registroCalificaciones = new RegistroCalificaciones();

                    $estudiante->setNombreCompleto($row["estudiante"]);
                    $docente->setNombreCompleto($row["docente"]);
                    $curso->setNombre($row["curso"]);

                    $registroCalificaciones->construirObjeto(NULL,NULL,NULL,
                    $row["salon_clases"],$row["calif1"],$row["calif2"],$row["calif3"],$row["emision"]);

                    $registroCalificacionesListados = array();

                    $registroCalificacionesListados[] = $estudiante;
                    $registroCalificacionesListados[] = $docente;
                    $registroCalificacionesListados[] = $curso;
                    $registroCalificacionesListados[] = $registroCalificaciones;

                    $matrizRegistroCalificaciones[] = $registroCalificacionesListados;
                }

                return $matrizRegistroCalificaciones;
            }
            
            catch(PDOException $e){
                throw $e;
                exit;
            }
        }

        public function buscarParaDocente($dniDocente, $cursoId){
            try{
                
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_registro_calificaciones_buscar_para_docente(?,?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$dniDocente);
                $query->bindValue(2,$cursoId);
                
                $query->setFetchMode(PDO::FETCH_ASSOC);
                $query->execute();

                $matrizRegistroCalificaciones = array();

                while($row = $query->fetch()){
                    $estudiante = new Estudiante();
                    $docente = new Docente();
                    $curso = new Curso();
                    $registroCalificaciones = new RegistroCalificaciones();

                    $estudiante->setNombreCompleto($row["estudiante"]);
                    $docente->setNombreCompleto($row["docente"]);
                    $curso->setNombre($row["curso"]);

                    $registroCalificaciones->construirObjeto($row["docente_id"],$row["estudiante_id"],$row["curso_id"],
                    $row["salon_clases"],$row["calif1"],$row["calif2"],$row["calif3"],$row["emision"]);

                    $registroCalificacionesListados = array();

                    $registroCalificacionesListados[] = $estudiante;
                    $registroCalificacionesListados[] = $docente;
                    $registroCalificacionesListados[] = $curso;
                    $registroCalificacionesListados[] = $registroCalificaciones;

                    $matrizRegistroCalificaciones[] = $registroCalificacionesListados;
                }
                return $matrizRegistroCalificaciones;
            }
            
            catch(PDOException $e){
                throw $e;
                exit;
            }
        }

        public function buscarRegistroEspecifico($estudianteId, $docenteId, $cursoId){
            try{
                
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_registro_calificaciones_buscar_registro_especifico(?,?,?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$estudianteId);
                $query->bindValue(2,$docenteId);
                $query->bindValue(3,$cursoId);
                
                $query->setFetchMode(PDO::FETCH_ASSOC);
                $query->execute();

                $registroCalificacionesListados = array();

                while($row = $query->fetch()){
                    $estudiante = new Estudiante();
                    $docente = new Docente();
                    $curso = new Curso();
                    $registroCalificaciones = new RegistroCalificaciones();

                    $estudiante->setNombreCompleto($row["estudiante"]);
                    $docente->setNombreCompleto($row["docente"]);
                    $curso->setNombre($row["curso"]);

                    $registroCalificaciones->construirObjeto($docenteId,$estudianteId,$cursoId,
                    $row["salon_clases"],$row["calif1"],$row["calif2"],$row["calif3"],$row["emision"]);

                    $registroCalificacionesListados[] = $estudiante;
                    $registroCalificacionesListados[] = $docente;
                    $registroCalificacionesListados[] = $curso;
                    $registroCalificacionesListados[] = $registroCalificaciones;

                }
                return $registroCalificacionesListados;
            }
            
            catch(PDOException $e){
                throw $e;
                exit;
            }
        }

        public function eliminar(RegistroCalificaciones $registroCalificaciones){
            try{
                
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_registro_calificaciones_eliminar(?,?,?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$registroCalificaciones->getDocenteId());
                $query->bindValue(2,$registroCalificaciones->getEstudianteId());
                $query->bindValue(3,$registroCalificaciones->getCursoId());

                $query->execute();
            }
            
            catch(PDOException $e){
                throw $e;
                exit;
            }
        }
 }
    