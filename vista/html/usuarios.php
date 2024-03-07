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
    <link rel="stylesheet" href="../style/styles.css">
    <link rel="shortcut icon" href="../" type="image/x-icon">

</head>
<body>
    <div class="sidebar">
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
            <a href="./productos.php">
                <i class='bx bx-grid-alt'></i>
                <span class="links_name">Productos</span>
            </a>
                <span class="tooltip">Productos</span>
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

    <!-- Formulario para agregar un nuevo usuario -->
    <section class="home-section">
        <div class="container">
            <div class="text">Agregar usuarios</div>
            <form action="../../controlador/usuarios/insertar.php" method="post" class="form">
                <label for="nombres" class="label">Nombres:</label>
                <input type="text" name="nombres" required class="input"><br> 

                <label for="apellidos" class="label">Apellidos:</label>
                <input type="text" name="apellidos" required class="input"><br>

                    <?php
                    include '../../modelo/conexion.php';
                    $sql = "SELECT * FROM tblroles";
                    $result = $conexion->query($sql);
                        
                    // Recorrer datos y crear options
                    echo "<label for='rol' class='label'>Rol:</label>
                        
                    <select name='rol' id='opcion' class='input'>";
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["IdRol"] . "'>" . $row["Rol"] . "</option>";
                        }
                    } else {
                        echo "0 results";
                    }
                    echo "</select><br>";
                        
                    // Actualizar valor del option en la base de datos
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // Actualizar valor del option en la base de datos
                        $sql = "UPDATE tblusuario SET IdRol = " . $_POST['rol'] . " WHERE IdUsuario = 1";

                        if ($conexion->query($sql) === TRUE) {
                            echo "Record updated successfully";
                        } else {
                            echo "Error updating record: " . $conexion->error;
                        }
                    }
                    ?>
                <label for="cedula" class="label">Cedula:</label> <input type="text" name="cedula" required class="input"><br>
                <label for="telefono" class="label">Telefono:</label> <input type="text" name="telefono" required class="input"><br>
                <input type="submit" value="Agregar" class="btn">
            </form>

            <div class="consulta">
                <h2>Consulta usuarios</h2>
                <form action="../../controlador/usuarios/consultar.php" method="post">
                    <input type="submit" value="Consultar" class="btn">
                </form>
            </div>
        </div>
    </section>

</body>
</html>

