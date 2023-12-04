<?php
  if (session_status() === PHP_SESSION_NONE)
    session_start();
  require_once './controller/ctrlUsuario.php';
  inicializarUsuarios();
  header('Location: /API/listar');

  /*$user = new Usuario();

  $user->setNombre("Leandro");

  $user->setCodigo($user->newCod());

  $user->setApellido("Mena");

  $user->guardarUsuario($user);

  $ultimoDato = end($_SESSION['usuarios']);

  echo "Codigo = " . $ultimoDato[0] . "\nNombre: " . $ultimoDato[1] . "\nApellido: " . $ultimoDato[2]; */


?>