<?php
include '../../modelo/conexion.php';

$NombreProducto = $_POST['NombreProducto']; // Match with the HTML form input names
$Stock = $_POST['Stock']; // Match with the HTML form input names


$sql = "UPDATE tblProductos SET NombreProducto='$NombreProducto', Stock='$Stock' WHERE IdProducto=$IdProducto";

if ($conexion->query($sql) === TRUE) {
    header('Location: ../../vista/html/productos.php');
} else {
    echo "Error al actualizar el registro: " . $conexion->error;
}

$conexion->close();
?>