<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bakerypro";

// Crear conexión
$conexion = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>