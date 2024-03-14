<?php
include '../../modelo/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Verificar si se recibió el ID del producto
    if (isset($_GET['IdProducto'])) {
        $idProducto = $_GET['IdProducto'];
        
        // Consulta SQL para obtener los datos de la receta
        $sql = "SELECT r.*, i.NombreInsumo, um.medida, p.NombreProducto
        FROM tblrecetas AS r
        INNER JOIN tblinsumos AS i ON r.IdInsumo = i.IdInsumo
        INNER JOIN tblunidadesmedidas AS um ON r.IdUnidadMedida = um.IdUnidadMedida
        INNER JOIN tblproductos AS p ON r.IdProducto = p.IdProducto
        WHERE r.IdProducto = $idProducto";

        // Ejecutar la consulta
        $resultado = $conexion->query($sql);

        // Verificar si se encontraron resultados
        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
        } else {
            echo "<p>No se encontraron resultados para el ID proporcionado.</p>";
            exit;
        }
    } else {
        echo "<p>Ingrese un ID de producto para realizar la consulta.</p>";
        exit;
    }
} else {
    // Si no se envió una solicitud GET, mostrar un mensaje de error
    echo "Acceso no autorizado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Recetas</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Fugaz+One&family=Inter:wght@100&family=Quicksand:wght@300;500;700&display=swap" rel="stylesheet">

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../vista/style/styles.css">
    <link rel="shortcut icon" href="../../vista/img/logo.svg" type="image/x-icon">
</head>
<body>
<div class="sidebar open">
        <div class="logo-details">
            <a href="../../dashboard.php">
                <span class="logo_name">BakeryPro</span>
            </a>
            <i class='bx bx-menu' id="btn" ></i>
        </div>
        <ul class="nav-list">
        
        <li>
        <a href="../../vista/html/usuarios.php">
            <i class='bx bx-user' ></i>
            <span class="links_name">Usuario</span>
        </a>
        <span class="tooltip">Usuarios</span>
        </li>

        <li>
            <a href="../../vista/html/insumos.php">
                <i class='bx bx-cart-alt' ></i>
                <span class="links_name">Insumos</span>
            </a>
            <span class="tooltip">Insumos</span>
        </li>

        <li>
        <a href="../../vista/html/recetas.php">
            <i class='bx bx-folder' ></i>
            <span class="links_name">Recetas</span>
        </a>
        <span class="tooltip">Recetas</span>
        </li>

        <li>
            <a href="../../vista/html/proveedores.php">
                <i class='bx bx-pie-chart-alt-2' ></i>
                <span class="links_name">Proveedores</span>
            </a>
            <span class="tooltip">Proveedores</span>
        </li>

        <li>
        <a href="../../vista/html/facturas.php">
            <i class='bx bx-user' ></i>
            <span class="links_name">Facturas</span>
        </a>
        <span class="tooltip">Facturas</span>
        </li>


        <li class="profile">
            <div class="profile-details">
            <img src="profile.jpg" alt="profileImg">
            <div class="name_job">
                <div class="name">Prem Shahi</div>
                <div class="job">Web designer</div>
            </div>
            </div>
            <i class='bx bx-log-out' id="log_out" ></i>
        </li>
        </ul>

    </div>

<section class="home-section">
    <div class="container">
        <h2>Editar Recetas</h2>

        <form action="actualizar.php" method="post" class="form">
            <input type="hidden" name="IdProducto" value="<?php echo $fila['IdProducto']; ?>" class="input">
            <label for="NombreProducto">Nombre Producto:</label>
            <input type="text" id="NombreProducto" name="NombreProducto" value="<?php echo $fila['NombreProducto']; ?>" class="input"><br>
            
            <label for="IdInsumo">ID Insumo:</label>
            <input type="text" id="IdInsumo" name="IdInsumo" value="<?php echo $fila['IdInsumo']; ?>" class="input"><br>
            
            <label for="NombreInsumo">Nombre Insumo:</label>
            <input type="text" id="NombreInsumo" name="NombreInsumo" value="<?php echo $fila['NombreInsumo']; ?>" class="input"><br>
            
            <label for="CantidadInsumo">Cantidad Insumo:</label>
            <input type="text" id="CantidadInsumo" name="CantidadInsumo" value="<?php echo $fila['CantidadInsumo']; ?>" class="input"><br>
            
            

            <?php
                    include '../../modelo/conexion.php';
                    $sql = "SELECT * FROM tblUnidadesMedidas";
                    $result = $conexion->query($sql);

                    // Recorrer datos y crear options
                    echo "<label for='medida'>Medida:</label>
            
                    <select name='medidaIdUnidadMedida' id='opcion' class='input'>";
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["IdUnidadMedida"] . "' >" . $row["medida"] . "</option>";
                        }
                    } else {
                        echo "0 results";
                    }
                    echo "</select>";
                ?>

            
            <input type="submit" value="Actualizar" class="btn">
        </form>
    </div>
</section>
</body>
</html>
