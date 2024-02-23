<!DOCTYPE html>
<html>
<head>
    <title>Resultado de la Consulta de Insumos</title>
    <link rel="stylesheet" type="text/css" href="../../vista/style/styles.css">
</head>
<body>
    <div class="container">
    <h2>Resultado de la Consulta de Insumos</h2>
    <?php
    include '../../modelo/conexion.php';

    if (isset($_POST['idInsumo'])) {
        $idInsumo = $_POST['idInsumo'];
        $sql = "SELECT * FROM tblinsumos INNER JOIN tblUnidadesMedidas ON tblinsumos.IdUnidadMedida = tblUnidadesMedidas.IdUnidadMedida WHERE IdInsumo=$idInsumo";
        $resultado = $conexion->query($sql);
    } else {
        echo "<p>FDGDFG.</p>";
        exit;
    }
    ?>

    <?php if ($resultado->num_rows > 0) { ?>
        <table border="1">
            <tr>
                <th>ID Insumo</th>
                <th>Nombre Insumo</th>
                <th>Stock</th>
                <th>ID Unidad Medida</th>
                <th>Acciones</th>
            </tr>
            <?php while ($fila = $resultado->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $fila['IdInsumo']; ?></td>
                    <td><?php echo $fila["NombreInsumo"]; ?></td>
                    <td><?php echo $fila["Stock"]; ?></td>
                    <td><?php echo $fila["medida"]; ?></td>
                    <td>
                        <a href='eliminar.php?idInsumo=<?php echo $fila["IdInsumo"]; ?>'>Eliminar</a>
                        <a href='editar.php?idInsumo=<?php echo $fila["IdInsumo"]; ?>'>EDITAR</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>No se encontraron resultados para el ID de insumo proporcionado.</p>
    <?php } ?>

    <?php $conexion->close(); ?>
    </div>
</body>
</html>