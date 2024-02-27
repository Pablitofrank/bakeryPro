<?php
include '../../modelo/conexion.php';

$id = $_POST['id']; // Change 'id' to the correct name used in your HTML form
$nombres = $_POST['nombres']; // Match with the HTML form input names
$apellidos = $_POST['apellidos']; // Match with the HTML form input names
$cedula = $_POST['cedula'];
$rol = $_POST['rol'];
$telefono = $_POST['telefono']; // Match with the HTML form input names

$sql = "UPDATE tblusuario SET Nombres='$nombres', Apellidos='$apellidos', IdRol='$rol', Cedula='$cedula', Telefono='$telefono' WHERE IdUsuario=$id";

if ($conexion->query($sql) === TRUE) {
    header('Location: ../../vista/html/usuarios.php');
} else {
    echo "Error al actualizar el registro: " . $conexion->error;
}

$conexion->close();
?>
