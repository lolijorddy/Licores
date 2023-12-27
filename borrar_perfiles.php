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

    $sql = "SELECT * FROM cargo WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        throw new Exception("Error en la consulta: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $descripcion = $row['descripcion'];
        // Otros campos
    } else {
        header("location: visualiza_perfiles");
        exit();
    }

    mysqli_close($conn);
} else {
    header("location: visualiza_perfiles");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["id"])) {
        $id = $_POST["id"];
        $conn = conectarBaseDeDatos();

        $sql = "DELETE FROM cargo WHERE id = $id";
        if (mysqli_query($conn, $sql)) {
            // Redirige con mensaje de éxito si se borra con éxito
            header("location: visualiza_perfiles?borrado=exito");
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
    <title>Borrar Perfiles</title>
    <link rel="icon" type="image/x-icon" href="/login/img/favicon.ico">
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

            text-align: center;
            background-color: #fff; /* Color de fondo del contenedor */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 30px; /* Tamaño de letra para el encabezado */
        }

        p, .btn {
            font-size: 20px; /* Tamaño de letra para el texto y los botones */
        }

        .alert {
            margin-top: 10px;
            font-size: 20px; /* Tamaño de letra para la alerta */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Confirmar Borrado</h1>
        <p>¿Estás seguro de que deseas borrar este perfil "<?php echo $descripcion; ?>"?</p>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button type="submit" class="btn btn-danger">Sí, Borrar Perfil</button>
            <a href="visualiza_perfiles" class="btn btn-secondary">Cancelar</a>
        </form>
        <?php if (isset($errorBorrado)) { ?>
            <div class="alert alert-danger"><?php echo $errorBorrado; ?></div>
        <?php } ?>
    </div>
</body>
</html>

