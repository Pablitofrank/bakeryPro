<?php
include '../../modelo/conexion.php';

if (isset($_GET['idProveedores'])) {
    $idUsuario = $_GET['idProveedores'];

    $sql = "DELETE FROM tblproveedores WHERE IdProveedores = $idProveedores";

    if ($conexion->query($sql) === TRUE) {
        echo "Usuario eliminado con éxito.";
    } else {
        echo "Error al eliminar el usuario: " . $conexion->error;
    }
} else {
    echo "No se proporcionó un ID de usuario para eliminar.";
}

$conexion->close();
?>