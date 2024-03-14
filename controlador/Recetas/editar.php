<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Insumos del Producto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../../vista/style/styles.css">
</head>
<body>
    <div class="sidebar open">
        <div class="logo-details">
            <a href="../../dashboard.php" class="logo_link">
                <span class="logo_name">BakeryPro</span>
            </a>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav-list">
            <li>
                <a href="../../vista/html/usuarios.php">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Usuario</span>
                </a>
                <span class="tooltip">Usuarios</span>
            </li>
            <li>
                <a href="../../vista/html/insumos.php">
                    <i class='bx bx-cart-alt'></i>
                    <span class="links_name">Insumos</span>
                </a>
                <span class="tooltip">Insumos</span>
            </li>
            <li>
                <a href="../../vista/html/recetas.php">
                    <i class='bx bx-folder'></i>
                    <span class="links_name">Recetas</span>
                </a>
                <span class="tooltip">Recetas</span>
            </li>
            <li>
                <a href="../../vista/html/productos.php">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Productos</span>
                </a>
                <span class="tooltip">Productos</span>
            </li>
            <li>
                <a href="../../vista/html/proveedores.php">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span class="links_name">Proveedores</span>
                </a>
                <span class="tooltip">Proveedores</span>
            </li>
            <li>
                <a href="../../vista/html/facturas.php">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Facturas</span>
                </a>
                <span class="tooltip">Facturas</span>
            </li>
            <li>
                <a href="./calculadora.php">
                    <i class='bx bx-user'></i>
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
                <i class='bx bx-log-out' id="log_out"></i>
            </li>
        </ul>
    </div>

    <section class="home-section">
        <div class="container">
            <h2 class="titleContainer">Editar Insumos del Producto</h2>
            <?php
            // Verificar si se ha proporcionado un IdProducto
            if(isset($_GET['IdProducto'])) {
                $idProducto = $_GET['IdProducto'];
                // Consultar los insumos asociados al producto desde la base de datos
                include '../../modelo/conexion.php';

                $sql = "SELECT pr.IdProducto, pr.NombreProducto, r.IdInsumo, ins.NombreInsumo, r.CantidadInsumo, um.medida 
                        FROM tblrecetas r
                        INNER JOIN tblproductos pr ON r.IdProducto = pr.IdProducto
                        INNER JOIN tblinsumos ins ON r.IdInsumo = ins.IdInsumo
                        INNER JOIN tblunidadesmedidas um ON r.IdUnidadMedida = um.IdUnidadMedida
                        WHERE pr.IdProducto = $idProducto";
                $resultado = $conexion->query($sql);

                if ($resultado->num_rows > 0) {
                    echo "<form action='actualizar.php' method='POST'>";
                    echo "<input type='hidden' name='IdProducto' value='$idProducto'>";
                    echo "<table border='1'>";
                    echo "<tr><th>ID Insumo</th><th>Nombre Insumo</th><th>Cantidad</th><th>Unidad de Medida</th></tr>";
                    while ($fila = $resultado->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$fila['IdInsumo']."</td>";
                        echo "<td>".$fila['NombreInsumo']."</td>";
                        echo "<td><input type='text' name='cantidad_".$fila['IdInsumo']."' value='".$fila['CantidadInsumo']."'></td>";
                        echo "<td>";
                        echo "<select name='unidad_".$fila['IdInsumo']."'>";
                        // Obtener las unidades de medida desde la base de datos
                        $sqlUnidades = "SELECT IdUnidadMedida, medida FROM tblunidadesmedidas";
                        $resultadoUnidades = $conexion->query($sqlUnidades);
                        // Mostrar las opciones del select
                        while ($unidad = $resultadoUnidades->fetch_assoc()) {
                            $selected = ($unidad['medida'] == $fila['medida']) ? 'selected' : '';
                            echo "<option value='".$unidad['medida']."' $selected>".$unidad['medida']."</option>";
                        }
                        echo "</select>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "<input type='submit' value='Guardar Cambios'>";
                    echo "</form>";
                } else {
                    echo "No se encontraron insumos asociados a este producto.";
                }

                $conexion->close();
            } else {
                echo "No se proporcionó un IdProducto para editar.";
            }
            ?>
        </div>
    </section>
</body>
</html>
