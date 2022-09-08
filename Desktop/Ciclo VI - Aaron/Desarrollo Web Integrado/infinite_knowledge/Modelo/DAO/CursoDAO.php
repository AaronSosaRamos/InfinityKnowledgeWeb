<?php
    require_once('../DTO/Curso.php');
    require_once('../Conexion/Conexion.php');

    class CursoDAO{

        //------------------Insertar curso-----------------------
        public function insertar(Curso $curso){
            try{

                $conexion = Conexion::getConexion();
                $sql = "CALL sp_curso_insertar(?,?,?,?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$curso->getNombre());
                $query->bindValue(2,$curso->getNHoras());
                $query->bindValue(3,$curso->getDificultadCursoId());
                $query->bindValue(4,$curso->getEnfoqueCursoId());

                $query->execute();

            }

            catch(PDOException $e){

                if(str_contains($e->getMessage(),'idx_curso_nombre')){
                    throw new Exception("El nombre del curso ingresado ya existe en el sistema");
                }

                throw $e;
                exit;

            }
        }
        //-----------------------------------------------------

        //------------------Buscar curso por Id-----------------------
        public function buscarPorId($idCurso){
            try{

                $conexion = Conexion::getConexion();
                $sql = "CALL sp_curso_buscar_por_id(?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$idCurso);

                $query->setFetchMode(PDO::FETCH_ASSOC);
                $query->execute();

                $cursosListados = array();

                while($row = $query->fetch()){
                    $curso = new Curso();
                    $curso -> construirObjeto($row["curso_id"],$row["nombre"],$row["n_horas"],$row["dificultad_curso"],$row["enfoque_curso"]);
                
                    $cursosListados[] = $curso;
                }

            }

            catch(PDOException $e){

                throw $e;
                exit;

            }
        }
        //-----------------------------------------------------

        //------------------Buscar curso por Nombre-----------------------
        public function buscarPorNombre($nombre){
            try{

                $conexion = Conexion::getConexion();
                $sql = "CALL sp_curso_buscar_por_nombre(?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$nombre);

                $query->setFetchMode(PDO::FETCH_ASSOC);
                $query->execute();

                $cursosListados = array();

                while($row = $query->fetch()){
                    $curso = new Curso();
                    $curso -> construirObjeto($row["curso_id"],$row["nombre"],$row["n_horas"],$row["dificultad_curso"],$row["enfoque_curso"]);
                
                    $cursosListados[] = $curso;
                }

            }

            catch(PDOException $e){

                throw $e;
                exit;

            }
        }
        //-----------------------------------------------------

        //------------------Buscar curso por Enfoque-----------------------
        public function buscarPorEnfoque($idEnfoque){
            try{

                $conexion = Conexion::getConexion();
                $sql = "CALL sp_curso_buscar_por_enfoque(?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$idEnfoque);

                $query->setFetchMode(PDO::FETCH_ASSOC);
                $query->execute();

                $cursosListados = array();

                while($row = $query->fetch()){
                    $curso = new Curso();
                    $curso -> construirObjeto($row["curso_id"],$row["nombre"],$row["n_horas"],$row["dificultad_curso"],$row["enfoque_curso"]);
                
                    $cursosListados[] = $curso;
                }

            }

            catch(PDOException $e){

                throw $e;
                exit;

            }
        }
        //-----------------------------------------------------
        
        //------------------Buscar curso por Dificultad-----------------------
        public function buscarPorDificultad($idDificultad){
            try{

                $conexion = Conexion::getConexion();
                $sql = "CALL sp_curso_buscar_por_dificultad(?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$idDificultad);

                $query->setFetchMode(PDO::FETCH_ASSOC);
                $query->execute();

                $cursosListados = array();

                while($row = $query->fetch()){
                    $curso = new Curso();
                    $curso -> construirObjeto($row["curso_id"],$row["nombre"],$row["n_horas"],$row["dificultad_curso"],$row["enfoque_curso"]);
                
                    $cursosListados[] = $curso;
                }

            }

            catch(PDOException $e){

                throw $e;
                exit;

            }
        }
        //-----------------------------------------------------

        //------------------Listar cursos-----------------------
        public function listar(){
            try{

                $conexion = Conexion::getConexion();
                $sql = "CALL sp_curso_listar()";
                $query = $conexion->prepare($sql);

                $query->setFetchMode(PDO::FETCH_ASSOC);
                $query->execute();

                $cursosListados = array();

                while($row = $query->fetch()){
                    $curso = new Curso();
                    $curso -> construirObjeto($row["curso_id"],$row["nombre"],$row["n_horas"],$row["dificultad_curso"],$row["enfoque_curso"]);
                
                    $cursosListados[] = $curso;
                }

            }

            catch(PDOException $e){

                throw $e;
                exit;

            }
        }
        //-----------------------------------------------------
        
        //------------------Listar nombres de cursos por DNI de estudiante-----------------------
        public function listarNombresPorDNIEstudiante($dniEstudiante){
            try{

                $conexion = Conexion::getConexion();
                $sql = "CALL sp_curso_listar_nombres_por_dni_estudiante(?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$dniEstudiante);

                $query->setFetchMode(PDO::FETCH_ASSOC);
                $query->execute();

                $cursosListados = array();

                while($row = $query->fetch()){
                    $curso = new Curso();
                    $curso -> construirObjeto($row["curso_id"],$row["nombre"],NULL,NULL,NULL);
                
                    $cursosListados[] = $curso;
                }

            }

            catch(PDOException $e){

                throw $e;
                exit;

            }
        }
        //-----------------------------------------------------

        //------------------Listar nombres de cursos por DNI de docente-----------------------
        public function listarNombresPorDNIDocente($dniDocente){
            try{

                $conexion = Conexion::getConexion();
                $sql = "CALL sp_curso_listar_nombres_por_dni_docente(?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$dniDocente);

                $query->setFetchMode(PDO::FETCH_ASSOC);
                $query->execute();

                $cursosListados = array();

                while($row = $query->fetch()){
                    $curso = new Curso();
                    $curso -> construirObjeto($row["curso_id"],$row["nombre"],NULL,NULL,NULL);
                
                    $cursosListados[] = $curso;
                }

            }

            catch(PDOException $e){

                throw $e;
                exit;

            }
        }
        //-----------------------------------------------------

        //------------------Eliminar curso-----------------------
        public function eliminar($idCurso){
            try{

                $conexion = Conexion::getConexion();
                $sql = "CALL sp_curso_eliminar(?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$idCurso);

                $query->execute();

            }

            catch(PDOException $e){

                throw $e;
                exit;

            }
        }
        //-----------------------------------------------------

        //------------------Actualizar curso-----------------------
        public function actualizar(Curso $curso){
            try{

                $conexion = Conexion::getConexion();
                $sql = "CALL sp_curso_actualizar(?,?,?,?,?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$curso->getCursoId());
                $query->bindValue(2,$curso->getNombre());
                $query->bindValue(3,$curso->getNHoras());
                $query->bindValue(4,$curso->getDificultadCursoId());
                $query->bindValue(5,$curso->getEnfoqueCursoId());

                $query->execute();

            }

            catch(PDOException $e){

                throw $e;
                exit;

            }
        }
        //-----------------------------------------------------
    }   
?>