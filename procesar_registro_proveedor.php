<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $ruc_proveedor = $_POST['ruc_proveedor'];
    $razon_social = $_POST['razon_social'];
    $direccion = $_POST['direccion'];
    $razon_comercial = $_POST['razon_comercial'];
    $representante = $_POST['representante'];
    $telefono = $_POST['telefono'];
    $observacion = $_POST['observacion'];

    // Conexión a la base de datos
    require_once "includes/_db.php";

    // Preparar la consulta SQL para insertar los datos
    $consulta = "INSERT INTO proveedores (ruc_proveedor, razon_social, direccion, razon_comercial, representante, telefono, observacion) VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Preparar y ejecutar la consulta
    if ($stmt = $conexion->prepare($consulta)) {
        $stmt->bind_param("sssssss", $ruc_proveedor, $razon_social, $direccion, $razon_comercial, $representante, $telefono, $observacion);

        if ($stmt->execute()) {
            // Imprimir una alerta de JavaScript y luego limpiar el formulario o realizar otra acción
            echo "<script>alert('Proveedor registrado con éxito.'); window.location.href='registrar_proveedor.php';</script>";
        } else {
            echo "Error al registrar el proveedor: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conexion->error;
    }

    $conexion->close();
}
?>
