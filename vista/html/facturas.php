<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturas| BakeryPro</title>

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

    <!-- Codigo PHP -->
    <section class="home-section">
     <div class="container">
        <div class="text">Agregar Factura</div>
        <form action="../../controlador/facturas/insertar.php" method="post">
         <?php
            include '../../modelo/conexion.php';
            $sql = "SELECT * FROM tblInsumos";
            $result = $conexion->query($sql);
            
            // Recorrer datos y crear options
            echo "<label for='NombreInsumo' class='label'>Insumo:</label>
            
            <select name='NombreInsumo' id='opcion' class='input'>";
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["IdInsumo"] . "'>" . $row["NombreInsumo"] . "</option>";
                }
            } else {
                echo "0 results";
            }
            echo "</select><br>";
            
            // Actualizar valor del option en la base de datos
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Actualizar valor del option en la base de datos
                $sql = "UPDATE tblfactura SET IdInsumo = " . $_POST['NombreInsumo'] . " WHERE IdInsumo = 1";

                if ($conexion->query($sql) === TRUE) {
                    echo "Record updated successfully";
                } else {
                    echo "Error updating record: " . $conexion->error;
                }
            }
            ?>
    
            <label for="cantidadInsumo">Cantidad de Insumo:</label> <input type="text" name="cantidadInsumo" required class="input"><br>
            <label for="numeroFactura">Número de Factura:</label> <input type="text" name="numeroFactura" required class="input"><br>
            <label for="fecha">Fecha:</label> <input type="date" name="fecha" required class="input"><br>
            <?php
            include '../../modelo/conexion.php';
            $sql = "SELECT * FROM tblinsumos";
            $result = $conexion->query($sql);
            
            // Recorrer datos y crear options
            echo "<label for='insumo'>Insumo:</label>
            
            <select name='insumo' id='opcion'>";
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["IdInsumo"] . "'>" . $row["Insumo"] . "</option>";
                }
            } else {
                echo "0 results";
            }
            echo "</select>";
            
            // Actualizar valor del option en la base de datos
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Actualizar valor del option en la base de datos
                $sql = "UPDATE tblinsumos SET IdInsumo = " . $_POST['insumo'] . " WHERE IdInsumo = 1";

                if ($conexion->query($sql) === TRUE) {
                    echo "Record updated successfully";
                } else {
                    echo "Error updating record: " . $conexion->error;
                }
            }
            ?>
            ------------------------------
            <?php
            include '../../modelo/conexion.php';
            $sql = "SELECT * FROM tblProveedores";
            $result = $conexion->query($sql);
            
            // Recorrer datos y crear options
            echo "<label for='razonSocial'>RazonSocial:</label>
            
            <select name='insumo' id='opcion'>";
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["IdProveedor"] . "'>" . $row["RazonSocial"] . "</option>";
                }
            } else {
                echo "0 results";
            }
            echo "</select>";
            
            // Actualizar valor del option en la base de datos
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Actualizar valor del option en la base de datos
                $sql = "UPDATE tblProveedores SET IdProveedor = " . $_POST['razonSocial'] . " WHERE IdProveedor = 1";

                if ($conexion->query($sql) === TRUE) {
                    echo "Record updated successfully";
                } else {
                    echo "Error updating record: " . $conexion->error;
                }
            }
            
            ?>
          
           <?php
            include '../../modelo/conexion.php';
            $sql = "SELECT * FROM tblunidadesmedidas";
            $result = $conexion->query($sql);
            
            // Recorrer datos y crear options
            echo "<label for='medida'>medida:</label>
            
            <select name='insumo' id='opcion'>";
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["IdUnidadMedida"] . "'>" . $row["medida"] . "</option>";
                }
            } else {
                echo "0 results";
            }
            echo "</select>";
            
            // Actualizar valor del option en la base de datos
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Actualizar valor del option en la base de datos
                $sql = "UPDATE tblunidadesmedidas SET IdUnidadMedida = " . $_POST['medida'] . " WHERE IdUnidadMedida = 1";

                if ($conexion->query($sql) === TRUE) {
                    echo "Record updated successfully";
                } else {
                    echo "Error updating record: " . $conexion->error;
                }
            }
            ?>
            <input type="submit" value="Agregar">
        </form>
    </section>

    <script src="../../vista/js/main.js"></script>
</body>
</html>