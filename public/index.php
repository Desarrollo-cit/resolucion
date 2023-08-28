<?php 
require_once __DIR__ . '/../includes/app.php';

use Controllers\AdminController;
use MVC\Router;
use Controllers\UsuarioController;

$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/', [UsuarioController::class,'index']);
$router->post('/API/usuarios/registrar', [UsuarioController::class,'registroAPI']);
$router->get('/usuarios', [AdminController::class,'usuarios']);
$router->get('/API/admin/usuarios', [AdminController::class,'detalleAPI']);
$router->get('/API/admin/roles', [AdminController::class,'rolesAPI']);
$router->post('/API/admin/modificar/rol', [AdminController::class,'modificarRolAPI']);
$router->post('/API/admin/activar-desactivar', [AdminController::class,'activarDesactivarAPI']);
$router->post('/API/admin/modificar/password', [AdminController::class,'modificarPasswordAPI']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
