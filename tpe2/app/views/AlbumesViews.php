 <?php
 class albumesView{

            function mostrarAlbumes($albumes, $user){
                require_once './templates/header.phtml';
                require_once './templates/homeAlbumes.phtml';
                require_once './templates/footer.phtml';
            }

            function editarAlbum($album , $user){
                require_once './templates/header.phtml';
                require_once './templates/formularioEditarAlbum.phtml';
                require_once './templates/footer.phtml';
            }

            function filtrarAlbum($albumes, $cancion , $user){
                require_once './templates/header.phtml';
                require_once './templates/filtrarDetalleAlbum.phtml';
                require_once './templates/footer.phtml';
            }

            function showError($error, $user) {
                require_once './templates/header.phtml';
                require_once './templates/mensajeError.phtml';
                require_once './templates/footer.phtml';
                
            }

            
 }
 
        
            

?>