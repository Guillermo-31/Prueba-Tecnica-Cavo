<?php
  if (session_status() === PHP_SESSION_NONE)
    session_start();

  require_once __DIR__ . '/../model/Usuario.php';

  $accion = isset($_REQUEST['accion']) ? $_REQUEST['accion'] : '';
  $codigo = isset($_REQUEST['codigo']) ? $_REQUEST['codigo'] : '';
  $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
  $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : '';
  $url = isset($_REQUEST['url']) ? $_REQUEST['url'] : '';
  $user = new Usuario();

  switch ($accion) {
    case 'crear':
      $user->setCodigo($user->newCod());
      $user->setNombre($nombre);
      $user->setApellido($apellido);
      $msg = $user->guardarUsuario($user);
      echo json_encode($msg);
      break;

    case 'modificar':
      $user->setCodigo($codigo);
      $user->setNombre($nombre);
      $user->setApellido($apellido);
      $msg = $user->modificarUsuario($user);
      echo json_encode($msg);
      break;

    case 'eliminar':
      $msg = $user->eliminarUsuario($codigo);

      if ($url == "si"){
        echo "<input type='hidden' value='" . $msg . "' id='eliminar-h'/>";
        ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="/API/views/funciones.js"></script><?php
      }else
        echo json_encode($msg);

      break;
  }

  function inicializarUsuarios() {
    $_SESSION['usuarios'] = array(
      array('codigo' => 1, 'nombre' => "Guillermo", 'apellido' => "Granadino"),
      array('codigo' => 2, 'nombre' => "Leandro", 'apellido' => "Mena")
    );
  }
?>