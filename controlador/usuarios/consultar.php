<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuarios</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Fugaz+One&family=Inter:wght@100&family=Quicksand:wght@300;500;700&display=swap" rel="stylesheet">

    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../vista/style/styles.css">
    <link rel="shortcut icon" href="../../vista/img/logo.svg" type="image/x-icon">
</head>
<body>
    <form action="./dashboard.php" method="post">
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
    </form>

    <section class="home-section">
        <div class="container">
            <h2 class="titleContainer">Resultado de la Consulta de Usuario</h2>

            <?php
                include '../../modelo/conexion.php';
                $sql = "SELECT * FROM tblusuario INNER JOIN tblroles ON tblusuario.IdRol = tblroles.IdRol";
                $resultado = $conexion->query($sql);
                if ($resultado->num_rows > 0) {
                    echo "<table border='1'>
                        <tr>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Rol</th>
                            <th>Cedula</th>
                            <th>Telefono</th>
                            <th>Acciones</th>
                        </tr>";
                    while ($fila = $resultado->fetch_assoc()) {
                        echo "<tr>
                                <td>".$fila["Nombres"]."</td>
                                <td>".$fila["Apellidos"]."</td>
                                <td>".$fila["Rol"]."</td>
                                <td>".$fila["Cedula"]."</td>
                                <td>".$fila["Telefono"]."</td>
                                <td>
                                    <a href='editar.php?id=".$fila['IdUsuario']."'><img src='../../vista/img/editar.png' alt='editar'></a>
                                    <a href='eliminar.php?id=".$fila['IdUsuario']."'><img src='../../vista/img/eliminar.png' alt='eliminar'></a>
                                </td>
                            </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No se encontraron resultados para el ID proporcionado.</p>";
                }
                $conexion->close();
            ?>
            <br>
            <a href="../../vista/html/usuarios.php" class="volverConsultar">VOLVER</a>
        </div>
    </section>

    <script src="../../vista/js/main.js"></script>
</body>
</html>
