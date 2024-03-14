<?php
include '../../modelo/conexion.php';

$IdProducto = $_POST['IdProducto'];
$NombreProducto = $_POST['NombreProducto'];
$IdInsumo = $_POST['IdInsumo'];
$NombreInsumo = $_POST['NombreInsumo'];
$CantidadInsumo = $_POST['CantidadInsumo'];
$medida = $_POST['medida'];
$medidaIdUnidadMedida = $_POST['medidaIdUnidadMedida']; // Obtener el ID de la unidad de medida seleccionada

// Actualizar tabla de recetas
$sqlRecetas = "UPDATE tblrecetas SET CantidadInsumo='$CantidadInsumo', IdInsumo='$IdInsumo' WHERE IdProducto=$IdProducto";

// Actualizar tabla de productos
$sqlProductos = "UPDATE tblproductos SET NombreProducto='$NombreProducto' WHERE IdProducto=$IdProducto";

$sqlMedida = "UPDATE tblrecetas SET IdUnidadMedida='$medidaIdUnidadMedida' WHERE IdProducto=$IdProducto";

// Ejecutar consultas
if ($conexion->query($sqlRecetas) === TRUE && $conexion->query($sqlProductos) === TRUE && $conexion->query($sqlMedida) === TRUE) {
    header('Location: ./consultar.php');
} else {
    echo "Error al actualizar el registro: " . $conexion->error;
}

$conexion->close();
?>
