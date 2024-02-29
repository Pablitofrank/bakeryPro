<?php
include '../../modelo/conexion.php';

$IdProveedores = $_POST['IdProveedores']; 
$NIT = $_POST['NIT']; 
$RazonSocial = $_POST['RazonSocial']; 
$Contacto = $_POST['Contacto']; 
$Telefono = $_POST['Telefono']; 
$Correo = $_POST['Correo']; 
$Direccion = $_POST['Direccion']; 

$sql = "UPDATE tblproveedores SET NIT='$NIT', RazonSocial='$RazonSocial', Contacto='$Contacto', Telefono='$Telefono', Correo='$Correo', Direccion='$Direccion' WHERE IdProveedores=$IdProveedores";

if ($conexion->query($sql) === TRUE) {
    header('Location: ../../vista/html/proveedores.php');
} else {
    echo "Error al actualizar el registro: " . $conexion->error;
}

$conexion->close();
?>
