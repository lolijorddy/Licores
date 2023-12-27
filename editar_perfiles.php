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
    $sql = "SELECT * FROM cargo WHERE id = $userId";

    // Ejecutar la consulta
    $result = mysqli_query($conn, $sql);

    // Verificar si se encontró el usuario
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $descripcion = $row['descripcion'];
        $ID = $row['id'];
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
    $nuevoDescripcion = $_POST["nuevoDescripcion"];
    // Agrega más campos aquí según tus necesidades

    // Actualizar los datos del usuario en la base de datos
    $updateSql = "UPDATE cargo SET descripcion = '$nuevoDescripcion' where id = '$ID'";
    if (mysqli_query($conn, $updateSql)) {
        // Recuperar los nuevos valores de la base de datos después de la actualización
        $sql = "SELECT * FROM cargo WHERE id = $userId";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            die("Error en la consulta: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $descripcion = $row['descripcion'];
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
    <title>Editar Perfiles</title>
    <link rel="icon" type="image/x-icon" href="/login/img/favicon.ico">
    <!-- Agrega tus enlaces CSS y JS aquí si es necesario -->
    <style>
        body {
            background-image: url('img/barcelona.jpg');
            background-size: cover; /* Ajusta el tamaño de la imagen al tamaño de la ventana del navegador */
            background-repeat: no-repeat; /* Evita la repetición de la imagen de fondo */
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0; /* Color de fondo de la página */
        }
        .container {
            
            background-color: #fff; /* Color de fondo del panel */
            border: 1px solid #ccc; /* Borde del panel */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Sombra del panel */
        }

        h2 {
            font-size: 24px; /* Tamaño de letra para el encabezado */
        }

        label, input, a {
            font-size: 18px; /* Tamaño de letra para etiquetas, campos de entrada y enlaces */
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            font-size: 20px; /* Tamaño de letra para el botón de envío */
        }
    </style>
</head>
<body>
    <div class="container">
    <h2>Editar Perfiles</h2>

    <form method="POST" action="">
        <label for="nuevoDescripcion">Descripcion:</label>
        <input type="text" id="nuevoDescription" name="nuevoDescripcion" value="<?php echo htmlspecialchars($descripcion); ?>"><br>
        <!-- Agrega más campos aquí según tus necesidades -->

        <input type="submit" value="Guardar Cambios">
    </form>

    <a href="visualiza_perfiles">Regresar a la lista de perfiles</a>
    </div>
</body>
</html>


