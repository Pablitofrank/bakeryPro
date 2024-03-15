<?php
    // Verificar si se han enviado datos por el método POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verificar si se ha proporcionado un IdProducto
        if(isset($_POST['IdProducto'])) {
            $idProducto = $_POST['IdProducto'];

            // Incluir el archivo de conexión a la base de datos
            include '../../modelo/conexion.php';

            // Recorrer los datos enviados para actualizar cada insumo
            foreach ($_POST as $key => $value) {
                // Verificar si el nombre del campo comienza con "cantidad_"
                if (strpos($key, 'cantidad_') === 0) {
                    // Extraer el IdInsumo del nombre del campo
                    $idInsumo = substr($key, strlen('cantidad_'));

                    // Obtener la cantidad y unidad de medida del insumo
                    $cantidad = $_POST[$key];
                    $unidad = $_POST['unidad_'.$idInsumo];

                    // Consultar el IdUnidadMedida correspondiente a la unidad seleccionada
                    $sqlUnidad = "SELECT IdUnidadMedida FROM tblunidadesmedidas WHERE medida = '$unidad'";
                    $resultadoUnidad = $conexion->query($sqlUnidad);
                    if ($resultadoUnidad->num_rows > 0) {
                        $filaUnidad = $resultadoUnidad->fetch_assoc();
                        $idUnidad = $filaUnidad['IdUnidadMedida'];

                        // Actualizar la cantidad del insumo en la tabla tblrecetas
                        $sqlActualizar = "UPDATE tblrecetas SET CantidadInsumo = $cantidad, IdUnidadMedida = $idUnidad WHERE IdProducto = $idProducto AND IdInsumo = $idInsumo";
                        $conexion->query($sqlActualizar);
                    }
                }
            }

            // Cerrar la conexión a la base de datos
            $conexion->close();

            // Redireccionar a la página de consulta de recetas con un mensaje de éxito
            header("Location: consultar.php?mensaje=Insumos actualizados correctamente");
            exit();
        } else {
            // Redireccionar a la página de consulta de recetas con un mensaje de error
            header("Location: recetas.php?error=No se proporcionó un IdProducto para actualizar");
            exit();
        }
    } else {
        // Redireccionar a la página de consulta de recetas si no se ha enviado por POST
        header("Location: recetas.php");
        exit();
    }
?>
