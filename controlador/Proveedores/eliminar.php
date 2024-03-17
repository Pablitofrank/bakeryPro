<?php
include '../../modelo/conexion.php';

if (isset($_POST['IdProveedores'])) {
    $IdProveedores = $_POST['IdProveedores'];

    $sql = "DELETE FROM tblproveedores WHERE IdProveedores = $IdProveedores";

    if ($conexion->query($sql) === TRUE) {
        echo "Proveedor eliminado con éxito.";
        header('Location: consultar.php');
    } else {
        echo "Error al eliminar el Proveedor: " . $conexion->error;
    }
} else {
    echo "No se proporcionó un ID de Proveedor para eliminar.";
}

$conexion->close();
?>