<?php
// Railway inyecta estas variables automáticamente si las configuramos
$servername = getenv('servername') ?: "localhost";
$username   = getenv('username') ?: "root";
$password   = getenv('password') ?: "";
$dbname     = getenv('dbname') ?: "bakerypro";
$port       = getenv('MYSQLPORT') ?: 3306; 

// Es vital incluir el puerto para conexiones en la nube
$conexion = new mysqli($servername, $username, $password, $dbname, $port);

if ($conexion->connect_error) {
    // Esto te ayudará a ver el error real en los logs de Railway
    error_log("Fallo de conexión: " . $conexion->connect_error);
    die("Error interno del servidor.");
}
?>
