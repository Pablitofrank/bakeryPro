<?php
include '../../modelo/conexion.php';

$nombreProducto = $_POST['nombreProducto'];
$stock = $_POST['stock'];

// Perform input validation here if needed

$sql = "INSERT INTO tblProductos (NombreProducto, Stock) VALUES ('$nombreProducto', '$stock')";

if ($conexion->query($sql) === TRUE) {
    header('Location: ../../vista/html/producto.php');
} else {
    echo "Error: " . $sql . "<br>" . $conexion->error;
}

$conexion->close();
?>