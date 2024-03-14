<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir el archivo de conexión a la base de datos
    include '../../modelo/conexion.php';

    // Obtener los datos del formulario
    $numeroFactura = $_POST['numeroFactura'];
    $fecha = $_POST['fecha'];
    $idProveedores = $_POST['razonSocial'];

    // Insertar la factura en la tabla tblfactura
    $sqlFactura = "INSERT INTO tblfactura (CantidadInsumo, NumeroFactura, Fecha, idInsumo, IdProveedores, IdUnidadMedida) VALUES ";

    // Verificar si se recibieron insumos y cantidades del formulario
    if (isset($_POST['NombreInsumo']) && isset($_POST['cantidadInsumo']) && isset($_POST['idUnidadMedida'])) {
        $nombreInsumos = $_POST['NombreInsumo'];
        $cantidadesInsumos = $_POST['cantidadInsumo'];
        $unidadesMedida = $_POST['idUnidadMedida'];

        // Insertar cada insumo y cantidad en la factura
        for ($i = 0; $i < count($nombreInsumos); $i++) {
            $nombreInsumo = $nombreInsumos[$i];
            $cantidadInsumo = $cantidadesInsumos[$i];
            $idUnidadMedida = $unidadesMedida[$i];

            // Insertar valores en la factura
            $sqlFactura .= "('$cantidadInsumo', '$numeroFactura', '$fecha', '$nombreInsumo', '$idProveedores', '$idUnidadMedida'),";
        }

        // Eliminar la coma final de la consulta SQL
        $sqlFactura = rtrim($sqlFactura, ',');

        // Ejecutar la consulta SQL para insertar en tblfactura
        if (!$conexion->query($sqlFactura)) {
            echo "Error al insertar la factura: " . $conexion->error;
            exit(); // Terminar la ejecución del script si hay un error al insertar la factura
        }

        // Cerrar la conexión a la base de datos
        $conexion->close();

        // Redireccionar al usuario a la página deseada
        header('Location: ../../vista/html/facturas.php');
        exit(); // Terminar la ejecución del script después de la redirección
    } else {
        // Si no se proporcionaron los insumos y cantidades, mostrar un mensaje de error
        echo "Error: no se proporcionaron los insumos y sus cantidades.";
        exit();
    }
} else {
    // Si no se recibieron datos del formulario, redirigir al usuario a una página de error
    header("Location: ../error.php");
    exit(); // Terminar la ejecución del script después de la redirección
}
?>
