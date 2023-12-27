<?php
session_start();
if (empty($_SESSION["id"])) {
    header("location: login");
    exit();
}

function conectarBaseDeDatos() {
    $conn = mysqli_connect("localhost", "loli", "73993727loli", "prueba");
    if (!$conn) {
        throw new Exception("Error en la conexión: " . mysqli_connect_error());
    }
    return $conn;
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $conn = conectarBaseDeDatos();

    $sql = "SELECT * FROM usuario WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        throw new Exception("Error en la consulta: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $nombre = $row['nombres'];
        $apellidos = $row['apellidos'];
        // Otros campos
    } else {
        header("location: visualiza_usuarios");
        exit();
    }

    mysqli_close($conn);
} else {
    header("location: visualiza_usuarios");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["id"])) {
        $id = $_POST["id"];
        $conn = conectarBaseDeDatos();

        $sql = "DELETE FROM usuario WHERE id = $id";
        if (mysqli_query($conn, $sql)) {
            // Redirige con mensaje de éxito si se borra con éxito
            header("location: visualiza_usuarios?borrado=exito");
            exit();
        } else {
            // Manejo de error si falla la eliminación
            $errorBorrado = "Error al borrar el usuario: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    } else {
        // No se proporcionó un ID de usuario válido
        $errorBorrado = "ID de usuario no válido";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Otras inclusiones de scripts y estilos -->
    <title>Borrar Usuario</title>
    <link rel="icon" type="image/x-icon" href="/login/img/favicon.ico">
</head>
<body>
    <div class="container">
        <h1>Confirmar Borrado</h1>
        <p>¿Estás seguro de que deseas borrar el usuario "<?php echo $nombre . ' ' . $apellidos; ?>"?</p>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button type="submit" class="btn btn-danger">Sí, Borrar Usuario</button>
            <a href="visualiza_usuarios" class="btn btn-secondary">Cancelar</a>
        </form>
        <?php if (isset($errorBorrado)) { ?>
            <div class="alert alert-danger"><?php echo $errorBorrado; ?></div>
        <?php } ?>
    </div>
</body>
</html>

