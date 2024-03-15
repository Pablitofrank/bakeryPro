<?php
    session_start();
    if (!isset($_SESSION['cedula'])) {
        header("Location: ../../index.php");
        exit;
    }

    // Conexión a la base de datos (reemplaza los valores de conexión con los tuyos)
    $servername = "localhost";
    $username = "root"; // Cambia esto por tu nombre de usuario de MySQL
    $password = ""; // Cambia esto por tu contraseña de MySQL
    $dbname = "bakerypro";

    // Crear conexión
    $conexion = mysqli_connect($servername, $username, $password, $dbname);

    // Verificar la conexión
    if (!$conexion) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    // Recibir los datos del formulario
    $numeroFactura = $_POST['NumeroFactura'];
    $fecha = $_POST['fecha'];
    $insumo = $_POST['insumo'];
    $cantidad = $_POST['cantidad'];
    $proveedor = $_POST['proveedor'];
    $unidad = $_POST['unidad'];

    // Actualizar los datos en la base de datos
    $sql = "UPDATE tblfactura SET Fecha='$fecha', IdInsumo=$insumo, CantidadInsumo=$cantidad, IdProveedor=$proveedor, IdUnidadMedida=$unidad WHERE NumeroFactura='$numeroFactura'";

    if (mysqli_query($conexion, $sql)) {
        echo "Los datos se actualizaron correctamente.";
    } else {
        echo "Error al actualizar los datos: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
?>
