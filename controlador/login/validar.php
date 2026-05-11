<?php
// 1. Importamos la conexión que ya tiene las variables de Railway corregidas
include '../../modelo/conexion.php';

$cedula = $_POST['cedula'];
$Contraseña = $_POST['Contraseña'];
session_start();
$_SESSION['cedula'] = $cedula;

// 2. ELIMINAMOS la línea de mysqli_connect("localhost"...) 
// porque ya tenemos la variable $conexion disponible gracias al include anterior.

$consulta = "SELECT * FROM tblusuario WHERE cedula='$cedula' AND Contraseña='$Contraseña'";

// 3. Usamos la $conexion que viene de modelo/conexion.php
$resultado = mysqli_query($conexion, $consulta);

if ($resultado && mysqli_num_rows($resultado) > 0) {
    header("location: ../../dashboard.php");
    exit; 
} else {
    // Redirigir al index con un parámetro de error para mostrar el mensaje
    header("location: ../../index.php?error=1");
    exit;
}

// Limpieza
mysqli_free_result($resultado);
mysqli_close($conexion);
?>
