<?php
// Conexión a la base de datos

include '../../modelo/conexion.php';

// Consulta para obtener los insumos con stock por debajo de 20
$sql = "SELECT NombreInsumo, Stock FROM tblinsumos WHERE Stock < 20";
$result = $conn->query($sql);

// Arreglo para almacenar los resultados
$insumos = array();

// Obtener los resultados de la consulta
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $insumo = array(
            "NombreInsumo" => $row["NombreInsumo"],
            "Stock" => $row["Stock"]
        );
        array_push($insumos, $insumo);
    }
}

// Devolver los datos en formato JSON
echo json_encode($insumos);


$conn->close();
?>
