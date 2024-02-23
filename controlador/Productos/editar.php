<?php
include '../../modelo/conexion.php' ;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Producto</title>
    <link rel="stylesheet" type="text/css" href="../../vista/style/styles.css">
</head>
<body>
    <div class="container">
        <h2>Editar Producto</h2>

        <?php
        include '../../modelo/conexion.php';

        if (isset($_GET['IdProducto'])) {
            $IdProducto = $_GET['IdProducto'];
            $sql =  $sql = "SELECT * FROM tblproductos WHERE IdProducto=$IdProducto";
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
            <input type="hidden" name="IdProducto" value="<?php echo $fila['IdProducto']; ?>">
            NombreProducto: <input type="text" name="NombreProducto" value="<?php echo $fila['NombreProducto']; ?>"><br>
            Stock: <input type="text" name="Stock" value="<?php echo $fila['Stock']; ?>"><br>
           
            <input type="submit" value="Actualizar">
        </form>
    </div>
</body>
</html>