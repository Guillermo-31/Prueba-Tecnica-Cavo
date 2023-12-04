<?php
  if (session_status() === PHP_SESSION_NONE)
    session_start();

  require_once '../controller/ctrlUsuario.php';

  $codigoUser = isset($_REQUEST['codigo']) ? $_REQUEST['codigo'] : '';
  for ($i = 0; $i < count($_SESSION['usuarios']); $i++) {
    if (isset($_SESSION['usuarios'][$i]))
      if ($_SESSION['usuarios'][$i]['codigo'] == $codigoUser){
        $indice = $i;
      }
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modificar Usuario</title>
  <link rel="stylesheet" href="/API/views/css/estilo.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h1>Modificar Usuario</h1>
          </div>
          <div class="card-body">
            <form action="" id="formulario">
              <?php
                if (!isset($indice))
                  echo "<input type='hidden' value='no' id='cod-verificador'/>";
                else
                  echo "<input type='hidden' name='cod' id='codigo' value='" . $_SESSION['usuarios'][$indice]['codigo'] . "'>";
              ?>
              <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php if (isset($indice)) echo $_SESSION['usuarios'][$indice]['nombre'] ?>">
              </div>
              <div class="mb-3">
                <label for="apellido" class="form-label">Apellido:</label>
                <input type="text" class="form-control" id="apellido" name="apellido" value="<?php if (isset($indice)) echo $_SESSION['usuarios'][$indice]['apellido'] ?>">
              </div>
              <button type="submit" class="btn btn-primary" id="btn-modificar">
                <i class="fas fa-edit"></i> Modificar Usuario
              </button>
            <form>
          </div>
        </div>
        <a href="/API/listar" class="btn btn-secondary mt-3">
          <i class="fas fa-arrow-left"></i> Regresar al Inicio
        </a>
      </div>
    </div>
  </div>
  <footer>
    <p>Creado por Guillermo Granadino <i class="fas fa-copyright"></i> 2023</p>
  </footer>
  <script src="/API/views/funciones.js"></script>
</body>
</html>