<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora | BakeryPro</title>

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
                <p>Seleccione el producto y la cantidad que desea producir</p><br>

                <div>
                    <select name="NombreProducto" class="input">
                        <?php
                        include '../../modelo/conexion.php';

                        $sql = "SELECT IdProducto, NombreProducto FROM tblproductos";
                        $result = $conexion->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row["IdProducto"] . "'>" . $row["NombreProducto"] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No hay productos disponibles</option>";
                        }

                        $conexion->close();
                        ?>
                    </select>

                    <input type='number' name='cantidadDeseada' placeholder='Cantidad' class='input' required>
                    <input type="submit" value="Calcular" class="btn"> <br>
                            
                    <?php
                    include '../../modelo/conexion.php';

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $cantidadDeseada = $_POST['cantidadDeseada'];
                        $productoId = $_POST['NombreProducto'];

                        $sql = "SELECT rp.CantidadInsumo, i.NombreInsumo, u.medida 
                                FROM tblrecetas rp 
                                INNER JOIN tblinsumos i ON rp.IdInsumo = i.IdInsumo 
                                INNER JOIN tblunidadesmedidas u ON rp.IdUnidadMedida = u.IdUnidadMedida 
                                WHERE rp.IdProducto = $productoId";
                        $result = $conexion->query($sql);

                        if ($result->num_rows > 0) {
                            // Guardar los resultados en una variable de sesión
                            session_start();
                            $_SESSION['resultados'] = array();
                            while($row = $result->fetch_assoc()) {
                                $cantidadInsumo = $row["CantidadInsumo"] * $cantidadDeseada;
                                $_SESSION['resultados'][] = array(
                                    'NombreInsumo' => $row["NombreInsumo"],
                                    'Cantidad' => $cantidadInsumo,
                                    'Unidad' => $row["medida"]
                                );
                            }
                            session_write_close();

                            // Redireccionar a otra página para mostrar los resultados
                            header("Location: ../../controlador/calculadora/resultados.php");
                            exit();
                        } else {
                            echo "No se encontraron recetas para este producto.";
                        }
                    }
                    ?>

                </div>
            </div> 
        </form>
    </section>

    <script src="../../vista/js/main.js"></script>
</body>
</html>
