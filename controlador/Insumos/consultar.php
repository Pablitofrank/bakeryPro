<!DOCTYPE html>
<html>
<head>
    <title>Resultado de la Consulta de Insumos</title>
    <link rel="stylesheet" type="text/css" href="../../vista/style/styles.css">
    
</head>
<body>
    <div class="container">
    <h2>Resultado de la Consulta de Insumos</h2>
    <?php
    include '../../modelo/conexion.php';



    if (isset($_POST['idInsumo'])) {
        $idInsumo = $_POST['idInsumo'];
        $sql = "SELECT * FROM tblinsumos INNER JOIN tblUnidadesMedidas ON tblinsumos.IdUnidadMedida = tblUnidadesMedidas.IdUnidadMedida WHERE IdInsumo=$idInsumo";
        $resultado = $conexion->query($sql);
    } else {
        echo "<p>FDGDFG.</p>";
        exit;
    }

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
                        <select name="" id="asignned-tutor-filter" id="buscacategoria" class="form-control mt-2">
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
         
         if ($_POST["buscar"] == '' AND $_POST['buscacategoria'] == '') {
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
        
            if ($_POST['buscacategoria'] != '') {
                $categoria = $_POST['buscacategoria'];
        
                if ($_POST["buscar"] != '') {
                    $query .= " AND ";
                } else {
                    $query .= " WHERE ";
                }
        
                $query .= "tblcategorias.categoria LIKE '%" . $categoria . "%'";
            }
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