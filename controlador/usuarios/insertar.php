<?php
include '../../modelo/conexion.php';

$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$rol = $_POST["rol"];
$cedula = $_POST['cedula'];
$telefono = $_POST['telefono'];

// Verifica si el valor de $rol existe en la tabla tblroles antes de la inserción
$consultaRol = "SELECT IdRol FROM tblroles WHERE IdRol = '$rol'";
$resultadoRol = $conexion->query($consultaRol);

if ($resultadoRol->num_rows > 0) {
    $sql = "INSERT INTO tblusuario (Nombres, Apellidos, IdRol, Cedula, Telefono) VALUES ('$nombres', '$apellidos', '$rol', '$cedula', '$telefono')";

    if ($conexion->query($sql) === TRUE) {
        header('Location: ../../vista/html/usuarios.php');
        echo 'El registro se insertó correctamente en la tabla tblusuario.';
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
} else {
    echo "Error: El valor de la clave externa no existe en la tabla tblroles.";
}

$conexion->close();
?>