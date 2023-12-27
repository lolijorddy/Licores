<?php
require '../../includes/_db.php';

$id = $_GET['id']; // Obtiene el ID de la URL
$sql = "SELECT * FROM categoria WHERE IdCategoria = $id";
$result = $conexion->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Aquí procesarías el formulario y actualizarías los datos en la base de datos
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    $updateSql = "UPDATE categoria SET NombreCategoria = '$nombre', Descripcion = '$descripcion' WHERE IdCategoria = $id";
    if ($conexion->query($updateSql) === TRUE) {
        header("Location: categorias.php"); // Redirige al usuario a una nueva página
        // Redirige de vuelta a la lista de categorías o a donde consideres
    } else {
        echo "Error al actualizar el registro: " . $conexion->error;
    }
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Editar Categoría</title>
</head>
<body>
    <form method="post">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" value="<?php echo $row['NombreCategoria']; ?>"><br>
        <label for="descripcion">Descripción:</label><br>
        <input type="text" id="descripcion" name="descripcion" value="<?php echo $row['Descripcion']; ?>"><br><br>
        <input type="submit" value="Actualizar">
    </form>
</body>
</html>
