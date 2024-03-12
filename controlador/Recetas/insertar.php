<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    
    // Verificar si se recibieron datos del formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Incluir el archivo de conexión a la base de datos
        include '../../modelo/conexion.php';
        
        // Obtener el nombre del producto desde el formulario
        $nombreProducto = $_POST['Producto'];

        // Insertar el producto en la tabla tblProductos
        $sqlProducto = "INSERT INTO tblproductos (NombreProducto) VALUES ('$nombreProducto')";
        if ($conexion->query($sqlProducto) === TRUE) {
            $idProducto = $conexion->insert_id; // Obtener el ID del producto recién insertado

            // Obtener el nombre de la receta desde el formulario
            $nombreReceta = $_POST['Producto'];

            // Verificar si los insumos y sus cantidades fueron proporcionados
            if (isset($_POST['NombreInsumo']) && isset($_POST['cantidadInsumo'])) {
                // Obtener los insumos y sus cantidades desde el formulario
                $nombreInsumos = $_POST['NombreInsumo'];
                $cantidadesInsumos = $_POST['cantidadInsumo'];
                
                // Insertar la receta en la tabla tblRecetas
                $sqlReceta = "INSERT INTO tblrecetas (CantidadInsumo, IdProducto, IdInsumo) VALUES ";

                for ($i = 0; $i < count($nombreInsumos); $i++) {
                    $nombreInsumo = $nombreInsumos[$i];
                    $cantidadInsumo = $cantidadesInsumos[$i];
                    
                    // Verificar si el IdInsumo existe en la tabla tblInsumos
                    $sqlCheckInsumo = "SELECT IdInsumo FROM tblinsumos WHERE IdInsumo = '$nombreInsumo'";
                    $resultCheckInsumo = $conexion->query($sqlCheckInsumo);

                    if ($resultCheckInsumo->num_rows > 0) {
                        // Si el IdInsumo existe, agregarlo a la consulta SQL de tblRecetas
                        $sqlReceta .= "('$cantidadInsumo', '$idProducto', '$nombreInsumo'),";
                    } else {
                        echo "El insumo con IdInsumo '$nombreInsumo' no existe en la tabla tblinsumos.";
                        exit(); // Terminar la ejecución del script si el insumo no existe
                    }
                }

                // Eliminar la coma final de la consulta SQL
                $sqlReceta = rtrim($sqlReceta, ',');

                // Ejecutar la consulta SQL para insertar en tblRecetas
                if (!$conexion->query($sqlReceta)) {
                    echo "Error al insertar la receta: " . $conexion->error;
                    exit(); // Terminar la ejecución del script si hay un error al insertar la receta
                }

                // Cerrar la conexión a la base de datos
                $conexion->close();

                // Redireccionar al usuario a la página de éxito o cualquier otra página deseada
                header('Location: ../../vista/html/recetas.php');
                exit(); // Terminar la ejecución del script después de la redirección
            } else {
                // Si no se proporcionaron los insumos y sus cantidades, mostrar un mensaje de error y terminar la ejecución del script
                echo "Error: no se proporcionaron los insumos y sus cantidades.";
                exit();
            }
        } else {
            echo "Error al insertar el producto: " . $conexion->error;
            exit(); // Terminar la ejecución del script si hay un error al insertar el producto
        }
    } else {
        // Si no se recibieron datos del formulario, redirigir al usuario a una página de error o cualquier otra página deseada
        header("Location: ../error.php");
        exit(); // Terminar la ejecución del script después de la redirección
    }
?>
