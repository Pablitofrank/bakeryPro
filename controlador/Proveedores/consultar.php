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
    <title>Consultar Proveedores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Fugaz+One&family=Inter:wght@100&family=Quicksand:wght@300;500;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
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
                    <a href="../../vista/html/productos.php">
                        <i class='bx bx-grid-alt'></i>
                        <span class="links_name">Productos</span>
                    </a>
                        <span class="tooltip">Productos</span>
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
        <h2 class="titleContainer">Resultado de la Consulta de Proveedores</h2>
        
        <?php

        include '../../modelo/conexion.php';

        $sql = "SELECT * FROM tblproveedores";
        $resultado = $conexion->query($sql);
        ?>

        <?php if ($resultado->num_rows > 0) { ?>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>NIT</th>
                    <th>Razon social</th>
                    <th>Contacto</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>Direccion</th>
                    <th>Acciones</th>

                </tr>
                <?php while ($fila = $resultado->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $fila['IdProveedores']; ?></td>
                        <td><?php echo $fila["NIT"]; ?></td>
                        <td><?php echo $fila["RazonSocial"]; ?></td>
                        <td><?php echo $fila["Contacto"]; ?></td>
                        <td><?php echo $fila["Telefono"]; ?></td>
                        <td><?php echo $fila["Correo"]; ?></td>
                        <td><?php echo $fila["Direccion"]; ?></td>
                        <td>
                            <a href='editar.php?IdProveedores=<?php echo $fila['IdProveedores']; ?>'><img src="../../vista/img/editar.png" alt="editar"></a>
                            <a href="#" class="btn3 btn-sm " data-bs-toggle="modal" data-bs-target="#ModalEliminarProveedor" data-bs-id="<?php echo $fila['IdProveedores']; ?>"><img src="../../vista/img/eliminar.png" alt="eliminar"></a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        <?php } else { ?>
            <p>No se encontraron resultados para el ID proporcionado.</p>
        <?php } ?>

        <?php $conexion->close(); ?>
        <br>
            <a href="../../vista/html/proveedores.php" class="volverConsultar">Volver</a>
        </div>
        
    </section>
    <?php include 'ModalEliminarProveedor.php'; ?>

    <script>
        let ModalEditarProveedores = document.getElementById('ModalEditarProveedores')
        let ModalEliminarProveedor = document.getElementById('ModalEliminarProveedor')

        ModalEliminarProveedor.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let IdProveedores = button.getAttribute('data-bs-id')

            let inputIdProveedores = ModalEliminarProveedor.querySelector('.modal-body #IdProveedores')
            let inputNIT = ModalEliminarProveedor.querySelector('.modal-body #NIT')
            let inputRazonSocial = ModalEliminarProveedor.querySelector('.modal-body #RazonSocial')
            let inputContacto = ModalEliminarProveedor.querySelector('.modal-body #Contacto')
            let inputTelefono = ModalEliminarProveedor.querySelector('.modal-body #Telefono')
            let inputCorreo = ModalEliminarProveedor.querySelector('.modal-body #Correo')
            let inputDireccion = ModalEliminarProveedor.querySelector('.modal-body #Direccion')
            

            let url = "editar.php"
            let formData = new FormData();
            formData.append('IdProveedores', IdProveedores);
// Agrega otras líneas para los demás campos del formulario


            fetch(url,{
                method: "POST",
                body: formData
            }).then(response => response.json())
            .then(data => {

                inputIdProveedores.value = data.IdProveedores
                inputNIT.value = data.NIT
                inputRazonSocial.value = data.RazonSocial
                inputContacto.value = data.Contacto
                inputTelefono.value = data.Telefono
                inputCorreo.value = data.Correo
                inputDireccion.value = data.Direccion

            }).catch(err => console.log(err))

        })

        ModalEliminarProveedor.addEventListener('shown.bs.modal', event => {
    let button = event.relatedTarget
    let IdProveedores = button.getAttribute('data-bs-id')
    ModalEliminarProveedor.querySelector('.modal-footeer #IdProveedores').value = IdProveedores
})

    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="buscador/buscador.js"></script>

</body>
</html>