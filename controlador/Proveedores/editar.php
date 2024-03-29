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
    <title>Editar proveedores</title>

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
                <a href="../../vista/html/vista/html/recetas.php">
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
                <a href=".../../vista/html/facturas.php">
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
            <h2>Editar Proveedores</h2>

            <?php
                include '../../modelo/conexion.php';

                if (isset($_GET['IdProveedores'])) {
                    $id = $_GET['IdProveedores'];
                    $sql = "SELECT * FROM tblproveedores";
                    $resultado = $conexion->query($sql);

                    if ($resultado->num_rows > 0) {
                        $fila = $resultado->fetch_assoc();
                    } else {
                        echo "<p>No se encontraron resultados para el ID proporcionado.</p>";
                        exit;
                    }
                } else {
                    echo "<p>Ingrese un ID para realizar la consulta.</p>";
                    exit;
                }
            ?>

            <form action="actualizar.php" method="post" class="form">
                <input type="hidden" name="IdProveedores" value="<?php echo $fila['IdProveedores']; ?>" class="input">
                <label for="NIT">NIT:</label>
                <input type="text" id="NIT" name="NIT" value="<?php echo $fila['NIT']; ?>" class="input"><br>
                
                <label for="RazonSocial">Razon social:</label>
                <input type="text" id="RazonSocial" name="RazonSocial" value="<?php echo $fila['RazonSocial']; ?>" class="input"><br>
                
                <label for="Contacto">Contacto:</label>
                <input type="text" id="Contacto" name="Contacto" value="<?php echo $fila['Contacto']; ?>" class="input"><br>
                
                <label for="Telefono">Telefono:</label>
                <input type="text" id="Telefono" name="Telefono" value="<?php echo $fila['Telefono']; ?>" class="input"><br>
                
                <label for="Correo">Correo:</label>
                <input type="text" id="Correo" name="Correo" value="<?php echo $fila['Correo']; ?>" class="input"><br>
                
                <label for="Direccion">Direccion:</label>
                <input type="text" id="Direccion" name="Direccion" value="<?php echo $fila['Direccion']; ?>" class="input"><br>
                
                <input type="submit" value="Actualizar" class="btn">
            </form>

        </div>
    </section>
</body>
</html>
