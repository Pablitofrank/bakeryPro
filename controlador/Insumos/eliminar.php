<?php
include '../../modelo/conexion.php';

if (isset($_GET['idInsumo'])) {
    $idInsumo = $_GET['idInsumo'];

    $sql = "DELETE FROM tblinsumos WHERE idInsumo = $idInsumo";

    if ($conexion->query($sql) === TRUE) {
        echo "Insumo eliminado con éxito.";
    } else {
        echo "Error al eliminar el Insumo: " . $conexion->error;
    }
} else {
    echo "No se encontraron usuarios registrados.";
}

$conexion->close();
?>