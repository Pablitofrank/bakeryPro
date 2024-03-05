<?php
// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bakerypro";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    // Obtiene los datos del formulario
    $nombreReceta = $_POST["NombreProducto"];
    $cantidadInsumos = $_POST["cantidadInsumo"];

    // Prepara la consulta SQL para insertar en la tabla tblrecetas
    $sql = "INSERT INTO tblrecetas (NombreReceta, CantidadInsumo) VALUES (?, ?)";
    
    // Prepara la declaración
    $stmt = $conn->prepare($sql);

    // Vincula los parámetros y ejecuta la declaración para cada cantidad de insumo
    foreach ($cantidadInsumos as $cantidadInsumo) {
        // Vincula los parámetros con los valores actuales
        $stmt->bind_param("ss", $nombreReceta, $cantidadInsumo);
        // Ejecuta la consulta
        $stmt->execute();
    }

    // Cierra la declaración y la conexión
    $stmt->close();
    $conn->close();

    echo "Recetas agregadas correctamente.";
}
?>