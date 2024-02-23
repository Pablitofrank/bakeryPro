<?php
include '../../modelo/conexion.php';

$idProveedores = $_POST['idProveedores']; // Change 'id' to the correct name used in your HTML form
$nit = $_POST['nit']; // Match with the HTML form input names
$razonSocial = $_POST['razonSocial']; // Match with the HTML form input names
$contacto = $_POST['contacto']; // Match with the HTML form input names
$telefono = $_POST['telefono']; // Match with the HTML form input names
$correo = $_POST['correo']; // Match with the HTML form input names
$direccion = $_POST['direccion']; // Match with the HTML form input names

$sql = "UPDATE tblproveedores SET NIT='$nit', RazonSocial='$razonSocial', Contacto='$contacto', Telefono='$telefono', Correo='$correo', Direccion='$direccion' WHERE IdProveedores=$idProveedores";

if ($conexion->query($sql) === TRUE) {
    header('Location: ../../vista/html/usuario.php');
} else {
    echo "Error al actualizar el registro: " . $conexion->error;
}

$conexion->close();
?>
