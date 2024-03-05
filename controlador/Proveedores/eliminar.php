<?php
include '../../modelo/conexion.php';

if (isset($_GET['IdProveedores'])) {
    $IdProveedores = $_GET['IdProveedores'];

    $sql = "DELETE FROM tblproveedores WHERE IdProveedores = $IdProveedores";

    if ($conexion->query($sql) === TRUE) {
        echo "Proveedor eliminado con éxito.";
    } else {
        echo "Error al eliminar el Proveedor: " . $conexion->error;
    }
} else {
    echo "No se proporcionó un ID de Proveedor para eliminar.";
}

$conexion->close();
?>