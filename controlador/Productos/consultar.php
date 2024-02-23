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