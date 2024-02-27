<?php
include '../../modelo/conexion.php';

// Fetch data from the form
$nombreInsumo = $_POST['nombreInsumo'];
$stock = $_POST['stock'];
$idUnidadMedida = $_POST['idUnidadMedida'];

// Perform input validation if needed

// Check if the IdUnidadMedida exists in the referenced table
$consultaUnidadMedida = "SELECT IdUnidadMedida FROM tblUnidadesMedidas WHERE IdUnidadMedida = '$idUnidadMedida'";
$resultadoUnidadMedida = $conexion->query($consultaUnidadMedida);

if ($resultadoUnidadMedida->num_rows > 0) {
    // Insert the new insumo
    $sql = "INSERT INTO tblInsumos (NombreInsumo, Stock, IdUnidadMedida) VALUES ('$nombreInsumo', '$stock', '$idUnidadMedida')";

    if ($conexion->query($sql) === TRUE) {
        // Redirect after successful insertion
        header('Location: ../../vista/html/insumos.php');
        exit(); // Ensure script stops execution after redirection
    } else {
        // Handle database insertion error
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
} else {
    // Error message for invalid IdUnidadMedida
    echo "Error: El valor de la clave externa IdUnidadMedida no existe en la tabla tblUnidadMedida.";
}

$conexion->close();
?>
