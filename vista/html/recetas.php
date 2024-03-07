<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recetas| BakeryPro</title>

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

    <!-- Formulario para agregar una nueva receta -->

    <section class="home-section">
    <div class="container">
        <div class="text">Agregar receta</div>
            <form action="../../controlador/recetas/insertar.php" method="post" class="form" id="receta-form">
                <label for="NombreReceta" class="label">Nombre Receta:</label> 
                    <input type="text" name="NombreProducto" class="input" required><br>
                    
                <div id="contenedor-insumos">
                    <?php
                        include '../../modelo/conexion.php';
                        $sql = "SELECT * FROM tblInsumos";
                        $result = $conexion->query($sql);
                        
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<div>";
                                echo "<select name='NombreInsumo[]' class='input'>";
                                echo "<option value='" . $row["IdInsumo"] . "'>" . $row["NombreInsumo"] . "</option>";
                                echo "</select>";
                                echo "<input type='text' name='cantidadInsumo[]' placeholder='Cantidad' class='input' required>";
                                echo "</div>";
                            }
                        } else {
                            echo "0 results";
                        }
                    ?>
                </div>
                <button type="button" onclick="agregarElemento()">Agregar Insumo y Cantidad</button>
                <br>
                <br>
                <input type="submit" value="Agregar" class="btn"> <br>
            </form>
        </div>
    </section>

    <script>
    var index = <?php echo $result->num_rows + 1; ?>; // Inicializar el índice para los nuevos elementos

    function agregarElemento() {
        var contenedorInsumos = document.getElementById("contenedor-insumos");
        var contenedorNuevoInsumo = document.createElement("div");

        // Selector de insumo
        var nuevoSelect = document.createElement("select");
        nuevoSelect.name = "NombreInsumo[" + index + "]"; // Aquí se utiliza el índice
        nuevoSelect.className = "input";
        nuevoSelect.innerHTML = contenedorInsumos.querySelector("select").innerHTML;
        contenedorNuevoInsumo.appendChild(nuevoSelect);

        // Campo de cantidad
        var nuevoInput = document.createElement("input");
        nuevoInput.type = "text";
        nuevoInput.name = "cantidadInsumo[" + index + "]"; // Aquí se utiliza el índice
        nuevoInput.placeholder = "Cantidad";
        nuevoInput.className = "input";
        nuevoInput.required = true;
        contenedorNuevoInsumo.appendChild(nuevoInput);

        contenedorInsumos.appendChild(contenedorNuevoInsumo);
        contenedorInsumos.appendChild(document.createElement("br"));

        index++;
    }
</script>

</body>
</html>
  