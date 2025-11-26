<?php
session_start();
include 'holasoyfunciones.php';

// Recibir datos del formulario
$User = $_POST['User'];
$Pass = $_POST['Pass'];

// Conexión DB
$conexion = mysqli_connect('localhost', 'root', '', 'sahumerios');

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Consulta para validar login y traer datos del usuario
$consulta = "
    SELECT ID, Nombre_de_usuario, Nombre, Apellido, Contrasena, Telefono
    FROM usuarios
    WHERE Nombre_de_usuario='$User' AND Contrasena='$Pass'
";

$result = mysqli_query($conexion, $consulta);
$cant_filas = mysqli_num_rows($result);

// Si existe el usuario:
if ($cant_filas > 0) {

    $row = mysqli_fetch_array($result);

    // Guardar datos en sesión
    $_SESSION['id_deuser']  = $row['ID'];
    $_SESSION['user']       = $row['Nombre_de_usuario'];
    $_SESSION['nom']        = $row['Nombre'];
    $_SESSION['ape']        = $row['Apellido'];
    $_SESSION['pass']       = $row['Contrasena'];
    $_SESSION['tel']        = $row['Telefono'];

    // Redirigir a la página principal
    header("Location: index.php");
    exit();

} else {
    echo "<script>alert('Usuario o contraseña incorrectos'); window.location='login.php';</script>";
}
?>