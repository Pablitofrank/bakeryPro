<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios| BakeryPro</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Fugaz+One&family=Inter:wght@100&family=Quicksand:wght@300;500;700&display=swap" rel="stylesheet">

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../vista/style/styles.css">
    <link rel="shortcut icon" href="../" type="image/x-icon">

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

            <li>
                <a href="../../vista/html/calculadora.php">
                    <i class='bx bx-user' ></i>
                    <span class="links_name">Calculadora</span>
                </a>
                <span class="tooltip">Calculadora</span>
            </li>

            <li class="profile">
                <div class="profile-details">
                    <img src="profile.jpg" alt="profileImg">
                    <div class="name_job">
                        <div class="name"><?php echo $nombre; ?></div>
                        <div class="job"><?php echo $rol; ?></div>
                    </div>
                </div>
                <a href="./controlador/login/logout.php" id="log_out">
                    <i class='bx bx-log-out'></i>
                </a>
            </li>
            
        </ul>
    </div>
    
    <section class="home-section">
        <div class="container">
            <h2>Resultado de la Consulta de Facturas</h2>
            
            <!-- Formulario de búsqueda y filtro -->
            <form action="" method="GET">
                <label for="date">Fecha:</label>
                <input type="date" id="date" name="date">
                
                <label for="provider">Proveedor:</label>
                <select id="provider" name="provider">
                    <option value="">Todos los proveedores</option>
                    <!-- Aquí debes generar opciones dinámicas con los datos de tu base de datos -->
                    <?php
                        include '../../modelo/conexion.php';
                        $sql = "SELECT * FROM tblproveedores";
                        $result = $conexion->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='".$row['IdProveedor']."'>".$row['NombreProveedor']."</option>";
                            }
                        }
                        $conexion->close();
                    ?>
                </select>
                
                <button type="submit">Buscar</button>
            </form>
            
            <!-- Resultados de la búsqueda -->
            <?php
                include '../../modelo/conexion.php';
                
                // Construir la consulta SQL dinámica
                $sql = "SELECT * FROM tblfactura";

                // Agregar condiciones según los valores de búsqueda y filtro
                if(isset($_GET['date']) && !empty($_GET['date'])) {
                    $date = $_GET['date'];
                    $sql .= " WHERE Fecha = '$date'";
                }
                
                if(isset($_GET['provider']) && !empty($_GET['provider'])) {
                    $provider = $_GET['provider'];
                    if(strpos($sql, 'WHERE') !== false) {
                        $sql .= " AND IdProveedores = $provider";
                    } else {
                        $sql .= " WHERE IdProveedores = $provider";
                    }
                }

                $resultado = $conexion->query($sql);

                        
               
                include '../../modelo/conexion.php';
                $sql = "SELECT f.IdFactura, f.CantidadInsumo, f.NumeroFactura, f.Fecha, 
                               i.NombreInsumo AS NombreInsumo, 
                               p.RazonSocial AS Proveedor,
                               u.medida AS UnidadMedida
                        FROM tblfactura f
                        INNER JOIN tblinsumos i ON f.idInsumo = i.IdInsumo
                        INNER JOIN tblproveedores p ON f.IdProveedores = p.IdProveedores
                        INNER JOIN tblunidadesmedidas u ON f.IdUnidadMedida = u.IdUnidadMedida";
                $resultado = $conexion->query($sql);
                if ($resultado->num_rows > 0) {
                    echo "<table border='1'>
                        <tr>
                            <th>ID Factura</th>
                            <th>Cantidad Insumo</th>
                            <th>Número de Factura</th>
                            <th>Fecha</th>
                            <th>Insumo</th>
                            <th>Proveedor</th>
                            <th>Unidad de Medida</th>
                            <th>Acciones</th>
                        </tr>";
                    while ($fila = $resultado->fetch_assoc()) {
                        echo "<tr>
                                <td>".$fila["IdFactura"]."</td>
                                <td>".$fila["CantidadInsumo"]."</td>
                                <td>".$fila["NumeroFactura"]."</td>
                                <td>".$fila["Fecha"]."</td>
                                <td>".$fila["NombreInsumo"]."</td>
                                <td>".$fila["Proveedor"]."</td>
                                <td>".$fila["UnidadMedida"]."</td>
                                <td>
                                    <a href='editar.php?NumeroFactura=".$fila['NumeroFactura']."'><img src='../../vista/img/editar.png' alt='editar'></a>
                                    <a href='eliminar.php?numero_factura=".$fila['NumeroFactura']."'><img src='../../vista/img/eliminar.png' alt='eliminar'></a>
                                </td>
                            </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No se encontraron resultados para la tabla de facturas.</p>";
                }
                $conexion->close();
            ?>
            

        </div>
    </section>
</body>
</html>
