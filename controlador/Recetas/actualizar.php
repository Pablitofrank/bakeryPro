<?php
include '../../modelo/conexion.php';

$idReceta = $_POST['idReceta']; // Change 'id' to the correct name used in your HTML form
$cantidadInsumo = $_POST['cantidadInsumo']; // Match with the HTML form input names
$idProducto = $_POST['idProducto']; // Match with the HTML form input names
$idInsumo = $_POST['idInsumo'];

$sql = "UPDATE tblrecetas SET CantidadInsumo='$cantidadInsumo', IdProducto='$idProducto', IdInsumo='$idInsumo' WHERE IdReceta=$idReceta";

if ($conexion->query($sql) === TRUE) {
    header('Location: ../../vista/html/recetas.php');
} else {
    echo "Error al actualizar el registro: " . $conexion->error;
}

$conexion->close();
?>
