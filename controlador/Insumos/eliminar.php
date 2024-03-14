<?php
include '../../modelo/conexion.php';

// Desactivar las restricciones de clave externa
$sql_disable_fk_checks = "SET FOREIGN_KEY_CHECKS=0";
$conexion->query($sql_disable_fk_checks);

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

// Volver a activar las restricciones de clave externa
$sql_enable_fk_checks = "SET FOREIGN_KEY_CHECKS=1";
$conexion->query($sql_enable_fk_checks);

$conexion->close();
?>
