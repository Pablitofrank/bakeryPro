<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuarios</title>

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
        <h2 class="titleContainer">Resultado de la Consulta de Proveedores</h2>
        
        <?php
        include '../../modelo/conexion.php';

        $sql = "SELECT * FROM tblproveedores";
        $resultado = $conexion->query($sql);
        ?>

        <?php if ($resultado->num_rows > 0) { ?>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>NIT</th>
                    <th>Razon social</th>
                    <th>Contacto</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>Direccion</th>
                    <th>Acciones</th>

                </tr>
                <?php while ($fila = $resultado->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $fila['IdProveedores']; ?></td>
                        <td><?php echo $fila["NIT"]; ?></td>
                        <td><?php echo $fila["RazonSocial"]; ?></td>
                        <td><?php echo $fila["Contacto"]; ?></td>
                        <td><?php echo $fila["Telefono"]; ?></td>
                        <td><?php echo $fila["Correo"]; ?></td>
                        <td><?php echo $fila["Direccion"]; ?></td>
                        <td>
                            <a href='editar.php?IdProveedores=<?php echo $fila['IdProveedores']; ?>'><img src="../../vista/img/editar.png" alt="editar"></a>
                            <a href='eliminar.php?IdProveedores=<?php echo $fila['IdProveedores']; ?>'><img src="../../vista/img/eliminar.png" alt="eliminar"></a>  
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

    <script src="../../vista/js/main.js"></script>
</body>
</html>



