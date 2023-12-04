<?php
  if (session_status() === PHP_SESSION_NONE)
    session_start();
  class Usuario {
    private $codigo;
    private $nombre;
    private $apellido;

    public function __construct() {

    }

    public function setCodigo($codigo) {
      $this->codigo = $codigo;
    }

    public function getCodigo() {
      return $this->codigo;
    }

    public function setNombre($nombre) {
      $this->nombre = $nombre;
    }

    public function getNombre() {
      return $this->nombre;
    }

    public function setApellido($apellido) {
      $this->apellido = $apellido;
    }

    public function getApellido() {
      return $this->apellido;
    }

    public function guardarUsuario($user) {
      $_SESSION['usuarios'][] = array('codigo' => $user->codigo, 'nombre' => $user->nombre, 'apellido' => $user->apellido);
      $msg = "OK";
      return $msg;
    }

    public function newCod() {
      return count($_SESSION['usuarios']) + 1;
    }

    public function modificarUsuario($user) {
      for ($i = 0; $i < count($_SESSION['usuarios']); $i++) {
        if (isset($_SESSION['usuarios'][$i])){
          if ($user->getCodigo() == $_SESSION['usuarios'][$i]['codigo']){
            $_SESSION['usuarios'][$i]['nombre'] = $user->getNombre();
            $_SESSION['usuarios'][$i]['apellido'] = $user->getApellido();
            $msg = "OK";
          }else
            $msg = "No se ha encontrado el usuario.";
        }
      }
      return $msg;
    }

    public function eliminarUsuario($cod) {
      for ($i = 0; $i < count($_SESSION['usuarios']); $i++) {
        if (isset($_SESSION['usuarios'][$i])){
          if ($cod == $_SESSION['usuarios'][$i]['codigo']){
            $_SESSION['usuarios'][$i] = null; //Elimina al usuario que contiene el mismo código.
            $msg = "OK";
            break;
          } else{
            $msg = "No se ha encontrado el usuario.";
          }
        }
      }
      return $msg;
    }
  }
?>