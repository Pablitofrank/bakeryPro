<?php
include '../../modelo/conexion.php';

// Desactivar las restricciones de clave externa
$sql_disable_fk_checks = "SET FOREIGN_KEY_CHECKS=0";
$conexion->query($sql_disable_fk_checks);

if (isset($_POST['IdInsumo'])) {
    $IdInsumo = $_POST['IdInsumo'];

    $sql = "DELETE FROM tblinsumos WHERE IdInsumo = $IdInsumo";

    if ($conexion->query($sql) === TRUE) {
        echo "Insumo eliminado con éxito.";
        header('Location: consultar.php');
    } else {
        echo "Error al eliminar el Insumo: " . $conexion->error;
    }
} else {
    echo "No se encontraron insumos registrados.";
}

// Volver a activar las restricciones de clave externa
$sql_enable_fk_checks = "SET FOREIGN_KEY_CHECKS=1";
$conexion->query($sql_enable_fk_checks);

$conexion->close();
?>
