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
    <title>Proovedores| BakeryPro</title>

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
                        <div class="name"><?php echo $nombre; ?></div>
                        <div class="job"><?php echo $rol; ?></div>
                    </div>
                </div>
                <a href="../../controlador/login/logout.php" id="log_out">
                    <i class='bx bx-log-out'></i>
                </a>
            </li>
            
        </ul>
    </div>
  
    <section class="home-section">
        <div class="container">
            <h2 class="titleContainer">Agregar Proveedores</h2>

            <form action="../../controlador/Proveedores/insertar.php" method="post" class="form">
                
                <label for="nit" class="label">NIT:</label>
                    <input type="text" name="NIT" required class="input"><br>

                <label for="razonSocial" class="label">Razon social:</label>
                    <input type="text" name="RazonSocial" required class="input"><br>

                <label for="contacto" class="label">Contacto:</label>
                    <input type="text" name="Contacto" required class="input"><br>

                <label for="telefono" class="label">Telefono:</label>
                    <input type="text" name="Telefono" required class="input"><br>

                <label for="correo" class="label">Correo:</label>
                    <input type="text" name="Correo" required class="input"><br>

                <label for="direccion" class="label">Direccion:</label>
                    <input type="text" name="Direccion" required class="input"><br>

                <!-- Nuevo campo para el rol -->
                <input type="submit" value="Agregar" class="btn">
            </form>

            <div>
                <h2 class="titleContainer">Consulta Proveedores</h2>

                <form action="../../controlador/Proveedores/consultar.php" method="post">
                    <input type="submit" value="Consultar" class="btn">
                </form>
            </div>
        
        </div>


    </section>

</body>
</html>