<?php
include '../../modelo/conexion.php';

if (isset($_GET['idReceta'])) {
    $idReceta = $_GET['idReceta'];

    $sql = "DELETE FROM tblrecetas WHERE IdReceta = $idReceta";

    if ($conexion->query($sql) === TRUE) {
        echo "Receta eliminada con éxito.";
        header('Location: consultar.php');
        exit; // Termina el script después de redirigir
    } else {
        echo "Error al eliminar la receta: " . $conexion->error;
    }
} else {
    echo "No se proporcionó un ID de receta para eliminar.";
}

$conexion->close();
?>
