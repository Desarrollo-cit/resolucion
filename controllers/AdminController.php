<?php

namespace Controllers;

use Exception;
use Model\Asignacion;
use Model\Rol;
use Model\Usuario;
use MVC\Router;


class AdminController {
    public static function usuarios(Router $router){
        $router->render('admin/usuarios', []);
    }

    public static function detalleAPI(){

        $sql = "SELECT usu_id, asi_id, usu_catalogo as catalogo, usu_situacion as estado, asi_rol as rol from usuario left join asignacion on asi_usuario =  usu_id";

        try {
            
            $usuarios = Usuario::fetchArray($sql);
    
            echo json_encode($usuarios);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
    public static function rolesAPI(){

        try {
            
            $roles = Rol::where('rol_situacion', '1');
    
            echo json_encode($roles);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
    public static function modificarRolAPI(){

        try {
            
            $asignacion = new Asignacion($_POST);
            $resultado = $asignacion->guardar();

            if($resultado['resultado'] == 1){
                echo json_encode([     
                    "mensaje" => "Rol modificado exitosamente",
                    "codigo" => 1,
                ]);
            }else{
                echo json_encode([ 
                    "mensaje" => "Ocurrió un error al modificar rol",
                    "codigo" => 0,
                ]);
            }
            
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
    public static function activarDesactivarAPI(){

        try {
            
            $usuario = Usuario::find($_POST['id']);
            if($usuario->usu_situacion == 1 || $usuario->usu_situacion == 0 ){
                $usuario->usu_situacion = 2;
            }else{
                $usuario->usu_situacion = 0;

            }
            $resultado = $usuario->actualizar();

            if($resultado['resultado'] == 1){
                echo json_encode([     
                    "mensaje" => "Estado modificado exitosamente",
                    "codigo" => 1,
                ]);
            }else{
                echo json_encode([ 
                    "mensaje" => "Ocurrió un error al modificar estado",
                    "codigo" => 0,
                ]);
            }

            
            
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
    public static function modificarPasswordAPI(){

        try {
            
            $usuario = Usuario::find($_POST['usu_id']); 
            $opciones = [
                'cost' => 11,
            ];
            $usuario->usu_password = password_hash($usuario->usu_password, PASSWORD_DEFAULT, $opciones);
            $resultado = $usuario->actualizar();

            if($resultado['resultado'] == 1){
                echo json_encode([     
                    "mensaje" => "Contraseña modificado exitosamente",
                    "codigo" => 1,
                ]);
            }else{
                echo json_encode([ 
                    "mensaje" => "Ocurrió un error al modificar contraseña",
                    "codigo" => 0,
                ]);
            }

            
            
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
}