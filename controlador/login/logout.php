<?php
    session_start();
    // Destruir todas las variables de sesión
    session_destroy();
    // Redirigir al usuario a la página de inicio de sesión o a donde desees
    header("Location: ../../index.php"); // Cambia "index.php" por la página a la que deseas redirigir al usuario
    exit;
?>