<?php
include '../../modelo/conexion.php';

if (isset($_GET['id'])) {
    $idUsuario = $_GET['id'];

    $sql = "DELETE FROM tblusuario WHERE IdUsuario = $idUsuario";

    if ($conexion->query($sql) === TRUE) {
        echo "Usuario eliminado con éxito.";
        header('Location: consultar.php');
    } else {
        echo "Error al eliminar el usuario: " . $conexion->error;
    }
} else {
    echo "No se proporcionó un ID de usuario para eliminar.";
}

$conexion->close();
?>