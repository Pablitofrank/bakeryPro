<?php
    // Verificar si se ha proporcionado un IdProducto
    if(isset($_POST['IdProducto'])) {
        $idProducto = $_POST['IdProducto'];

        // Incluir el archivo de conexión a la base de datos
        include '../../modelo/conexion.php';

        // Eliminar la receta de la tabla tblrecetas
        $sqlEliminarReceta = "DELETE FROM tblrecetas WHERE IdProducto = $idProducto";
        if ($conexion->query($sqlEliminarReceta) === TRUE) {
            // Eliminar el producto de la tabla tblproductos
            $sqlEliminarProducto = "DELETE FROM tblproductos WHERE IdProducto = $idProducto";
            if ($conexion->query($sqlEliminarProducto) === TRUE) {
                // Redireccionar a la página de consulta de recetas con un mensaje de éxito
                header("Location: ./consultar.php");
                exit();
            } else {
                // Redireccionar a la página de consulta de recetas con un mensaje de error
                header("Location: recetas.php?error=Error al eliminar el producto asociado a la receta");
                exit();
            }
        } else {
            // Redireccionar a la página de consulta de recetas con un mensaje de error
            header("Location: recetas.php?error=Error al eliminar la receta");
            exit();
        }

        // Cerrar la conexión a la base de datos
        $conexion->close();
    } else {
        // Redireccionar a la página de consulta de recetas si no se ha proporcionado un IdProducto
        header("Location: recetas.php");
        exit();
    }
?>
