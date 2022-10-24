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
}
