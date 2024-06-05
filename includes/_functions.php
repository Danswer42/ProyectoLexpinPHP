<?php
   
require_once ("_db.php");




if (isset($_POST['accion'])){ 
    switch ($_POST['accion']){
        //casos de registros
        case 'editar_registro':
            editar_registro();
            break; 

            case 'eliminar_registro';
            eliminar_registro();
    
            break;

            case 'acceso_user';
            acceso_user();
            break;
		}
	}

    function editar_registro() {
		$conexion=mysqli_connect("localhost","root","","proyectolexpinphp");
		extract($_POST);
		$consulta="UPDATE usuarios SET nombre = '$nombre', nombre = '$apellido', email = 'email', telefono = '$telefono',
		contraseña ='contraseña', rol = '$rol' WHERE id = '$id' ";

		mysqli_query($conexion, $consulta);

		header('Location: ../views/user.php');
}

function eliminar_registro() {
    $conexion=mysqli_connect("localhost","root","","proyectolexpinphp");
    extract($_POST);
    $id= $_POST['id'];
    $consulta= "DELETE FROM usuarios WHERE id= $id";

    mysqli_query($conexion, $consulta);

    header('Location: ../views/user.php');
}

function acceso_user() {
    $nombre=$_POST['nombre'];
    $contraseña=$_POST['contraseña'];
    session_start();
    $_SESSION['nombre']=$nombre;

    $conexion=mysqli_connect("localhost","root","","proyectolexpinphp");
    $consulta= "SELECT * FROM usuarios WHERE nombre='$nombre' AND contraseña='$contraseña'";
    $resultado=mysqli_query($conexion, $consulta);
    $filas=mysqli_fetch_array($resultado);

    if($filas['rol'] == 1){ //admin

        header('Location: ../views/user.php');

    }else if($filas['rol'] == 2){//usuario
        header('Location: ../views/lector.php');
    }
    else{

        header('Location: login.php');
        session_destroy();

    }
}






