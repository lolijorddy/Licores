<?php
session_start();
if (empty($_SESSION["id"])) {
    header("location: login");
    exit();
}

if (isset($_GET["id"])) {
    $userId = $_GET["id"];

    // Conexión a la base de datos (ajusta los detalles de la conexión)
    $conn = mysqli_connect("localhost", "loli", "73993727loli", "prueba");

    // Verificar la conexión
    if (!$conn) {
        die("Error en la conexión: " . mysqli_connect_error());
    }

    // Verificar si se proporciona un ID válido a través de la URL
    $userId = mysqli_real_escape_string($conn, $userId); // Evitar SQL injection
    $sql = "SELECT * FROM usuario WHERE id = $userId";

    // Ejecutar la consulta
    $result = mysqli_query($conn, $sql);

    // Verificar si se encontró el usuario
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $nombre = $row['nombres'];
        $apellidos = $row['apellidos'];
        $correo_electronico = $row['correo_electronico'];
        $usuario = $row['usuario'];
        // Agrega más campos aquí según tus necesidades
    } else {
        echo "El usuario no se encontró.";
        mysqli_close($conn);
        exit();
    }
} else {
    echo "ID de usuario no proporcionado.";
    mysqli_close($conn);
    exit();
}

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nuevoNombre = $_POST["nuevoNombre"];
    $nuevosApellidos = $_POST["nuevosApellidos"];
    $nuevoCorreo = $_POST["nuevoCorreo"];
    $nuevoUsuario = $_POST["nuevoUsuario"];
    // Agrega más campos aquí según tus necesidades

    // Actualizar los datos del usuario en la base de datos
    $updateSql = "UPDATE usuario SET nombres = '$nuevoNombre', apellidos = '$nuevosApellidos',correo_electronico = '$nuevoCorreo', usuario = '$nuevoUsuario' WHERE id = $userId";
    if (mysqli_query($conn, $updateSql)) {
        // Recuperar los nuevos valores de la base de datos después de la actualización
        $sql = "SELECT * FROM usuario WHERE id = $userId";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            die("Error en la consulta: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $nombre = $row['nombres'];
            $apellidos = $row['apellidos'];
            $correo_electronico = $row['correo_electronico'];
            $usuario = $row['usuario'];
            // Agrega más campos aquí según tus necesidades
        }

        // Ahora establece los nuevos valores como el valor de los campos de entrada en el formulario
        // Esto actualizará los campos en la interfaz de usuario
        echo "Los datos del usuario se actualizaron correctamente.";
    } else {
        echo "Error al actualizar los datos del usuario: " . mysqli_error($conn);
    }
}

// Cerrar la conexión
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link rel="icon" type="image/x-icon" href="/login/img/favicon.ico">
    <!-- Agrega tus enlaces CSS y JS aquí si es necesario -->
</head>
<body>
    <h2>Editar Usuario</h2>

    <form method="POST" action="">
        <label for="nuevoNombre">Nombre:</label>
        <input type="text" id="nuevoNombre" name="nuevoNombre" value="<?php echo htmlspecialchars($nombre); ?>"><br>

        <label for="nuevosApellidos">Apellidos:</label>
        <input type="text" id="nuevosApellidos" name="nuevosApellidos" value="<?php echo htmlspecialchars($apellidos); ?>"><br>

        <label for="nuevoNombre">Correo Electronico:</label>
        <input type="text" id="nuevoCorreo" name="nuevoCorreo" value="<?php echo htmlspecialchars($correo_electronico); ?>"><br>

        <label for="nuevoUsuario">Usuario:</label>
        <input type="text" id="nuevoUsuario" name="nuevoUsuario" value="<?php echo htmlspecialchars($usuario); ?>"><br>

        <!-- Agrega más campos aquí según tus necesidades -->

        <input type="submit" value="Guardar Cambios">
    </form>

    <a href="visualiza_usuarios">Regresar a la lista de usuarios</a>
</body>
</html>


