<?php require '../../includes/_db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Muestra de Datos</title>
    <!-- Añade aquí tus enlaces a CSS u otros recursos si los necesitas -->
</head>
<body>
    <div class="row">
        <div class="col-sm-4">
            <!-- Aquí puede ir otro contenido si lo necesitas -->
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <input type="button" value="Agregar unidad de medida" class="soon" onclick="location.href='../../registrar_unidad_medida.php';">
            <a href="../../inicio.php">Regresar al inicio</a>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <?php
            // Escribe tu consulta SQL
            $sql = "SELECT * FROM unidad_medida"; // Reemplaza 'tu_tabla' con el nombre de tu tabla
            $result = $conexion->query($sql); // Ejecuta la consulta en la base de datos

            if ($result->num_rows > 0) {
                // Si hay resultados, los mostramos uno por uno
                echo "<table>"; // Inicia una tabla HTML para mostrar los datos
                echo "<tr><th>Nombre de la unidad</th><th>Abreviatura</th><th>Descripción</th></tr>"; // Ejemplo de encabezados de columna, ajusta según tu tabla
                while($row = $result->fetch_assoc()) {
                    // Por cada fila, muestra los datos en la tabla
                    echo "<tr><td>".$row["nombre_unidad"]."</td><td>".$row["abreviatura"]."</td><td>".$row["descripcion"]."</td></tr>"; // Ajusta los campos según tu tabla
                    
                }
                echo "</table>"; // Cierra la tabla HTML
            } else {
                echo "0 resultados"; // Si no hay resultados, muestra un mensaje
            }
            $conexion->close(); // Cierra la conexión a la base de datos
            ?>
        </div>
    </div>
</body>
</html>