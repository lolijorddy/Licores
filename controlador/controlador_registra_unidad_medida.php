<?php
// Archivo que contiene la conexión a la base de datos
include ("includes/_db.php");

// Función para manejar errores y cerrar recursos
function manejarError($mensaje, $stmt = null, $conexion = null) {
    if ($stmt !== null) {
        $stmt->close();
    }
    if ($conexion !== null) {
        $conexion->close();
    }
    die($mensaje);
}

// Verifica si se enviaron datos por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera y valida los datos del formulario
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $abreviatura = filter_input(INPUT_POST, 'abreviatura', FILTER_SANITIZE_STRING);
    $descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_STRING);

    // Verifica si los datos son válidos
    if (!$nombre || !$abreviatura ||!$descripcion) {
        manejarError("Datos inválidos en el formulario.");
    }

    // Verifica la conexión a la base de datos
    if ($conexion->connect_error) {
        manejarError("Error de conexión a la base de datos: " . $conexion->connect_error);
    }

    // Prepara la consulta SQL para insertar la categoría en la base de datos
    $sql = "INSERT INTO unidad_medida (nombre_unidad, abreviatura, descripcion) VALUES (?, ?, ?)";

    // Prepara la declaración
    $stmt = $conexion->prepare($sql);

    // Verifica la preparación de la declaración
    if (!$stmt) {
        manejarError('Error de preparación de la consulta: ' . $conexion->error, null, $conexion);
    }

    // Vincula los parámetros con los valores
    $stmt->bind_param("sss", $nombre, $abreviatura, $descripcion);

    // Ejecuta la consulta
    if ($stmt->execute()) {
        // Cierra la conexión y la declaración
        $stmt->close();
        $conexion->close();

        // Redirecciona a alguna página después de insertar la categoría
        header('Location: views/usuarios/unidad_medida.php');
        exit();
    } else {
        // Manejar el error en caso de que la ejecución de la consulta falle
        manejarError('Error al ejecutar la consulta: ' . $stmt->error, $stmt, $conexion);
    }
}
?>