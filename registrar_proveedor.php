<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Proveedores</title>
    <script>
        function buscarRUC() {
    var ruc = document.getElementById('ruc_proveedor').value;

    fetch('buscar_ruc.php?ruc=' + ruc)
        .then(response => response.json())
        .then(data => {
            // Actualiza los campos del formulario con los datos obtenidos
            // Ejemplo:
            document.getElementById('razon_social').value = data.nombre_o_razon_social || '';
            document.getElementById('direccion').value = data.direccion || '';
            // etc...
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al buscar información del RUC');
        });
}

    </script>
</head>
<body>
    <h2>Registro de Proveedores</h2>
    <form id="formProveedor" action="procesar_registro_proveedor.php" method="post">
        <label for="ruc_proveedor">RUC:</label>
        <input type="text" id="ruc_proveedor" name="ruc_proveedor">
        <button type="button" onclick="buscarRUC()">Buscar RUC</button>

        <label for="razon_social">Razón Social:</label>
        <input type="text" id="razon_social" name="razon_social">

        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion">

        <label for="razon_comercial">Razón Comercial:</label>
        <input type="text" id="razon_comercial" name="razon_comercial">

        <label for="representante">Representante:</label>
        <input type="text" id="representante" name="representante">

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono">

        <label for="observacion">Observación:</label>
        <textarea id="observacion" name="observacion"></textarea>

        <button type="submit">Registrar Proveedor</button>
    </form>
</body>
</html>
