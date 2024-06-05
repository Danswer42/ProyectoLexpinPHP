<?php
$conexion= mysqli_connect("localhost", "root", "", "proyectolexpinphp");

if(isset($_POST['registrar'])){

    if(strlen($_POST['nombre']) >=1 && strlen($_POST['apellido']) >=1 && strlen($_POST['email'])  >=1 && strlen($_POST['telefono'])  >=1 
    && strlen($_POST['contraseña'])  >=1 && strlen($_POST['rol']) >= 1 ){

    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $email = trim($_POST['email']);
    $telefono = trim($_POST['telefono']);
    $contraseña = trim($_POST['contraseña']);
    $rol = trim($_POST['rol']);

    $consulta= "INSERT INTO usuarios (nombre, apellido, email, telefono, contraseña, rol)
    VALUES ('$nombre','$apellido','$email','$telefono','$contraseña','$rol' )";

    mysqli_query($conexion, $consulta);
    mysqli_close($conexion);

    header('Location: ../views/user.php');
  }
}

?>