<?php
include '../../modelo/conexion.php';

$idProveedores = $_POST['idProveedores']; 
$nit = $_POST['NIT']; 
$razonSocial = $_POST['RazonSocial']; 
$contacto = $_POST['Contacto']; 
$telefono = $_POST['Telefono']; 
$correo = $_POST['Correo']; 
$direccion = $_POST['Direccion']; 

$sql = "INSERT INTO tblproveedores (idProveedores,NIT, RazonSocial, Contacto, Telefono, Correo, Direccion) VALUES ('$idProveedores', '$nit', '$razonSocial', '$contacto', '$telefono', '$correo', '$direccion')";

if ($conexion->query($sql) === TRUE) {
    header('Location: ../../vista/html/proveedores.php');
} else {
    echo "Error: " . $sql . "<br>" . $conexion->error;
}

$conexion->close();
?>
