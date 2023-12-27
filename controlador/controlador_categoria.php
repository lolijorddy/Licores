<?php
include "../modelo/conexion.php";

// Consulta a la base de datos para obtener las opciones
$query = "SELECT IdCategoria, NombreCategoria, Descripcion FROM categoria";
$resultado = mysqli_query($conexion, $query);

$opciones = array(); // Corregí el nombre de la variable

while ($fila = mysqli_fetch_assoc($resultado)) {
    $opciones[$fila['IdCategoria']] = $fila['NombreCategoria'];
}
?>
