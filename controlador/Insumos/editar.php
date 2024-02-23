<?php
include '../../modelo/conexion.php' ;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Usuario</title>
    <link rel="stylesheet" type="text/css" href="../../vista/style/styles.css">
</head>
<body>
    <div class="container">
        <h2>Editar Insumo</h2>

        <?php
        include '../../modelo/conexion.php';

        if (isset($_GET['idInsumo'])) {
            $idInsumo= $_GET['idInsumo'];
            
            $sql = "SELECT * FROM tblinsumos INNER JOIN tblUnidadesMedidas ON tblinsumos.IdUnidadMedida = tblUnidadesMedidas.IdUnidadMedida WHERE IdInsumo=$idInsumo";
            $resultado = $conexion->query($sql);

            if ($resultado->num_rows > 0) {
                $fila = $resultado->fetch_assoc();
            } else {
                echo "<p>No se encontraron resultados para el ID proporcionado.</p>";
                exit;
            }
        } else {
            echo "<p>Ingrese un ID para realizar la consulta.</p>";
            exit;
        }
        ?>
        <form action="actualizar.php" method="post">
        <input type="hidden" name="IdInsumo" value="<?php echo $fila['IdInsumo']; ?>">
            NombreInsumo: <input type="text" name="NombreInsumo" value="<?php echo $fila['NombreInsumo']; ?>"><br>
            Stock: <input type="text" name="Stock" value="<?php echo $fila['Stock']; ?>"><br>
            Medida: <input type="text" name="medida" value="<?php echo $fila['medida']; ?>"><br>
            
            <input type="submit" value="Actualizar">
        </form>
    </div>
</body>
</html>
