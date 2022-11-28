<?php

class usuario
{

  private $db;

  public function __construct()
  {
    $this->db = new Base;
  }

  public function getUsuario($usuario)
  {
    $this->db->query('SELECT * FROM usuarios WHERE usuario =  :user');
    $this->db->bind(':user', $usuario);
    return $this->db->register();
  }

  public function getPerfil($idusuario)
  {
    $this->db->query('SELECT * FROM perfil WHERE idusuario = :id');
    $this->db->bind(':id', $idusuario);
    return $this->db->register();
  }

  public function getPublicaciones()
  {
    $this->db->query('SELECT P.idUserPublico, P.idpublicacion , P.contenidoPublicacion , P.fotoPublicacion , P.fechaPublicacion, P.num_likes, U.usuario ,  Per.fotoPerfil FROM publicaciones P
    INNER JOIN usuarios U ON U.idusuario = P.idUserPublico
    INNER JOIN perfil Per ON Per.idUsuario = P.idUserPublico');
    return $this->db->registers();
  }



  public function getPublicacion($id)
  {
    $this->db->query('SELECT * FROM publicaciones WHERE idpublicacion = :id ');
    $this->db->bind(':id', $id);
    return $this->db->register();
  }

  public function getComentarios()
  {
    $this->db->query('SELECT * FROM comentarios');
    return $this->db->registers();
  }

  public function getAllusuarios()
  {
    $this->db->query('SELECT U.idusuario, U.usuario, P.fotoPerfil, P.nombreCompleto FROM usuarios U
    INNER JOIN perfil P ON U.idusuario = P.idUsuario');
    return $this->db->registers();
  }

  public function getInformacionComentarios($comentarios)
  {
    $this->db->query('SELECT C.idcomentario, C.idPublicacion, C.contenidoComentario, C.fechaComentario,C.idUser, P.fotoPerfil, U.usuario FROM comentarios C
    INNER JOIN perfil P ON P.idUsuario = C.idUser
    INNER JOIN usuarios U ON U.idusuario = C.idUser');

    return $this->db->registers();
  }

  public function eliminarPublicacion($publicacion)
  {
    $this->db->query('DELETE FROM comentarios WHERE idPublicacion = :publicacion');
    $this->db->bind(':publicacion', $publicacion->idpublicacion);
    if ($this->db->execute()) {
      $this->db->query('DELETE FROM likes WHERE idPublicacion = :publicacion');
      $this->db->bind(':publicacion', $publicacion->idpublicacion);
      if ($this->db->execute()) {
        $this->db->query('DELETE FROM publicaciones WHERE idpublicacion = :id ');
        $this->db->bind(':id', $publicacion->idpublicacion);
        if ($this->db->execute()) {
          return true;
        } else {
          return false;
        }
      } else {
      }
    } else {
    }
  }

  public function eliminarTodo($id)
  {
    $this->db->query('DELETE FROM comentarios WHERE idUser = :id');
    $this->db->bind(':id', $id);
    if ($this->db->execute()) {
      $this->db->query('DELETE FROM likes WHERE idUser = :id');
      $this->db->bind(':id', $id);
      if ($this->db->execute()) {
        $this->db->query('DELETE FROM publicaciones WHERE  idUserPublico = :id');
        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
          $this->db->query('DELETE FROM perfil WHERE  idUsuario = :id');
          $this->db->bind(':id', $id);
          if ($this->db->execute()) {
            $this->db->query('DELETE FROM usuarios WHERE  idusuario = :id');
            $this->db->bind(':id', $id);
            $this->db->execute();
            return true;
          } else {
          }
        } else {
        }
      } else {
      }
    } else {
    }
  }

  public function rowLikes($datos)
  {
    $this->db->query('SELECT * FROM likes WHERE idPublicacion = :publicacion AND idUser = :iduser');
    $this->db->bind(':publicacion', $datos['idpublicacion']);
    $this->db->bind(':iduser', $datos['idusuario']);
    $this->db->execute();
    return $this->db->rowCount();
  }



  public function agregarLike($datos)
  {
    $this->db->query('INSERT INTO likes (idPublicacion, idUser) VALUES (:publicacion, :iduser)');
    $this->db->bind(':publicacion', $datos['idpublicacion']);
    $this->db->bind(':iduser', $datos['idusuario']);
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function eliminarLike($datos)
  {
    $this->db->query('DELETE FROM likes WHERE idPublicacion = :publicacion AND idUser = :iduser');
    $this->db->bind(':publicacion', $datos['idpublicacion']);
    $this->db->bind(':iduser', $datos['idusuario']);
    $this->db->execute();
  }

  public function eliminarComentarioUsuario($id)
  {
    $this->db->query('DELETE FROM comentarios WHERE idcomentario = :id');
    $this->db->bind(':id', $id);
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function addLikeCount($datos)
  {
    $this->db->query('UPDATE publicaciones SET num_likes = :countLike WHERE idpublicacion = :idPublicacion');
    $this->db->bind(':countLike', ($datos->num_likes + 1));
    $this->db->bind(':idPublicacion', $datos->idpublicacion);
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function deleteLikeCount($datos)
  {
    $this->db->query('UPDATE publicaciones SET num_likes = :countLike WHERE idpublicacion = :idPublicacion');
    $this->db->bind(':countLike', ($datos->num_likes - 1));
    $this->db->bind(':idPublicacion', $datos->idpublicacion);
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function misLikes($user)
  {
    $this->db->query('SELECT * FROM likes WHERE idUser = :id');
    $this->db->bind(':id', $user);
    return $this->db->registers();
  }

  public function verificarContrasena($datosUsuario, $contrasena)
  {
    if (password_verify($contrasena, $datosUsuario->contrasena)) {
      return true;
    } else {
      return false;
    }
  }

  public function verificarUsuario($datosUsuario)
  {
    $this->db->query('SELECT usuario FROM usuarios WHERE usuario =  :user');
    $this->db->bind(':user', $datosUsuario['usuario']);
    $this->db->register();
    if ($this->db->rowCount()) {
      return false;
    } else {
      return true;
    }
  }

  public function register($datosUsuario)
  {
    $this->db->query('INSERT INTO usuarios (idPrivilegio, correo, usuario, contrasena) VALUES (:privilegio, :correo, :usuario, :contrasena)');
    $this->db->bind(':privilegio', $datosUsuario['privilegio']);
    $this->db->bind(':correo', $datosUsuario['email']);
    $this->db->bind(':usuario', $datosUsuario['usuario']);
    $this->db->bind(':contrasena', $datosUsuario['contrasena']);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function insertarPerfil($datos)
  {
    $this->db->query('INSERT INTO perfil(idUsuario,fotoPerfil,nombreCompleto) VALUES (:id , :rutaFoto , :nombre)');
    $this->db->bind(':id', $datos['idusuario']);
    $this->db->bind(':rutaFoto', $datos['ruta']);
    $this->db->bind(':nombre', $datos['nombre']);
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function editarFoto($datos)
  {
    $this->db->query('UPDATE perfil SET fotoPerfil = :ruta WHERE idUsuario = :iduser');
    $this->db->bind(':ruta', $datos['ruta']);
    $this->db->bind(':iduser', $datos['idusuario']);
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function publicar($datos)
  {
    $this->db->query('INSERT INTO publicaciones(idUserPublico,contenidoPublicacion,fotoPublicacion) VALUES (:id , :contenido, :rutaPublicacion)');
    $this->db->bind(':id', $datos['idusuario']);
    $this->db->bind(':contenido', $datos['contenido']);
    $this->db->bind(':rutaPublicacion', $datos['ruta']);
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function publicarComentario($datos)
  {
    $this->db->query('INSERT INTO comentarios (idPublicacion, idUser, contenidoComentario) VALUES (:idpubli, :iduser, :comentario)');
    $this->db->bind(':idpubli', $datos['idpublicacion']);
    $this->db->bind(':iduser', $datos['iduser']);
    $this->db->bind(':comentario', $datos['comentario']);
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
}
