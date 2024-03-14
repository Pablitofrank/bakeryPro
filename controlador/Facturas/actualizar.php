<?php
include '../../modelo/conexion.php';

$idFactura = $_POST['idFactura'];
$cantidadInsumo = $_POST['cantidadInsumo'];
$numeroFactura = $_POST['numeroFactura'];
$fecha = $_POST['fecha'];
$idInsumo = $_POST['idInsumo'];
$idProveedor = $_POST['idProveedor'];
$idUnidadMedida = $_POST['idUnidadMedida'];

$sql = "UPDATE tblfactura SET 
        CantidadInsumo='$cantidadInsumo', 
        NumeroFactura='$numeroFactura', 
        Fecha='$fecha', 
        idInsumo='$idInsumo', 
        IdProveedores='$idProveedor', 
        IdUnidadMedida='$idUnidadMedida' 
        WHERE IdFactura=$idFactura";

if ($conexion->query($sql) === TRUE) {
    header('Location: ./consultar.php');
} else {
    echo "Error al actualizar el registro: " . $conexion->error;
}

$conexion->close();
?>
