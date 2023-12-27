<?php
include "modelo/conexion.php";

// Consulta a la base de datos para obtener las opciones
$query = "SELECT id, descripcion FROM cargo";
$resultado = mysqli_query($conexion, $query);

$opciones = array();

while ($fila = mysqli_fetch_assoc($resultado)) {
    $opciones[$fila['id']] = $fila['descripcion'];
}
?>