<?php
    require_once 'app/models/AlbumesModel.php';
    require_once 'app/views/AlbumesViews.php';

    class  AlbumesController{
        
        private $albumModel;
        private $albumesView;

        function  __construct(){
            $this->albumModel = new AlbumModel();
            $this->albumesView = new AlbumesView();
        }

        function albumes($request){

            $albumes = $this->albumModel->obtenerAlbums();

            $this->albumesView->mostrarAlbumes($albumes, $request->user);
        }

        function agregarAlbum($request){

             if(!isset($_POST['nombre']) || empty($_POST['nombre'])){
                $this->albumesView->showError('Error: falta completar el nombre', $request->user);
            }

             if(!isset($_POST['anio_lanzamiento']) || empty($_POST['anio_lanzamiento'])){
                $this->albumesView->showError('Error: falta completar el año de lanzamiento');
            }

            $nombre = $_POST['nombre'];
            $anio_lanzamiento = $_POST['anio_lanzamiento'];

            $albumNuevo = $this->albumModel->insertarAlbum($nombre, $anio_lanzamiento);


            if(!$albumNuevo){
                 $this->albumesView->showError('Error: no se pudo agregar el album', $request->user);
            }

            header('Location: ' . BASE_URL . "albumes");

        }

    
        function botonEditarAlbum($request){
            
            $album = $this->albumModel->obtenerAlbum($request->id);

            $this->albumesView->editarAlbum($album , $request->user);
        }

        function editarAlbum($request){

            if(!isset($_POST['nombre']) || empty($_POST['nombre'])){
                $this->albumesView->showError('Error: falta completar el nombre');
            }

             if(!isset($_POST['anio_lanzamiento']) || empty($_POST['anio_lanzamiento'])){
                $this->albumesView->showError('Error: falta completar el año de lanzamiento');
            }

            $nombre = $_POST['nombre'];
            $anio_lanzamiento = $_POST['anio_lanzamiento'];

            $editarAlbum = $this->albumModel->actualizarAlbum($nombre, $anio_lanzamiento, $request->id);

            if(!$editarAlbum){
                $this->albumesView->showError('Error: no se pudo editar el album');
            }

            header('location:' . BASE_URL . "albumes");
        }

        function eliminarAlbum($request){
            try {        
                $this->albumModel->eliminarAlbumId($request->id);
                header('Location: ' . BASE_URL . "albumes");
            } catch (PDOException) {
                    $this->albumesView->showError('Error: no se puede eliminar un Álbum que contenga canciones', $request->user);
            }
        }
            
        function filtrar($request) {
            
            $albumes = $this->albumModel->obtenerAlbums();

            if (!isset($_POST['album']) || empty($_POST['album'])) {
                $this->albumesView->showError("Error: seleccionar un album");
                return;
            }

            $id = $_POST['album']; 
            $cancion = $this->albumModel->obtenerAlbumDetalle($id);

            $this->albumesView->filtrarAlbum($albumes, $cancion , $request->user);
        }

 
    }
?>