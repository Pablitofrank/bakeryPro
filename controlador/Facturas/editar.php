<?php
    session_start();
    if (!isset($_SESSION['cedula'])) {
        header("Location: ../../index.php");
        exit;
    }

    // Conexión a la base de datos (reemplaza los valores de conexión con los tuyos)
    $servername = "localhost";
    $username = "root"; // Cambia esto por tu nombre de usuario de MySQL
    $password = ""; // Cambia esto por tu contraseña de MySQL
    $dbname = "bakerypro";

    // Crear conexión
    $conexion = mysqli_connect($servername, $username, $password, $dbname);

    // Verificar la conexión
    if (!$conexion) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    // Consulta para obtener el nombre del usuario y su rol
    $cedula = $_SESSION['cedula'];
    $sql = "SELECT Nombres, Apellidos, Rol FROM tblusuario INNER JOIN tblroles ON tblusuario.IdRol = tblroles.IdRol WHERE Cedula = $cedula";
    $resultado = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        // Mostrar los datos del usuario
        $fila = mysqli_fetch_assoc($resultado);
        $nombre = $fila["Nombres"] . " " . $fila["Apellidos"];
        $rol = $fila["Rol"];
    } else {
        $nombre = "Nombre de usuario";
        $rol = "Rol de usuario";
    }

    mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Factura</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../../vista/style/styles.css">
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
                <a href="../login/logout.php" id="log_out">
                    <i class='bx bx-log-out'></i>
                </a>
            </li>
            
        </ul>
    </div>

    <section class="home-section">
        <div class="container">
            <h2 class="titleContainer">Editar Factura</h2>
            <?php
                // Verificar si se ha proporcionado un número de factura
                if(isset($_GET['NumeroFactura'])) {
                    $numeroFactura = $_GET['NumeroFactura'];
                    // Consultar los datos de la factura desde la base de datos
                    include '../../modelo/conexion.php';

                    $sql = "SELECT f.IdFactura, f.CantidadInsumo, f.NumeroFactura, f.Fecha, 
                                   i.NombreInsumo, p.RazonSocial, u.medida, f.IdInsumo, f.IdProveedor, f.IdUnidadMedida
                            FROM tblfactura f
                            INNER JOIN tblinsumos i ON f.IdInsumo = i.IdInsumo
                            INNER JOIN tblproveedores p ON f.IdProveedor = p.IdProveedores
                            INNER JOIN tblunidadesmedidas u ON f.IdUnidadMedida = u.IdUnidadMedida
                            WHERE f.NumeroFactura = '$numeroFactura'";
                    $resultado = $conexion->query($sql);

                    if ($resultado->num_rows > 0) {
                        echo "<form action='actualizar.php' method='POST'>";
                        echo "<input type='hidden' name='NumeroFactura' value='$numeroFactura'>";
                        echo "<table border='1'>";
                        echo "<tr><th>Número de Factura</th><th>Fecha</th><th>Insumo</th><th>Cantidad</th><th>Proveedor</th><th>Unidad de Medida</th></tr>";
                        while ($fila = $resultado->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>".$fila['NumeroFactura']."</td>";
                            echo "<td><input type='date' name='fecha' value='".$fila['Fecha']."'></td>";
                            echo "<td>";
                            echo "<select name='insumo'>";
                            echo "<option value='".$fila['IdInsumo']."'>".$fila['NombreInsumo']."</option>";
                            // Obtener los insumos desde la base de datos
                            $sqlInsumos = "SELECT IdInsumo, NombreInsumo FROM tblinsumos";
                            $resultadoInsumos = $conexion->query($sqlInsumos);
                            // Mostrar las opciones del select
                            while ($insumo = $resultadoInsumos->fetch_assoc()) {
                                echo "<option value='".$insumo['IdInsumo']."'>".$insumo['NombreInsumo']."</option>";
                            }
                            echo "</select>";
                            echo "</td>";
                            echo "<td><input type='text' name='cantidad' value='".$fila['CantidadInsumo']."'></td>";
                            echo "<td>";
                            echo "<select name='proveedor'>";
                            echo "<option value='".$fila['IdProveedor']."'>".$fila['RazonSocial']."</option>";
                            // Obtener los proveedores desde la base de datos
                            $sqlProveedores = "SELECT IdProveedores, RazonSocial FROM tblproveedores";
                            $resultadoProveedores = $conexion->query($sqlProveedores);
                            // Mostrar las opciones del select
                            while ($proveedor = $resultadoProveedores->fetch_assoc()) {
                                echo "<option value='".$proveedor['IdProveedores']."'>".$proveedor['RazonSocial']."</option>";
                            }
                            echo "</select>";
                            echo "</td>";
                            echo "<td>";
                            echo "<select name='unidad'>";
                            echo "<option value='".$fila['IdUnidadMedida']."'>".$fila['medida']."</option>";
                            // Obtener las unidades de medida desde la base de datos
                            $sqlUnidades = "SELECT IdUnidadMedida, medida FROM tblunidadesmedidas";
                            $resultadoUnidades = $conexion->query($sqlUnidades);
                            // Mostrar las opciones del select
                            while ($unidad = $resultadoUnidades->fetch_assoc()) {
                                echo "<option value='".$unidad['IdUnidadMedida']."'>".$unidad['medida']."</option>";
                            }
                            echo "</select>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                        echo "<input type='submit' value='Guardar Cambios'>";
                        echo "</form>";
                    } else {
                        echo "No se encontró la factura especificada.";
                    }

                    $conexion->close();
                } else {
                    echo "No se proporcionó un número de factura para editar.";
                }
            ?>
        </div>
    </section>
</body>
</html>
