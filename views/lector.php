<?php

session_start();
error_reporting(0);

$validar = $_SESSION['nombre'];

if( $validar == null || $validar = ''){

  header("Location: ../includes/login.php");
  die();
  
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/fontawesome-all.min.css">
  <link rel="stylesheet" href="../css/estilo.css">
  <link rel="stylesheet" href="../css/es.css">
  <title>Usuarios</title>
</head>

<body>

  <div class="container is-fluid">
    <div class="col-xs-12">
      <h1>Bienvenido Lector <?php echo $_SESSION['nombre']; ?></h1>
      <br>
      <h1>Lista de usuarios</h1>
      <br>
      <div>
        <a class="btn btn-warning" href="../includes/_sesion/cerrarSesion.php">Log Out</a>
      </div>
      <br>
      <br>
      <table class="table table-striped table-dark" id="table_id">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Telefono</th>
            <th>Rol</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>

          <?php

          $conexion = mysqli_connect("localhost", "root", "", "proyectolexpinphp");

          $SQL = "SELECT usuarios.id, usuarios.nombre, usuarios.apellido, usuarios.email, usuarios.contraseña, usuarios.telefono,
          permisos.rol FROM usuarios
          LEFT JOIN permisos ON usuarios.rol = permisos.id WHERE permisos.rol = 'usuario'";
          $dato = mysqli_query($conexion, $SQL);

          if ($dato->num_rows > 0) {
            while ($fila = mysqli_fetch_array($dato)) {

              ?>
              <tr>
                <td><?php echo $fila['nombre']; ?></td>
                <td><?php echo $fila['apellido']; ?></td>
                <td><?php echo $fila['email']; ?></td>
                <td><?php echo $fila['telefono']; ?></td>
                <td><?php echo $fila['rol']; ?></td>
                <td>
                  <a class="btn btn-warning" href="editar_user.php?id=<?php echo $fila['id']; ?>"> 🖊 </a>
                </td>
              </tr>

            <?php
            }
          } else {

            ?>
            <tr class="text-center">
              <td colspan="16">No existen registros</td>
            </tr>

          <?php

          }

          ?>


        </tbody>
      </table>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
  <script src="../js/user.js"></script>
</body>

</html>
