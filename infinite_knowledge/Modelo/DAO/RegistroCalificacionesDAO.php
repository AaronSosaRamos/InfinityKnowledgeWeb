<?php

    require_once('../DTO/RegistroCalificaciones.php');

    require_once('../DTO/Estudiante.php');
    require_once('../DTO/Docente.php');
    require_once('../DTO/Curso.php');

    require_once('../Conexion/Conexion.php');

    class RegistroCalificacionesDAO{
        public function insertar(RegistroCalificaciones $calificaciones){
            try{
                
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_registro_calificaciones_insertar(?,?,?,?,?,?,?,?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$calificaciones->getDocenteId());
                $query->bindValue(2,$calificaciones->getEstudianteId());
                $query->bindValue(3,$calificaciones->getCursoId());
                $query->bindValue(4,$calificaciones->getSalonClases());
                $query->bindValue(5,$calificaciones->getCalif1());
                $query->bindValue(6,$calificaciones->getCalif2());
                $query->bindValue(7,$calificaciones->getCalif3());
                $query->bindValue(8,$calificaciones->getFechaEmision());

                $query->execute();

            }
            
            catch(PDOException $e){
                throw $e;
                exit;
            }
            
        }

        public function actualizar(RegistroCalificaciones $calificaciones){
            try{
                
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_registro_calificaciones_actualizar(?,?,?,?,?,?,?,?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$calificaciones->getDocenteId());
                $query->bindValue(2,$calificaciones->getEstudianteId());
                $query->bindValue(3,$calificaciones->getCursoId());
                $query->bindValue(4,$calificaciones->getSalonClases());
                $query->bindValue(5,$calificaciones->getCalif1());
                $query->bindValue(6,$calificaciones->getCalif2());
                $query->bindValue(7,$calificaciones->getCalif3());
                $query->bindValue(8,$calificaciones->getFechaEmision());

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

                $matrizObjetos = array();

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

                    $listaObjetos = array();

                    $listaObjetos[] = $estudiante;
                    $listaObjetos[] = $docente;
                    $listaObjetos[] = $curso;
                    $listaObjetos[] = $registroCalificaciones;

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
                $sql = "CALL sp_registro_calificaciones_buscar_por_dni_de_estudiante(?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$dniEstudiante);
                
                $query->setFetchMode(PDO::FETCH_ASSOC);
                $query->execute();

                $matrizObjetos = array();

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

                    $listaObjetos = array();

                    $listaObjetos[] = $estudiante;
                    $listaObjetos[] = $docente;
                    $listaObjetos[] = $curso;
                    $listaObjetos[] = $registroCalificaciones;

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
                $sql = "CALL sp_registro_calificaciones_buscar_para_docente(?,?)";
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
                    $registroCalificaciones = new RegistroCalificaciones();

                    $estudiante->setNombreCompleto($row["estudiante"]);
                    $docente->setNombreCompleto($row["docente"]);
                    $curso->setNombre($row["curso"]);

                    $registroCalificaciones->construirObjeto(NULL,NULL,NULL,
                    $row["salon_clases"],$row["calif1"],$row["calif2"],$row["calif3"],$row["emision"]);

                    $listaObjetos = array();

                    $listaObjetos[] = $estudiante;
                    $listaObjetos[] = $docente;
                    $listaObjetos[] = $curso;
                    $listaObjetos[] = $registroCalificaciones;

                    $matrizObjetos[] = $listaObjetos;
                }
            }
            
            catch(PDOException $e){
                throw $e;
                exit;
            }
        }

        public function eliminar(RegistroCalificaciones $calificaciones){
            try{
                
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_registro_calificaciones_eliminar(?,?,?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$calificaciones->getDocenteId());
                $query->bindValue(2,$calificaciones->getEstudianteId());
                $query->bindValue(3,$calificaciones->getCursoId());

                $query->execute();
            }
            
            catch(PDOException $e){
                throw $e;
                exit;
            }
        }
 }
    