<?php 
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\UsuarioController;

$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/', [UsuarioController::class,'index']);
$router->post('/API/usuarios/registrar', [UsuarioController::class,'registroAPI']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
