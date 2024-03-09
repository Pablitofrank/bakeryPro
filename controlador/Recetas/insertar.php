<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    
    // Verificar si se recibieron datos del formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Incluir el archivo de conexión a la base de datos
        include '../../modelo/conexion.php';
        
        // Obtener el nombre de la receta desde el formulario
        $nombreReceta = $_POST['NombreProducto'];
        
        // Verificar si los insumos y sus cantidades fueron proporcionados
        if (isset($_POST['NombreInsumo']) && isset($_POST['cantidadInsumo'])) {
            // Obtener los insumos y sus cantidades desde el formulario
            $nombreInsumos = $_POST['NombreInsumo'];
            $cantidadesInsumos = $_POST['cantidadInsumo'];
            
            // Insertar la receta en la tabla tblRecetas
            $sqlReceta = "INSERT INTO tblrecetas (NombreReceta) VALUES ('$nombreReceta')";
            if ($conexion->query($sqlReceta) === TRUE) {
                $idReceta = $conexion->insert_id; // Obtener el ID de la receta recién insertada
                
                // Insertar los insumos y sus cantidades en la tabla tblRecetas
                for ($i = 0; $i < count($nombreInsumos); $i++) {
                    $nombreInsumo = $nombreInsumos[$i];
                    $cantidadInsumo = $cantidadesInsumos[$i];
                    
                    // Verificar si el IdInsumo existe en la tabla tblInsumos
                    $sqlCheckInsumo = "SELECT IdInsumo FROM tblInsumos WHERE IdInsumo = '$nombreInsumo'";
                    $resultCheckInsumo = $conexion->query($sqlCheckInsumo);

                    if ($resultCheckInsumo->num_rows > 0) {
                        // Si el IdInsumo existe, insertarlo en la tabla tblRecetas
                        $sqlInsertInsumo = "INSERT INTO tblrecetas (IdReceta, IdInsumo, CantidadInsumo) VALUES ('$idReceta', '$nombreInsumo', '$cantidadInsumo')";
                        if (!$conexion->query($sqlInsertInsumo)) {
                            echo "Error al insertar el insumo: " . $conexion->error;
                            exit(); // Terminar la ejecución del script si hay un error
                        }
                    } else {
                        echo "El insumo con IdInsumo '$nombreInsumo' no existe en la tabla tblInsumos.";
                        exit(); // Terminar la ejecución del script si el insumo no existe
                    }
                }
                
                // Cerrar la conexión a la base de datos
                $conexion->close();
                
                // Redireccionar al usuario a la página de éxito o cualquier otra página deseada
                header('Location: ../../vista/html/recetas.php');
                exit(); // Terminar la ejecución del script después de la redirección
            } else {
                echo "Error al insertar la receta: " . $conexion->error;
                exit(); // Terminar la ejecución del script si hay un error al insertar la receta
            }
        } else {
            // Si no se proporcionaron los insumos y sus cantidades, mostrar un mensaje de error y terminar la ejecución del script
            echo "Error: no se proporcionaron los insumos y sus cantidades.";
            exit();
        }
    } else {
        // Si no se recibieron datos del formulario, redirigir al usuario a una página de error o cualquier otra página deseada
        header("Location: ../error.php");
        exit(); // Terminar la ejecución del script después de la redirección
    }
?>
