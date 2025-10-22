<?php

require_once 'config.php';
require_once 'app/controllers/CancionesController.php';
require_once 'app/controllers/AlbumesController.php';

require_once 'app/controllers/AuthController.php';
require_once 'app/middlewares/session.middleware.php';
require_once 'app/middlewares/guard.middleware.php';


session_start();


define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'inicio';

if(!empty($_GET['action'])){
    $action = $_GET['action'];
}

$params = explode('/', $action);

$request = new StdClass();
$request = (new SessionMiddleware())->run($request);


switch($params[0]){

    // iTEMS / CANCIONES 
    case 'inicio' : 
        $controller = new CancionesController();
        $controller->inicio($request);
        break;
    case 'agregarCancion' :
        $request = (new GuardMiddleware())->run($request);
        $controller = new CancionesController();
        $request->id = $params[1];
        $controller->agregarCanciones($request);
        break;
    case 'botonEditar' :
        $request = (new GuardMiddleware())->run($request);
        $controller = new CancionesController();
        $request->id = $params[1];
        $controller->botonEditar($request);
        break;
    case 'editar' :
        $request = (new GuardMiddleware())->run($request);
        $controller = new CancionesController();
        $request->id = $params[1];
        $controller->editarAlbumCancion($request);
        break;
    case 'eliminar' :
        $request = (new GuardMiddleware())->run($request);
        $controller = new CancionesController();
        $request->id = $params[1];
        $controller->eliminarAlbumCancion($request);
        break;
    case 'detalleCancion' :
        $controller = new CancionesController();
        $request->id = $params[1];
        $controller->detalleCancion($request);
        break;

        // CATEGORIAS / ALBUMES 
    case 'albumes' :
        $controller = new AlbumesController();
        $controller->albumes($request);
        break;
    case 'agregarAlbum' :
        $request = (new GuardMiddleware())->run($request);
        $controller = new AlbumesController();
        $request->id = $params[1];
        $controller->agregarAlbum($request);
        break;
    case 'botonEditarAlbum' :
        $request = (new GuardMiddleware())->run($request);
        $controller = new AlbumesController();
        $request->id = $params[1];
        $controller->botonEditarAlbum($request);
        break;
    case 'editarAlbum' :
        $request = (new GuardMiddleware())->run($request);
        $controller = new AlbumesController();
        $request->id = $params[1];
        $controller->editarAlbum($request);
        break;
    case 'eliminarAlbum' :
        $request = (new GuardMiddleware())->run($request);
        $controller = new AlbumesController();
        $request->id = $params[1];
        $controller->eliminarAlbum($request);
        break;
    case 'filtrar' :
        $controller = new AlbumesController();
        $controller->filtrar($request);
        break;

        // USUARIOS
    case 'login':
        $controller = new AuthController();
        $controller->showLogin($request);
        break;
    case 'do_login':
        $controller = new AuthController();
        $controller->doLogin($request);
        break;
    case 'logout':
        $request = (new GuardMiddleware())->run($request);
        $controller = new AuthController();
        $controller->logout($request);
        break;
    default: 
        echo "404 Page Not Found";
        break;


}

?>