<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar recetas</title>

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
                <a href="../../vista/html/productos.php">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Productos</span>
                </a>
                    <span class="tooltip">Productos</span>
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
        <div class="container">
        <h2 class="titleContainer">Resultado de la Consulta de Recetas</h2>
        
        <?php
        include '../../modelo/conexion.php';

        $sql = "SELECT pr.IdProducto, pr.NombreProducto, r.IdInsumo, ins.NombreInsumo, r.CantidadInsumo, um.medida 
                FROM tblrecetas r
                INNER JOIN tblproductos pr ON r.IdProducto = pr.IdProducto
                INNER JOIN tblinsumos ins ON r.IdInsumo = ins.IdInsumo
                INNER JOIN tblunidadesmedidas um ON r.IdUnidadMedida = um.IdUnidadMedida
                ORDER BY IdProducto";
        $resultado = $conexion->query($sql);
        ?>

        <?php if ($resultado->num_rows > 0) { ?>
            <table border="1">
                <tr>
                <th>ID Producto</th>
                <th>Nombre Producto</th>
                <th>ID Insumo</th>
                <th>Nombre Insumo</th>
                <th>Cantidad</th>
                <th>Unidad de Medida</th>
                <th>Acciones</th>

                </tr>
                <?php while ($fila = $resultado->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $fila['IdProducto']; ?></td>
                        <td><?php echo $fila["NombreProducto"]; ?></td>
                        <td><?php echo $fila["IdInsumo"]; ?></td>
                        <td><?php echo $fila["NombreInsumo"]; ?></td>
                        <td><?php echo $fila["CantidadInsumo"]; ?></td>
                        <td><?php echo $fila["medida"]; ?></td>
                        <td>
                            <a href='editar.php?IdProducto=<?php echo $fila['IdProducto']; ?>'><img src="../../vista/img/editar.png" alt="editar"></a>
                            <a href='eliminar.php?IdProducto=<?php echo $fila['IdProducto']; ?>'><img src="../../vista/img/eliminar.png" alt="eliminar"></a>  
                        </td>
                    </tr>
                <?php } ?>
            </table>
        <?php } else { ?>
            <p>No se encontraron resultados para el ID proporcionado.</p>
        <?php } ?>

        <?php $conexion->close(); ?>
        <br>
            <a href="../../dashboard.php" class="volverConsultar">VOLVER</a>
        </div>
    </section>

</body>
</html>


