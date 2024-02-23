<?php
include '../../modelo/conexion.php';

if (isset($_GET['IdProducto'])) {
    $IdProducto = $_GET['IdProducto'];

    $sql = "DELETE FROM tblProductos WHERE IdProducto = $IdProducto";

    if ($conexion->query($sql) === TRUE) {
        echo "Producto  eliminado con éxito.";
    } else {
        echo "Error al eliminar el producto: " . $conexion->error;
    }
} else {
    echo "No se proporcionó un ID de usuario para eliminar.";
}

$conexion->close();
?>