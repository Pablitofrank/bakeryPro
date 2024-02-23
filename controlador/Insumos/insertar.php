<?php
include '../../modelo/conexion.php';

$idInsumo = $_POST['idInsumo'];
$nombreInsumo = $_POST['nombreInsumo'];
$stock = $_POST['stock'];
$idUnidadMedida = $_POST['idUnidadMedida'];

// Perform input validation here if needed

// Check if the IdUnidadMedida exists in the referenced table
$consultaUnidadMedida = "SELECT IdUnidadMedida FROM tblUnidadesMedidas WHERE IdUnidadMedida = '$idUnidadMedida'";
$resultadoUnidadMedida = $conexion->query($consultaUnidadMedida);

if ($resultadoUnidadMedida->num_rows > 0) {
    $sql = "INSERT INTO tblInsumos (IdInsumo, NombreInsumo, Stock, IdUnidadMedida) VALUES ('$idInsumo', '$nombreInsumo', '$stock', '$idUnidadMedida')";

    if ($conexion->query($sql) === TRUE) {
        header('Location: ../../vista/html/insumos.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
} else {
    echo "Error: El valor de la clave externa IdUnidadMedida no existe en la tabla tblUnidadMedida.";
}

$conexion->close();
?>