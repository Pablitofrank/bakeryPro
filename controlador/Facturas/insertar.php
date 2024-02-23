<?php
include '../../modelo/conexion.php';

$cantidadInsumo = $_POST['cantidadInsumo'];
$numeroFactura = $_POST['numeroFactura'];
$fecha = $_POST['fecha'];
$idInsumo = $_POST['insumo']; // Asegúrate de que el nombre del campo del formulario coincida

// Verifica si el valor de $idInsumo existe en la tabla tblinsumos antes de la inserción
$consultaInsumo = "SELECT IdInsumo FROM tblinsumos WHERE IdInsumo = '$idInsumo'";
$resultadoInsumo = $conexion->query($consultaInsumo);

if ($resultadoInsumo->num_rows > 0) {
    $sql = "INSERT INTO tblfactura (CantidadInsumo, NumeroFactura, Fecha, IdInsumo) VALUES ('$cantidadInsumo', '$numeroFactura', '$fecha', '$idInsumo')";

    if ($conexion->query($sql) === TRUE) {
        header('Location: ../../vista/html/factura.php');
        echo 'El registro se insertó correctamente en la tabla tblfactura.';
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
} else {
    echo "Error: El valor de la clave externa no existe en la tabla tblinsumos.";
}

$conexion->close();
?>