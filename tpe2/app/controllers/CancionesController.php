<?php

require_once 'app/models/CancionesModel.php';
require_once 'app/models/AlbumesModel.php';
require_once 'app/views/CancionesViews.php';


class CancionesController{

    private $cancionModel;
    private $albumModel;
    private $cancionesView;

    function  __construct(){

        $this->cancionModel = new CancionModel();
        $this->albumModel = new AlbumModel();
        $this->cancionesView = new CancionesView();
    }

    function inicio($request){

        $albumCanciones = $this->cancionModel->obtenerCancionesConAlbum();
        $albumes = $this->albumModel->obtenerAlbums();

        $this->cancionesView->showInicio($albumCanciones, $albumes, $request->user);

    }

    function agregarCanciones($request){

      if(!isset($_POST['id_album']) || empty($_POST['id_album'])){
        $this->cancionesView->showError('Error: seleccionar un album', $request->user);
        return;
      }

      if(!isset($_POST['cancion']) || empty($_POST['cancion'])){
        $this->cancionesView->showError('Error: falta completar la cancion');
        return;
      }

      if(!isset($_POST['duracion']) || empty($_POST['duracion'])){
        $this->cancionesView->showError('Error: falta completar la duracion');
        return;
      }

      if(!isset($_POST['letra'])){
        $this->cancionesView->showError('Error: seleccionar la letra explicita');
        return;
      }

      $id_album = $_POST['id_album'];
      $cancion = $_POST['cancion'];
      $duracion = $_POST['duracion'];
      $letra = $_POST['letra'];

      $nuevaCancion = $this->cancionModel->insertarCancion($id_album,$cancion,$duracion,$letra);

      if(!$nuevaCancion){
        $this->cancionesView->showError('Error: no se pudo agregar la cancion', $request->user);
        return;
      }
       header('Location: ' . BASE_URL);

    }

    function botonEditar($request){

        $cancion = $this->cancionModel->obtenerCancionConAlbum($request->id);
        $albumes = $this->albumModel->obtenerAlbums();

        $this->cancionesView->formularioEditar($cancion ,$albumes , $request->user);
    }

    function editarAlbumCancion($request){

        if(!isset($_POST['id_album']) || empty($_POST['id_album'])){
            $this->cancionesView->showError('Error: seleccionar un album');
            return;
        }
        if(!isset($_POST['cancion']) || empty($_POST['cancion'])){
            $this->cancionesView->showError('Error: falta completar la cancion');
            return;
        }
        if(!isset($_POST['duracion']) || empty($_POST['duracion'])){
            $this->cancionesView->showError('Error: falta completar la duracion');
            return;
        }
        if(!isset($_POST['letra'])){
            $this->cancionesView->showError('Error: seleccionar la letra explicita');
            return;
        }

        $id_album = $_POST['id_album'];
        $cancion = $_POST['cancion'];
        $duracion = $_POST['duracion'];
        $letra = $_POST['letra'];


        $cancionEditada = $this->cancionModel->actualizarCancion($id_album , $cancion , $duracion , $letra , $request->id);
         
            if(!$cancionEditada){
                $this->cancionesView->showError('Error: no se pudo editar el album');
                return;
            }
            header('Location: ' . BASE_URL);
    }

    function eliminarAlbumCancion($request){

        $cancionEliminada = $this->cancionModel->eliminarCancion($request->id);
        if(!$cancionEliminada){
          $this->cancionesView->showError('Error: no se pudo eliminar la cancion con su album', $request->user);
        }
        
        header('Location: ' . BASE_URL);
    }


    function detalleCancion($request){

      $detalleCancionId = $this->cancionModel->obtenerCancionConAlbum($request->id);
      
      $this->cancionesView->mostrarDetalleId($detalleCancionId, $request->user);

    }


}


?>