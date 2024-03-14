<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);


    include '../../modelo/conexion.php';
    $sql = "SELECT * FROM tblinsumos";
    $result = $conexion->query($sql);
?>

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
            <h2 class="titleContainer">Agregar Receta</h2>
            <form action="../../controlador/Recetas/insertar.php" method="post" class="form" id="receta-form">
                <label for="Producto" class="label">Producto:</label> 
                <input type="text" name="Producto" class="input" required><br>
                    
                <div id="contenedor-insumos">
                <!-- Selector de insumo inicial -->
                <div>
                    <select name="NombreInsumo[]" class="input">
                        <?php
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row["IdInsumo"] . "'>" . $row["NombreInsumo"] . "</option>";
                                }
                            } else {
                                echo "<option value=''>No hay insumos disponibles</option>";
                            }
                        ?>
                    </select>
                    <input type='text' name='cantidadInsumo[]' placeholder='Cantidad' class='input' required>
                    <?php
                        include '../../modelo/conexion.php';
                        $sql = "SELECT * FROM tblunidadesmedidas";
                        $result = $conexion->query($sql);

                        // Recorrer datos y crear options
                        echo "<label for='medida' class='label'></label>
                        <select name='idUnidadMedida[]' id='medida' class='input'>";

                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row["IdUnidadMedida"] . "'>" . $row["medida"] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No hay unidades de medida disponibles</option>";
                        }
                        echo "</select>";
                    ?>
                </div>
            </div>
            <button type="button" onclick="eliminarUltimoElemento()">Eliminar Último</button>
            <button type="button" onclick="agregarElemento()">Agregar Insumo y Cantidad</button>
            <br>
            <br>
            <input type="submit" value="Agregar" class="btn"> <br>
        </form>
        <div>
            <h2 class="titleContainer">Consulta Proveedores</h2>
            <form action="../../controlador/recetas/consultar.php" method="post">
                <input type="submit" value="Consultar" class="btn">
            </form>
        </div>  
    </div>
    

    </section>

    <script>
    var contenedorInsumos = document.getElementById("contenedor-insumos");
    var selectInicial = contenedorInsumos.querySelector("select").cloneNode(true);
    var unidadMedidaSelect = document.getElementById("medida").cloneNode(true); // Clonar el select de unidades de medida
    var contador = 1; // Inicializar contador

    function agregarElemento() {
        var contenedorNuevoInsumo = document.createElement("div");

        // Clonar el select inicial y asignar un nuevo nombre con el contador
        var nuevoSelect = selectInicial.cloneNode(true);
        nuevoSelect.name = "NombreInsumo[" + contador + "]";

        // Clonar el select de unidades de medida y asignar un nuevo nombre con el contador
        var nuevoUnidadMedidaSelect = unidadMedidaSelect.cloneNode(true);
        nuevoUnidadMedidaSelect.name = "idUnidadMedida[" + contador + "]";

        // Crear un nuevo input para la cantidad con nombre correspondiente
        var nuevoInputCantidad = document.createElement("input");
        nuevoInputCantidad.type = "text";
        nuevoInputCantidad.name = "cantidadInsumo[" + contador + "]";
        nuevoInputCantidad.placeholder = "Cantidad";
        nuevoInputCantidad.className = "input";
        nuevoInputCantidad.required = true;

        // Agregar el nuevo select, input y select de unidad de medida al contenedor
        contenedorNuevoInsumo.appendChild(nuevoSelect);
        contenedorNuevoInsumo.appendChild(nuevoInputCantidad);
        contenedorNuevoInsumo.appendChild(nuevoUnidadMedidaSelect);

        // Incrementar el contador para el próximo elemento
        contador++;

        contenedorInsumos.appendChild(contenedorNuevoInsumo);
    }

    function eliminarUltimoElemento() {
        var elementos = contenedorInsumos.children;
        if (elementos.length > 1) {
            contenedorInsumos.removeChild(elementos[elementos.length - 1]);
            contador--; // Decrementar el contador al eliminar el último elemento
        }
    }
</script>
</body>
</html>
