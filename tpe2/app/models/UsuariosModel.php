<?php

    require_once './app/models/Model.php';

 class UserModel extends Model{

    function getByUser($user){
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE nombre = ?');
        $query->execute([$user]);
        $usuario = $query->fetch(PDO::FETCH_OBJ);
        return $usuario;
    }

 



 }

?>