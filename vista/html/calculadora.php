<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    include '../../modelo/conexion.php';
    $sql = "SELECT * FROM tblproductos";
    $result = $conexion->query($sql);

    // Verificar si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario
        $IdProducto = $_POST['NombreProducto']; // Cambiado de IdProducto a NombreProducto
        $cantidadDeseada = $_POST['cantidadDeseada'];

        // Consultar la receta del producto seleccionado
        $queryReceta = "SELECT IdInsumo, CantidadInsumo FROM tblrecetas WHERE IdProducto = IdProducto";
        $resultReceta = $conexion->query($queryReceta);

        if ($resultReceta->num_rows > 0) {
            // Inicializar un array para almacenar los insumos y sus cantidades
            $insumosRequeridos = array();

            // Calcular la cantidad total de cada insumo requerido
            while($rowReceta = $resultReceta->fetch_assoc()) {
                $idInsumo = $rowReceta['IdInsumo'];
                $cantidadInsumo = $rowReceta['CantidadInsumo'] * $cantidadDeseada;

                // Almacenar el insumo y su cantidad en el array
                $insumosRequeridos[$idInsumo] = $cantidadInsumo;
            }

            // Ahora puedes mostrar los insumos requeridos al usuario
            foreach ($insumosRequeridos as $idInsumo => $cantidad) {
                // Realizar consulta para obtener el nombre del insumo
                $queryNombreInsumo = "SELECT NombreInsumo FROM tblinsumos WHERE IdInsumo = $idInsumo";
                $resultNombreInsumo = $conexion->query($queryNombreInsumo);
                $rowNombreInsumo = $resultNombreInsumo->fetch_assoc();
                $nombreInsumo = $rowNombreInsumo['NombreInsumo'];

                echo "Se necesitan $cantidad unidades de $nombreInsumo <br>";
            }
        } else {
            echo "No hay receta disponible para este producto.";
        }
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora| BakeryPro</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Fugaz+One&family=Inter:wght@100&family=Quicksand:wght@300;500;700&display=swap" rel="stylesheet">

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/styles.css">

</head>
<body>
    <div class="sidebar open">
        <div class="logo-details">
            <a href="../../dashboard.php" class="logo_link">
                <span class="logo_name">BakeryPro</span>
            </a>
            <i class='bx bx-menu' id="btn" ></i>
        </div>

        <ul class="nav-list">
            <li>
            <a href="./usuarios.php">
                <i class='bx bx-user' ></i>
                <span class="links_name">Usuario</span>
            </a>
            <span class="tooltip">Usuarios</span>
            </li>

            <li>
                <a href="./insumos.php">
                    <i class='bx bx-cart-alt' ></i>
                    <span class="links_name">Insumos</span>
                </a>
                <span class="tooltip">Insumos</span>
            </li>

            <li>
            <a href="./recetas.php">
                <i class='bx bx-folder' ></i>
                <span class="links_name">Recetas</span>
            </a>
            <span class="tooltip">Recetas</span>
            </li>

            <li>
                <a href="./proveedores.php">
                    <i class='bx bx-pie-chart-alt-2' ></i>
                    <span class="links_name">Proveedores</span>
                </a>
                
                <span class="tooltip">Proveedores</span>
            </li>

            <li>
            <a href="./facturas.php">
                <i class='bx bx-user' ></i>
                <span class="links_name">Facturas</span>
            </a>
            <span class="tooltip">Facturas</span>
            </li>

            <li>
                <a href="./calculadora.php">
                    <i class='bx bx-user' ></i>
                    <span class="links_name">Calculadora</span>
                </a>
                <span class="tooltip">Calculadora</span>
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

        <form method="post">
            <div class="container">
                <h2 class="titleContainer">Calculadora</h2>

                <p>Seleccione la cantidad que desea producir</p><br>

                <div>
                    <select name="NombreProducto" class="input">
                        <?php
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row["IdProducto"] . "'>" . $row["NombreProducto"] . "</option>";
                                }
                            } else {
                                echo "<option value=''>No hay productos disponibles</option>";
                            }
                        ?>
                    </select>

                    <input type='number' name='cantidadDeseada' placeholder='Cantidad' class='input' required>
                    <input type="submit" value="Calcular" class="btn"> <br>
                </div>
            </div> 
        </form>
    </section>

     <script src="../../vista/js/main.js"></script>
</body>
</html>