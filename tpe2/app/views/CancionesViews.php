<?php

    class CancionesView{

        function showInicio($albumCanciones, $albumes , $user){
            require_once './templates/header.phtml';
            require_once './templates/home.phtml';
            require_once './templates/footer.phtml';
        }

        function formularioEditar($cancion, $albumes ,$user){
            require_once './templates/header.phtml';
            require_once './templates/formularioEditarCancion.phtml';
            require_once './templates/footer.phtml';
        }

        function mostrarDetalleId($detalleCancionId , $user){
            require_once './templates/header.phtml';
            require_once './templates/cancionDetalleId.phtml';
            require_once './templates/footer.phtml';
        }

        function showError($error) {
            require_once './templates/header.phtml';
            require_once './templates/mensajeError.phtml';
            require_once './templates/footer.phtml';
                
        }



    }


?>