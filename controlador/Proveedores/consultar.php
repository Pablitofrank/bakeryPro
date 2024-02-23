<!DOCTYPE html>
<html>
<head>
    <title>Resultado de la Consulta de Proveedores</title>
    <link rel="stylesheet" type="text/css" href="../../vista/style/styles.css">
</head>
<body>
    <div class="container">
    <h2>Resultado de la Consulta de Proveedores</h2>
    
    
    <?php
    include '../../modelo/conexion.php';

    if (isset($_POST['idProveedores'])) {
        $id = $_POST['idProveedores'];
        $sql = "SELECT * FROM tblproveedores INNER JOIN tblroles ON tblusuario.IdRol = tblroles.IdRol WHERE IdProveedores=$idProveedores";
        $resultado = $conexion->query($sql);
    } else {
        echo "<p>Ingrese un ID para realizar la consulta.</p>";
        exit;
    }
    ?>

    <?php if ($resultado->num_rows > 0) { ?>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>NIT</th>
                <th>Razon social</th>
                <th>Contacto</th>
                <th>Telefono</th>
                <th>Correo</th>
                <th>Direccion</th>
                <th>Acciones</th>

            </tr>
            <?php while ($fila = $resultado->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $fila['IdProveedores']; ?></td>
                    <td><?php echo $fila["NIT"]; ?></td>
                    <td><?php echo $fila["RazonSocial"]; ?></td>
                    <td><?php echo $fila["Contacto"]; ?></td>
                    <td><?php echo $fila["Telefono"]; ?></td>
                    <td><?php echo $fila["Correo"]; ?></td>
                    <td><?php echo $fila["Direccion"]; ?></td>
                    <td>
                        <a href='editar.php?id=<?php echo $fila['IdUsuario']; ?>'>EDITAR</a>
                        <a href='eliminar.php?id=<?php echo $fila['IdUsuario']; ?>'>Eliminar</a>  
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>No se encontraron resultados para el ID proporcionado.</p>
    <?php } ?>

    <?php $conexion->close(); ?>
    </div>
</body>
</html>



