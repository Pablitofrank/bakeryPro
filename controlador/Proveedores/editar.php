<?php
include '../../modelo/conexion.php' ;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Proveedores</title>
    <link rel="stylesheet" type="text/css" href="../../vista/style/styles.css">
</head>
<body>
    <div class="container">
        <h2>Editar Proveedores</h2>

        <?php
        include '../../modelo/conexion.php';

        if (isset($_GET['IdProveedores'])) {
            $id = $_GET['IdProveedores'];
            $sql = "SELECT * FROM tblproveedores";
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
            <input type="hidden" name="IdProveedores" value="<?php echo $fila['IdProveedores']; ?>">
            NIT: <input type="text" name="NIT" value="<?php echo $fila['NIT']; ?>"><br>
            Razon social: <input type="text" name="RazonSocial" value="<?php echo $fila['RazonSocial']; ?>"><br>
            Contacto: <input type="text" name="Contacto" value="<?php echo $fila['Contacto']; ?>"><br>
            Telefono: <input type="text" name="Telefono" value="<?php echo $fila['Telefono']; ?>"><br>
            Correo: <input type="text" name="Correo" value="<?php echo $fila['Correo']; ?>"><br>
            Direccion: <input type="text" name="Direccion" value="<?php echo $fila['Direccion']; ?>"><br>
            <input type="submit" value="Actualizar">
        </form>
    </div>
</body>
</html>
