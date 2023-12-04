<?php
  if (session_status() === PHP_SESSION_NONE)
    session_start();
  require_once '../controller/ctrlUsuario.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Usuarios</title>
  <link rel="stylesheet" href="/API/views/css/estilo.css">
  <link rel="stylesheet" href="/API/views/css/estilo-listar.css">
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
    <a href="/API/crear/" class="btn btn-primary">
      <i class="fas fa-user-plus"></i> Crear Nuevo Usuario
    </a>
    <div class="mt-3">
      <h1>Usuarios Registrados</h1>
    </div>
    <div class="mt-3">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Código</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php
            for ($i = 0; $i < count($_SESSION['usuarios']); $i++) {
              if (isset($_SESSION['usuarios'][$i])){
                echo "<tr class='data'>
                  <td>" . $_SESSION['usuarios'][$i]['codigo'] . "</td>
                  <td>" . $_SESSION['usuarios'][$i]['nombre'] . "</td>
                  <td>" . $_SESSION['usuarios'][$i]['apellido'] . "</td>
                  <td>
                    <div class='btn-group botones' role='group'>
                      <button class='btn btn-info btn-modificar' onclick='modificarUser(\"" . $_SESSION['usuarios'][$i]['codigo'] . "\");'>
                        <i class='fas fa-edit'></i> Modificar
                      </button>
                      <button class='btn btn-danger btn-eliminar' onclick='eliminarUser(\"" . $_SESSION['usuarios'][$i]['codigo'] . "\");'>
                        <i class='fas fa-trash-alt'></i> Eliminar
                      </button>
                    </div>
                  </td>
                </tr>";
              }
            }

          ?>
        </tbody>
      </table>
    </div>
  </div>
  <footer>
    <p>Creado por Guillermo Granadino <i class="fas fa-copyright"></i> 2023</p>
  </footer>
  <script src="/API/views/funciones.js"></script>
</body>
</html>