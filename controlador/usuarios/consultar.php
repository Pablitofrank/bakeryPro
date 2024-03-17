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
    <title>Editar Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Fugaz+One&family=Inter:wght@100&family=Quicksand:wght@300;500;700&display=swap" rel="stylesheet">

    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../vista/style/styles.css">
    <link rel="shortcut icon" href="../../vista/img/logo.svg" type="image/x-icon">
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
                                    <a href='#' class='btn3 btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#ModalEliminarUsuario' data-bs-id='".$fila['IdUsuario']."'><img src='../../vista/img/eliminar.png' alt='eliminar'></a>
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
    <?php include 'ModalEliminarUsuario.php'; ?>

<script>
    let ModalEliminarUsuario = document.getElementById('ModalEliminarUsuario')

    ModalEliminarUsuario.addEventListener('shown.bs.modal', event => {
        let button = event.relatedTarget
        let IdUsuario = button.getAttribute('data-bs-id')

        let inputIdUsuario = ModalEliminarUsuario.querySelector('.modal-body #IdUsuario')
        let inputNombres = ModalEliminarUsuario.querySelector('.modal-body #Nombres')
        let inputApellidos = ModalEliminarUsuario.querySelector('.modal-body #Apellidos')
        let inputRol = ModalEliminarUsuario.querySelector('.modal-body #Rol')
        let inputCedula = ModalEliminarUsuario.querySelector('.modal-body #Cedula')
        let inputTelefono = ModalEliminarUsuario.querySelector('.modal-body #Telefono')

        let url = "editar.php"
        let formData = new FormData();
        formData.append('IdUsuario', IdUsuario);
// Agrega otras líneas para los demás campos del formulario


        fetch(url,{
            method: "POST",
            body: formData
        }).then(response => response.json())
        .then(data => {

            inputIdUsuario.value = data.IdUsuario
            inputNombres.value = data.Nombres
            inputApellidos.value = data.Apellidos
            inputRol.value = data.Rol
            inputCedula.value = data.Cedula
            inputTelefono.value = data.Telefono

        }).catch(err => console.log(err))

    })

    ModalEliminarUsuario.addEventListener('shown.bs.modal', event => {
let button = event.relatedTarget
let IdUsuario = button.getAttribute('data-bs-id')
ModalEliminarUsuario.querySelector('.modal-footeer #IdUsuario').value = IdUsuario
})

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="buscador/buscador.js"></script>

</body>
</html>