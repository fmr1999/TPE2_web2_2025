<?php 

     require_once './app/models/Model.php';

    class CancionModel extends Model{

        function obtenerCancionesConAlbum(){
            $query = $this->db->prepare('SELECT c.id, a.nombre AS nombre_album, c.nombre AS nombre_cancion , c.duracion , c.letra_explicita FROM albumes AS a INNER JOIN canciones AS c ON a.id = c.id_album');
            $query->execute();
            $album_canciones = $query->fetchAll(PDO::FETCH_OBJ);
            return $album_canciones;
        }

        function obtenerCancionConAlbum($id){
            $query = $this->db->prepare(
                'SELECT c.id, a.nombre AS nombre_album, c.nombre AS nombre_cancion, c.duracion, c.letra_explicita
                FROM albumes AS a
                INNER JOIN canciones AS c ON a.id = c.id_album
                WHERE c.id = ?'
            );
            $query->execute([$id]);
            $album_cancion = $query->fetch(PDO::FETCH_OBJ);
            return $album_cancion;
        }

        function actualizarCancion($id_album , $cancion , $duracion , $letra , $id){
            $query = $this->db->prepare(' UPDATE canciones SET id_album = ? , nombre = ? , duracion = ? , letra_explicita = ? WHERE id = ?');
            $cancion = $query->execute([$id_album , $cancion , $duracion , $letra , $id]);
            return $cancion;
        }


        function eliminarCancion($id){
            $query = $this->db->prepare('DELETE FROM canciones WHERE id = ?');
            $query->execute([$id]);
            
        }

        function insertarCancion($id_album,$cancion,$duracion,$letra){
            $query = $this->db->prepare('INSERT INTO canciones ( id_album , nombre ,duracion, letra_explicita) VALUES (?,?,?,?)');
            $query->execute([$id_album,$cancion,$duracion,$letra]);
            return $this->db->lastInsertId();
        }
        

    }

?>