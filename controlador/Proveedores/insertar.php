<?php
include '../../modelo/conexion.php';

$idProveedores = $_POST['idProveedores']; 
$nit = $_POST['nit']; 
$razonSocial = $_POST['razonSocial']; 
$contacto = $_POST['contacto']; 
$telefono = $_POST['telefono']; 
$correo = $_POST['correo']; 
$direccion = $_POST['direccion']; 

$sql = "INSERT INTO tblproveedores (idProveedores, nit, razonSocial, contacto, telefono, correo, direccion) VALUES ('$idProveedores', '$nit', '$razonSocial', '$contacto', '$telefono', '$correo', '$direccion')";

if ($conexion->query($sql) === TRUE) {
    header('Location: ../../vista/html/proveedores.php');
} else {
    echo "Error: " . $sql . "<br>" . $conexion->error;
}

$conexion->close();
?>
