<!DOCTYPE html>
<html>
<head>
    <title>Resultado de la Consulta de Usuario</title>
    <link rel="stylesheet" type="text/css" href="../../vista/style/styles.css">
</head>
<body>
    <div class="container">
    <h2>Resultado de la Consulta de Usuario</h2>
    
    
    <?php
    include '../../modelo/conexion.php';
        $sql = "SELECT * FROM tblusuario INNER JOIN tblroles ON tblusuario.IdRol = tblroles.IdRol";
        $resultado = $conexion->query($sql);
    ?>
    <?php if ($resultado->num_rows > 0) { ?>
        <table border="1">
            <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Rol</th>
                <th>Cedula</th>
                <th>Telefono</th>
                <th>Acciones</th>
            </tr>
            <?php while ($fila = $resultado->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $fila["Nombres"]; ?></td>
                    <td><?php echo $fila["Apellidos"]; ?></td>
                    <td><?php echo $fila["Rol"]; ?></td>
                    <td><?php echo $fila["Cedula"]; ?></td>
                    <td><?php echo $fila["Telefono"]; ?></td>
                    <td>
                        <a href='editar.php?id=<?php echo $fila['IdUsuario']; ?>'>Editar</a>
                        <a href='eliminar.php?id=<?php echo $fila['IdUsuario']; ?>'>Eliminar</a> 
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
</body>
</html>



