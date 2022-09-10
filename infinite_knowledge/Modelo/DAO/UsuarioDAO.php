<?php

    require_once('../DTO/Usuario.php');
    require_once('../Conexion/Conexion.php');

    class UsuarioDAO{
        public function insertar(Usuario $usuario){
            try{
                
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_usuario_insertar(?,?,?,?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$usuario->getDni());
                $query->bindValue(2,$usuario->getCorreoElectronico());
                $query->bindValue(3,$usuario->getContrasenia());
                $query->bindValue(4,$usuario->getRol());

                $query->execute();

            }
            
            catch(PDOException $e){
                if(str_contains($e->getMessage(),'idx_usuario_dni')){
                    throw new Exception("El dni del usuario ingresado ya existe en el sistema");
                }

                throw $e;
                exit;
            }
        }

        public function actualizar(Usuario $usuario){
            try{
                
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_usuario_actualizar(?,?,?,?,?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$usuario->getUsuarioId());
                $query->bindValue(2,$usuario->getDni());
                $query->bindValue(3,$usuario->getCorreoElectronico());
                $query->bindValue(4,$usuario->getContrasenia());
                $query->bindValue(5,$usuario->getRol());

                
                $query->execute();
            }
            
            catch(PDOException $e){
                if(str_contains($e->getMessage(),'idx_usuario_dni')){
                    throw new Exception("El dni del estudiante ingresado ya existe en el sistema");
                }

            
                throw $e;
                exit;
            }
        }

        public function eliminar($usuarioId){
            try{
                
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_usuario_eliminar(?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$usuarioId);
                
                $query->execute();
            }
            
            catch(PDOException $e){
                throw $e;
                exit;
            }
        }

        public function realizarInicioSesion($correoElectronico,$contrasenia){
            try{
                
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_usuario_realizar_inicio_de_sesión(?,?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$correoElectronico);
                $query->bindValue(2,$contrasenia);

                $query->setFetchMode(PDO::FETCH_ASSOC);
                $query->execute();

                $usuariosListados = array();

                while($row = $query->fetch()){
                    $usuario = new Usuario();

                    $usuario->construirObjeto($row["usuario_id"],$row["dni"],$correoElectronico,$contrasenia,
                    $row["rol"]);
                    
                    $usuariosListados[] = $usuario;
                }
            }
            
            catch(PDOException $e){
                throw $e;
                exit;
            }
        }

        public function contarUsuarioPorRol($rol){
            try{
                
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_usuario_contar_usuarios_por_rol(?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$rol);
                
                $query->setFetchMode(PDO::FETCH_ASSOC);
                $query->execute();

                $conteoListado = array();
                while($row = $query->fetch()){
                    $conteoListado[] = $row["cantidad"],
                }
            }
            
            catch(PDOException $e){
                throw $e;
                exit;
            }
        }

        public function buscarCorreoPorDNI($dni){
            try{
                
                $conexion = Conexion::getConexion();
                $sql = "CALL sp_usuario_buscar_correo_por_dni(?)";
                $query = $conexion->prepare($sql);

                $query->bindValue(1,$dni);
                
                $query->setFetchMode(PDO::FETCH_ASSOC);
                $query->execute();

                $correoListado = array();

                while($row = $query->fetch()){
                    $correoListado[] = $row["correo_electronico"];
                }
            }
            
            catch(PDOException $e){
                throw $e;
                exit;
            }
        }

    }
?>
