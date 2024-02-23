<?php
include '../../modelo/conexion.php';

$cedula = $_POST['cedula'];
$password = $_POST['Password'];
session_start();
$_SESSION['cedula'] = $cedula;

$conexion = mysqli_connect("localhost", "root", "", "bakerypro");

$consulta = "SELECT * FROM tblusuario WHERE cedula='$cedula' AND password='$password'";
$resultado = mysqli_query($conexion, $consulta);

$filas = mysqli_num_rows($resultado);
if ($filas > 0) {
    header("location: ../../dashboard.php");
    exit; // Termina el script después de la redirección
} else {
    include (": ../../index.php");
    header("location: ../../index.php");
    ?>
    <h1 class="bad">ERROR EN LA AUTENTIFICACION</h1>
    <?php
}

mysqli_free_result($resultado);
mysqli_close($conexion);
?>

