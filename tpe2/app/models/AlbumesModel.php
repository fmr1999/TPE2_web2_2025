<?php

     require_once './app/models/Model.php';
     
    class AlbumModel extends Model{

         function obtenerAlbums(){

            $query = $this->db->prepare('SELECT id, nombre, anio_lanzamiento FROM albumes');
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        }

        function obtenerAlbumDetalle($id){
            $query = $this->db->prepare('SELECT c.id, a.nombre AS nombre_album, c.nombre AS nombre_cancion, c.duracion, c.letra_explicita , a.anio_lanzamiento
                FROM albumes AS a
                INNER JOIN canciones AS c ON a.id = c.id_album
                WHERE a.id = ?');
                $query->execute([$id]);
                $albumDetalle = $query->fetchAll(PDO::FETCH_OBJ);
                return $albumDetalle;
        }
            

        function insertarAlbum($nombre, $anio_lanzamiento){
            $query = $this->db->prepare('INSERT INTO albumes (nombre, anio_lanzamiento) VALUES (?,?)');
            $query->execute([$nombre, $anio_lanzamiento]);
            return $this->db->lastInsertId();

        }

        function obtenerAlbum($id){
            $query = $this->db->prepare('SELECT * FROM albumes WHERE id = ?');
            $query->execute([$id]);
            $id = $query->fetch(PDO::FETCH_OBJ);
            return $id;

        }

        function actualizarAlbum($nombre, $anio_lanzamiento, $id){
            $query = $this->db->prepare('UPDATE albumes SET nombre = ?, anio_lanzamiento = ?  WHERE id = ?');
            $album = $query->execute([$nombre, $anio_lanzamiento, $id]);
            return $album;
        }

        function eliminarAlbumId($id){
            $query = $this->db->prepare('DELETE FROM albumes WHERE id = ?');
            $query->execute([$id]);
        }

    }

   


?>