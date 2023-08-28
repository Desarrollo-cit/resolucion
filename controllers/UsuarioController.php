<?php

namespace Controllers;

use Exception;
use Model\Usuario;
use MVC\Router;


class UsuarioController {
    public static function index(Router $router){
        $router->render('registro/index', []);
    }

    public static function registroAPI(){
        getHeadersApi();

        try {
            
            $usuario = new Usuario($_POST);
            
            $comprobacion = Usuario::where('usu_catalogo', $usuario->usu_catalogo);

            if(count($comprobacion) < 1){
                $opciones = [
                    'cost' => 11,
                ];
                $usuario->usu_password = password_hash($usuario->usu_password, PASSWORD_DEFAULT, $opciones);
                
                $resultado = $usuario->crear();

                if($resultado['resultado'] == 1){
                    echo json_encode([     
                        "mensaje" => "Usuario registrado correctamente, espere a ser activado",
                        "codigo" => 1,
                    ]);
                }else{
                    echo json_encode([ 
                        "mensaje" => "Ocurrió un error al registrar el usuario",
                        "codigo" => 0,
                    ]);
                }

            }else{
                echo json_encode([     
                    "mensaje" => "El registro ya existe",
                    "codigo" => 2,
                ]);
            }
            

        } catch (Exception $e) {
            echo json_encode([
                "detalle" => $e->getMessage(),       
                "mensaje" => "Ocurrió un error en base de datos",
                "codigo" => 0,
            ]);

        }
    }

}