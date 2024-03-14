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

    // Consulta para obtener el nombre del usuario y su rol
    $cedula = $_SESSION['cedula'];
    $sql = "SELECT Nombres, Apellidos, Rol FROM tblusuario INNER JOIN tblroles ON tblusuario.IdRol = tblroles.IdRol WHERE Cedula = $cedula";
    $resultado = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        // Mostrar los datos del usuario
        $fila = mysqli_fetch_assoc($resultado);
        $nombre = $fila["Nombres"] . " " . $fila["Apellidos"];
        $rol = $fila["Rol"];
    } else {
        $nombre = "Nombre de usuario";
        $rol = "Rol de usuario";
    }

    mysqli_close($conexion);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Resultado de la Consulta de Producto</title>
    <link rel="stylesheet" type="text/css" href="../../vista/style/styles.css">
</head>
<body>
    <div class="container">
    <h2>Resultado de la Consulta de Producto</h2>
    <?php
    include '../../modelo/conexion.php';
        $sql = "SELECT NombreProducto, Stock FROM tblproductos";
        $resultado = $conexion->query($sql);
    ?>

    <?php if ($resultado->num_rows > 0) { ?>
        <table border="1">
            <tr>
                <th>Nombre Producto</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
            <?php while ($fila = $resultado->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $fila['NombreProducto']; ?></td>
                    <td><?php echo $fila['Stock']; ?></td>
                    <td>
                        <a href='editar.php?id=<?php echo $fila["idProducto"]; ?>'>Editar</a> | 
                        <a href='eliminar.php?id=<?php echo $fila["idProducto"]; ?>'>Eliminar</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>No se encontraron resultados para el ID proporcionado.</p>
    <?php } ?>

    <?php $conexion->close(); ?>
    <br><a href="../../index.php">VOLVER</a>
    </div>
</div>
</body>
</html>