<?php
require '../../includes/_db.php';

$id = $_GET['id']; // Obtiene el ID de la URL

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Aquí eliminas el registro de la base de datos
    $deleteSql = "DELETE FROM categoria WHERE IdCategoria = $id";
    if ($conexion->query($deleteSql) === TRUE) {
        echo "Registro eliminado con éxito";
        // Redirige de vuelta a la lista de categorías o a donde consideres
    } else {
        echo "Error al eliminar el registro: " . $conexion->error;
    }
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Eliminar Categoría</title>
</head>
<body>
    <p>La categoría ha sido eliminada.</p>
    <a href="categorias.php">Volver a la lista de categorías</a>
</body>
</html>
