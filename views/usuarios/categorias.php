<?php require '../../includes/_db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Muestra de Datos</title>
    <!-- Incluye las bibliotecas de Bootstrap y jQuery -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Estilos para el modal personalizado -->
    <style>
        /* Añade tus estilos personalizados aquí si es necesario */
    </style>
</head>
<body>
    <div class="row">
        <div class="col-sm-4">
            <!-- Aquí puede ir otro contenido si lo necesitas -->
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <input type="button" value="Agregar Categoría" class="soon" onclick="location.href='../../registrar_categoria.php';">
            <a href="../../inicio.php">Regresar al inicio</a>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <?php
            // Escribe tu consulta SQL para obtener categorías
            $sql = "SELECT * FROM categoria"; // Reemplaza 'tu_tabla' con el nombre de tu tabla de categorías
            $result = $conexion->query($sql); // Ejecuta la consulta en la base de datos

            if ($result->num_rows > 0) {
                // Si hay resultados, los mostramos uno por uno
                echo "<table class='table table-bordered'>"; // Utiliza una tabla Bootstrap
                echo "<tr><th>Nombre</th><th>Descripción</th><th>Acciones</th></tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>".$row["NombreCategoria"]."</td><td>".$row["Descripcion"]."</td>";
                    echo "<td><button class='btn btn-primary' onclick=\"location.href='editar_categoria.php?id=".$row["IdCategoria"]."'\">Editar</button> <button class='btn btn-danger' onclick=\"location.href='eliminar_categoria.php?id=".$row["IdCategoria"]."'\">Eliminar</button> <button class='btn btn-info' data-toggle='modal' data-target='#categoria".$row["IdCategoria"]."'>Ver detalles</button></td></tr>";

                    // Contenido del modal
                    echo "<div class='modal fade' id='categoria".$row["IdCategoria"]."'>";
                    echo "<div class='modal-dialog'>";
                    echo "<div class='modal-content'>";
                    echo "<div class='modal-header'>";
                    echo "<h4 class='modal-title'>Detalles de la Categoría</h4>";
                    echo "<button type='button' class='close' data-dismiss='modal'>&times;</button>";
                    echo "</div>";
                    echo "<div class='modal-body'>";
                    echo "<p><strong>Nombre: </strong>".$row["NombreCategoria"]."</p>";
                    echo "<p><strong>Descripción: </strong>".$row["Descripcion"]."</p>";

                    // Realiza una consulta para obtener los productos de la categoría actual
                    $sqlProductos = "SELECT * FROM productos WHERE IdCategorias = ".$row["IdCategoria"];
                    $resultProductos = $conexion->query($sqlProductos);

                    if ($resultProductos->num_rows > 0) {
                        echo "<h5>Productos en esta categoría:</h5>";
                        echo "<ul>";
                        while ($rowProducto = $resultProductos->fetch_assoc()) {
                            echo "<li><strong>Nombre del Producto:</strong> ".$rowProducto["NombreProducto"]."</li>";
                            echo "<li><strong>Precio:</strong> ".$rowProducto["Precio"]."</li>";
                        echo "<li><strong>Stock Disponible:</strong> ".$rowProducto["Stock"]."</li>";
                        }
                        echo "</ul>";
                    } else {
                        echo "<p>No hay productos en esta categoría.</p>";
                    }

                    echo "</div>";
                    echo "<div class='modal-footer'>";
                    echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
                echo "</table>";
            } else {
                echo "0 resultados";
            }
            $conexion->close();
            ?>
        </div>
    </div>
</body>
</html>
