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
  
    <section class="home-section">
        <div class="container">
            <div class="text">Agregar Proveedores </div>
                <form action="../../controlador/proveedores/insertar.php" method="post" class="form">
                
                <label for="nit" class="label">NIT:</label>
                    <input type="text" name="nit" required class="input"><br>

                <label for="razonSocial" class="label">Razon social:</label>
                    <input type="text" name="razonSocial" required class="input"><br>

                <label for="contacto" class="label">Contacto:</label>
                    <input type="text" name="contacto" required class="input"><br>

                <label for="telefono" class="label">Telefono:</label>
                    <input type="text" name="telefono" required class="input"><br>

                <label for="correo" class="label">Correo:</label>
                    <input type="text" name="correo" required class="input"><br>

                <label for="direccion" class="label">Direccion:</label>
                    <input type="text" name="direccion" required class="input"><br>

                <!-- Nuevo campo para el rol -->
                <input type="submit" value="Agregar" class="btn">
            </form>
            <div>
            <h2>Consulta Proveedores</h2>
            <form action="../../controlador/proveedores/consultar.php" method="post">
                <input type="submit" value="Consultar" class="btn">
            </form>
        </div>
            </div>


    </section>

    <script src="../../vista/js/main.js"></script>
</body>
</html>