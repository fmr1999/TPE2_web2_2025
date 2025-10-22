<?php

class AuthView{


    function showLogin($error, $user){
        require_once './templates/header.phtml';
        require_once './templates/formularioLogin.phtml';
        require_once './templates/footer.phtml';
    }
    public function showError($error, $user) {
        echo "<h1>$error</h1>";
    }

}


?>