<?php

require_once 'app/models/UsuariosModel.php';
require_once 'app/views/AuthViews.php';


class AuthController{

    private $userModel;
    private $authView;


    function __construct(){
        $this->userModel = new UserModel();
        $this->authView = new AuthView();
    }


    function showLogin($request) {
        $this->authView->showLogin("", $request->user);
    }

    function doLogin($request) {
        
        if(empty($_POST['user']) || empty($_POST['password'])) {
            return $this->authView->showLogin("Faltan datos obligatorios", $request->user);
        }

        $user = $_POST['user'];
        $password = $_POST['password'];

        $userId = $this->userModel->getByUser($user);

        if($userId && password_verify($password, $userId->contrasenia)) {
            $_SESSION['USER_ID'] = $userId->id;
            $_SESSION['USER_NAME'] = $userId->nombre;
            header("Location: ".BASE_URL."inicio");
            return;
        } else {
            return $this->authView->showLogin("Usuario o contraseña incorrecta", $request->user);
        }
    }


    function logout($request) {
        session_destroy();
        header("Location: ".BASE_URL."login");
        return;
    }
 
    
}


?>