<?php
    include '../../modelo/conexion.php';

    if (isset($_POST['IdUsuario'])) {
        $IdUsuario = $_POST['IdUsuario'];

        $sql = "DELETE FROM tblusuario WHERE IdUsuario = $IdUsuario";

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
