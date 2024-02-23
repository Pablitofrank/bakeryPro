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
        <h2>Editar Usuario</h2>

        <?php
        include '../../modelo/conexion.php';

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM tblusuario INNER JOIN tblroles ON tblusuario.IdRol = tblroles.IdRol WHERE IdUsuario=$id";
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
            <input type="hidden" name="id" value="<?php echo $fila['IdUsuario']; ?>">
            Nombres: <input type="text" name="nombres" value="<?php echo $fila['Nombres']; ?>"><br>
            Apellidos: <input type="text" name="apellidos" value="<?php echo $fila['Apellidos']; ?>"><br>
            <?php
            include '../../modelo/conexion.php';
            $sql = "SELECT * FROM tblroles";
            $result = $conexion->query($sql);

            // Recorrer datos y crear options
            echo "<label for='rol'>Rol:</label>
    
            <select name='rol' id='opcion'>";
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["IdRol"] . "'>" . $row["Rol"] . "</option>";
                }
            } else {
                echo "0 results";
            }
            echo "</select>";
            ?>
            Cedula: <input type="text" name="cedula" value="<?php echo $fila['Cedula']; ?>"><br>
            Telefono: <input type="text" name="telefono" value="<?php echo $fila['Telefono']; ?>"><br>
            <input type="submit" value="Actualizar">
        </form>
    </div>
</body>
</html>
