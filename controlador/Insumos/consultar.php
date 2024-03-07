<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuarios</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Fugaz+One&family=Inter:wght@100&family=Quicksand:wght@300;500;700&display=swap" rel="stylesheet">

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../vista/style/styles.css">
    <link rel="shortcut icon" href="../../vista/img/logo.svg" type="image/x-icon">
    
</head>
<body>
    <!-- Formulario -->
    <!-- <form action="./dashboard.php" method="post">
        <div class="sidebar">
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
    </form> -->
    

    <div class="container">
    <h2>Resultado de la Consulta de Insumos</h2>
    <?php
    include '../../modelo/conexion.php';

    // el select

    // if (isset($_POST['idInsumo'])) {
    //     $idInsumo = $_POST['idInsumo'];
    //     $sql = "SELECT * FROM tblinsumos INNER JOIN tblUnidadesMedidas ON tblinsumos.IdUnidadMedida = tblUnidadesMedidas.IdUnidadMedida WHERE IdInsumo=$idInsumo";
    //     $resultado = $conexion->query($sql);
    // } else {
    //     echo "<p>FDGDFG.</p>";
    //     exit;
    // }
        $sql = "SELECT tblinsumos.IdInsumo, tblinsumos.NombreInsumo, tblinsumos.Stock, tblunidadesmedidas.medida
        FROM tblinsumos
        INNER JOIN tblunidadesmedidas ON tblinsumos.IdUnidadMedida = tblunidadesmedidas.IdUnidadMedida;
        ";
        $resultado = $conexion->query($sql);
    

    // filtro de busqueda
    if (!isset($_POST['buscar'])){$_POST['buscar']='';}
    if (!isset($_POST['buscarcategoria'])){$_POST['buscarcategoria']='';}
    ?>
    <form class="form" name="form" method="POST"action="index.php">
        <div>
            <label  class="label">Nombre</label>
            <input type="text" class="form" id="buscar" name="buscar" value=" <?php echo $_POST["buscar"] ?>">
       
        </div>
   
  
    
        <p> Bucar por categoria</p>
        <table class="table">
            <thead>
                <tr class="filters">
                    <th>
                        categoria
                        <select name="" id="asignned-tutor-filter" id="buscarcategoria" class="form-control mt-2">
                            <?php if ($_POST ["buscarcategoria"] !='' ){ ?>
                            <option value="<?php echo $_POST["buscarcategoria"]; ?>"><?php echo $_POST["buscarcategoria"]; ?></option> 
                            <?php }?>
                            <option value="">Todos</option>
                            <option value="cat1">cat1</option>
                            <option value="cat2">cat2</option>
                            <option value="cat3">cat3</option>
                            <option value="cat4">cat4</option>
                        </select>
                    </th>
                </tr>
            </thead>
        </table>
    
        <div class="col-1">
            <input type="submit" class="btn" value="ver">
        </div>
        <?php  
         if ($_POST['buscar']  == ''){$_POST ['buscar']= '';}
         $aKeyword = explode(" ", $_POST['buscar']);
         
         if ($_POST["buscar"] == '' AND $_POST['buscarcategoria'] == '') {
            $query = "SELECT tblinsumos.*, tblcategorias.categoria 
                      FROM tblinsumos 
                      INNER JOIN tblcategorias ON tblinsumos.Idcategoria = tblcategorias.Idcategoria";
        } else {
            $query = "SELECT tblinsumos.*, tblcategorias.categoria 
                      FROM tblinsumos 
                      INNER JOIN tblcategorias ON tblinsumos.Idcategoria = tblcategorias.Idcategoria";
        
            if ($_POST["buscar"] != '') {
                $aKeyword = explode(" ", $_POST["buscar"]);
        
                $query .= " WHERE (tblinsumos.NombreInsumo LIKE LOWER('%".$aKeyword[0]."%') OR tblcategorias.categoria LIKE LOWER('%".$aKeyword[0]."%'))";
        
                for ($i = 1; $i < count($aKeyword); $i++) {
                    if (!empty($aKeyword[$i])) {
                        $query .= " OR tblinsumos.NombreInsumo LIKE '%" . $aKeyword[$i] . "%' OR tblcategorias.categoria LIKE '%" . $aKeyword[$i] . "%'";
                    }
                }
            }
        
            if ($_POST['buscarcategoria'] != '') {
                $categoria = $_POST['buscarcategoria'];
        
                if ($_POST["busc ar"] != '') {
                    $query .= " AND ";
                } else {
                    $query .= " WHERE ";
                }
        
                $query .= "tblcategorias.categoria LIKE '%" . $categoria . "%'";
            }
        }
        

   

        if ($_POST["buscar"] != '' ){

            $query .= " AND NombreInsumo = '".$_POST['buscar']."' ";

     }

     

     if ($_POST["buscarcategoria"] != '' ){

        $query .= " AND NombreInsumo = '".$_POST['buscarcategoria']."' ";

 }
        // Ejecutar la consulta $query
          
        ?>
        <p><i class="mdi mdi-file-document"></i>Resultados encontrados</p>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Categoria</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                    <td><?php echo $rowsql["Nombre"];?></td>
                    <td><?php echo $rowsql["Categoria"];?></td>
            </tr>
        </tbody>
    </table>



    <?php if ($resultado->num_rows > 0) { ?>
        <table border="1">
            <tr>
                <th>ID Insumo</th>
                <th>Nombre Insumo</th>
                <th>Stock</th>
                <th>ID Unidad Medida</th>
                <th>Acciones</th>
            </tr>
            <?php while ($fila = $resultado->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $fila['IdInsumo']; ?></td>
                    <td><?php echo $fila["NombreInsumo"]; ?></td>
                    <td><?php echo $fila["Stock"]; ?></td>
                    <td><?php echo $fila["medida"]; ?></td>
                    <td>
                        <a href='eliminar.php?idInsumo=<?php echo $fila["IdInsumo"]; ?>'>Eliminar</a>
                        <a href='editar.php?idInsumo=<?php echo $fila["IdInsumo"]; ?>'>EDITAR</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>No se encontraron resultados para el ID de insumo proporcionado.</p>
    <?php } ?>

    <?php $conexion->close(); ?>
    </div>
</body>
</html>