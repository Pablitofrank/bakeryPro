<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../../modelo/conexion.php';

    $numeroFactura = $_POST['numeroFactura'];
    $fecha = $_POST['fecha'];
    $idProveedores = $_POST['razonSocial'];

    if (isset($_POST['NombreInsumo']) && isset($_POST['cantidadInsumo']) && isset($_POST['idUnidadMedida'])) {
        $nombreInsumos = $_POST['NombreInsumo'];
        $cantidadesInsumos = $_POST['cantidadInsumo'];
        $unidadesMedida = $_POST['idUnidadMedida'];

        $sqlFactura = "INSERT INTO tblfactura (CantidadInsumo, NumeroFactura, Fecha, IdInsumo, IdProveedor, IdUnidadMedida) VALUES ";

        for ($i = 0; $i < count($nombreInsumos); $i++) {
            $nombreInsumo = $nombreInsumos[$i];
            $cantidadInsumo = $cantidadesInsumos[$i];
            $idUnidadMedida = $unidadesMedida[$i];

            // Suponiendo que tienes el IdInsumo, de lo contrario, necesitas obtenerlo basado en el nombre del insumo
            $sqlFactura .= "('$cantidadInsumo', '$numeroFactura', '$fecha', '$nombreInsumo', '$idProveedores', '$idUnidadMedida'),";

            // Actualizar el stock de insumos
            $sqlUpdateStock = "UPDATE tblinsumos SET Stock = Stock + $cantidadInsumo WHERE IdInsumo = $nombreInsumo";
            if (!$conexion->query($sqlUpdateStock)) {
                echo "Error al actualizar el stock del insumo: " . $conexion->error;
                exit(); // Terminar la ejecución si hay un error
            }
        }

        $sqlFactura = rtrim($sqlFactura, ',');
        if (!$conexion->query($sqlFactura)) {
            echo "Error al insertar la factura: " . $conexion->error;
            exit();
        }

        $conexion->close();
        header('Location: ../../vista/html/facturas.php');
        exit();
    } else {
        echo "Error: no se proporcionaron los insumos y sus cantidades.";
        exit();
    }
} else {
    header("Location: ../error.php");
    exit();
}
?>
﻿
juande8
juande8