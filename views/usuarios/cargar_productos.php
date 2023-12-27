<?php
// Asegurarse de que la ruta al archivo de conexión sea correcta
require '../../modelo/conexion.php';

// Deshabilitar la visualización de errores de PHP en producción
// Esto debe eliminarse en un entorno de producción
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);

// Verificar si el parámetro de categoría está presente y es válido
$IdCategorias = isset($_GET['categoria']) ? intval($_GET['categoria']) : 0;

if ($IdCategorias <= 0) {
    die("No se ha especificado una categoría válida.");
}

// Protección contra inyecciones SQL utilizando consultas preparadas
$sql = "SELECT * FROM productos WHERE IdCategorias = ?"; 

// Manejo de errores para la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$stmt = $conexion->prepare($sql);
if (!$stmt) {
    die("Error al preparar la consulta: " . $conexion->error);
}

$stmt->bind_param("i", $IdCategorias);
if (!$stmt->execute()) {
    die("Error al ejecutar la consulta: " . $stmt->error);
}

$result = $stmt->get_result();
if ($result->num_rows > 0) {
    echo "<ul class='list-group'>";
    while ($row = $result->fetch_assoc()) {
        // Escapar los datos para evitar ataques de inyección HTML
        $nombreProducto = htmlspecialchars($row["NombreProducto"]);
        echo "<li class='list-group-item'>$nombreProducto</li>";
    }
    echo "</ul>";
} else {
    echo "<p>No hay productos en esta categoría.</p>";
}

$stmt->close();
$conexion->close();
?>
