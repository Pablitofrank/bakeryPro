<?php
    session_start();
    if (!isset($_SESSION['cedula'])) {
        header("Location: ../../index.php");
        exit;
    }

    include '../../modelo/conexion.php';


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
    <title>Usuarios| BakeryPro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
            <h2 class="titleContainer">Resultado de la Consulta de Insumos</h2>
        <form action="" method="GET">
                <label for="search">Buscar:</label>
                <input type="text" id="search" name="search" class="input-filtro">
                
                <label for="category">Filtrar por categoría:</label>
                <select id="category" name="category" class="select-filtro">
                    <option value="">Todas las categorías</option>
                    <!-- Aquí debes generar opciones dinámicas con los datos de tu base de datos -->
                    <?php
                        include '../../modelo/conexion.php';
                        $sql = "SELECT * FROM tblcategorias";
                        $result = $conexion->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='".$row['IdCategoria']."'>".$row['Categoria']."</option>";
                            }
                        }
                        $conexion->close();
                    ?>
                </select>
                
                <button type="submit">Buscar</button>
            </form>
            
            <!-- Resultados de la búsqueda -->
            <?php
                include '../../modelo/conexion.php';
                
                // Construir la consulta SQL dinámica
                $sql = "SELECT tblinsumos.IdInsumo, tblinsumos.NombreInsumo, tblinsumos.Stock, tblunidadesmedidas.medida
                        FROM tblinsumos
                        INNER JOIN tblunidadesmedidas ON tblinsumos.IdUnidadMedida = tblunidadesmedidas.IdUnidadMedida";

                // Agregar condiciones según los valores de búsqueda y filtro
                if(isset($_GET['search']) && !empty($_GET['search'])) {
                    $search = $_GET['search'];
                    $sql .= " WHERE tblinsumos.NombreInsumo LIKE '%$search%'";
                }
                
                if(isset($_GET['category']) && !empty($_GET['category'])) {
                    $category = $_GET['category'];
                    $sql .= " AND tblinsumos.IdCategoria = $category";
                }

                $resultado = $conexion->query($sql);

                if ($resultado->num_rows > 0) {
                    echo "<table border='1'>
                            <tr>
                                <th>Nombre Insumo</th>
                                <th>Stock</th>
                                <th>Unidad de Medida</th>
                                <th>Acciones</th>
                            </tr>";
                    while ($fila = $resultado->fetch_assoc()) {
                        echo "<tr>
                                <td>{$fila["NombreInsumo"]}</td>
                                <td>{$fila["Stock"]}</td>
                                <td>{$fila["medida"]}</td>
                                <td>
                                    <a href='editar.php?idInsumo={$fila["IdInsumo"]}'><img src='../../vista/img/editar.png' alt='editar'></a>
                                    <a href='#' class='btn3 btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#ModalEliminarInsumo' data-bs-id='{$fila['IdInsumo']}'><img src='../../vista/img/eliminar.png' alt='eliminar'></a>
                                    </td>
                            </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No se encontraron resultados para la búsqueda y filtro proporcionados.</p>";
                }
                $conexion->close(); 
            ?>
            <br>
            <a href="../../vista/html/insumos.php" class="volverConsultar">VOLVER</a>
        </div>  
    </section>
    <?php include 'ModalEliminarInsumo.php'; ?>

<script>
    let ModalEliminarInsumo = document.getElementById('ModalEliminarInsumo')

    ModalEliminarInsumo.addEventListener('shown.bs.modal', event => {
        let button = event.relatedTarget
        let IdInsumo = button.getAttribute('data-bs-id')

        let inputIdInsumo = ModalEliminarInsumo.querySelector('.modal-body #IdInsumo')
        let inputNombreInsumo = ModalEliminarInsumo.querySelector('.modal-body #NombreInsumo')
        let inputStock = ModalEliminarInsumo.querySelector('.modal-body #Stock')
        let inputmedida = ModalEliminarInsumo.querySelector('.modal-body #medida')

        let url = "editar.php"
        let formData = new FormData();
        formData.append('IdInsumo', IdInsumo);
// Agrega otras líneas para los demás campos del formulario


        fetch(url,{
            method: "POST",
            body: formData
        }).then(response => response.json())
        .then(data => {

            inputIdInsumo.value = data.IdInsumo
            inputNombreInsumo.value = data.NombreInsumo
            inputStock.value = data.Stock
            inputmedida.value = data.medida

        }).catch(err => console.log(err))

    })

    ModalEliminarInsumo.addEventListener('shown.bs.modal', event => {
let button = event.relatedTarget
let IdInsumo = button.getAttribute('data-bs-id')
ModalEliminarInsumo.querySelector('.modal-footeer #IdInsumo').value = IdInsumo
})

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="buscador/buscador.js"></script>

</body>
</html>