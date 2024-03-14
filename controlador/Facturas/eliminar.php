<?php
include '../../modelo/conexion.php';

if (isset($_GET['numero_factura'])) {
    $numeroFactura = $_GET['numero_factura'];

    $sql = "DELETE FROM tblfactura WHERE NumeroFactura = '$numeroFactura'";

    if ($conexion->query($sql) === TRUE) {
        echo "Factura eliminada con éxito.";
        header('Location: consultar.php');
    } else {
        echo "Error al eliminar la factura: " . $conexion->error;
    }
} else {
    echo "No se proporcionó un número de factura para eliminar.";
}

$conexion->close();
?>
