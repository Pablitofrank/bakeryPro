<?php
include '../../modelo/conexion.php';

$NombreInsumo = $_POST['NombreInsumo']; // Match with the HTML form input names
$Stock = $_POST['Stock']; // Match with the HTML form input names
$IdInsumo = $_POST['IdInsumo'];

$sql = "UPDATE tblinsumos SET NombreInsumo='$NombreInsumo', Stock='$Stock' WHERE IdInsumo=$IdInsumo";

if ($conexion->query($sql) === TRUE) {
    header('Location: ../../vista/html/insumos.php');
} else {
    echo "Error al actualizar el registro: " . $conexion->error;
}

$conexion->close();
?>
