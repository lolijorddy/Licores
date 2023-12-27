<!DOCTYPE html>
<html lang="en">
<?php 
require '../../includes/_db.php'; // Asegúrate de que esta es la ruta correcta al archivo de conexión

?>

<head>
    <title>Productos</title>
    <!-- Incluye aquí tus hojas de estilo, si las tienes -->
    <style>
        
    </style>
</head>

<body>
    <div id="content">
        <section>
            <div class="container mt-5">
                <div class="row">
                    <div class="col-sm-12 mb-3">
                        <center><h1>Productos</h1></center>
                        <a href="producto_agregar.php"><input class="btn btn-primary" type="button" value="Agregar producto"></a>
                        <a href="../../inicio.php">Regresar al inicio</a>
                    </div>
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Nombre</th>
                                        <th>Precio Unidad</th>
                                        <th>Stock</th>
                                        <th>Unidad de medida</th>
                                        <th>Categorias</th>
                                        <th>Imagen</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT p.*, c.NombreCategoria, u.nombre_unidad 
                                    FROM productos p 
                                    JOIN categoria c ON p.IdCategorias = c.IdCategoria 
                                    JOIN unidad_medida u ON p.IdUnidad_Medida = u.id_unidad_medida";  
                                    $productos = mysqli_query($conexion, $sql);
                                    $productos = mysqli_query($conexion, $sql);
                                    if (!$productos) {
                                        die("Error en la consulta SQL: " . mysqli_error($conexion));
                                    }
                                    if ($productos && $productos->num_rows > 0) {
                                        foreach ($productos as $row) {
                                            
                                            ?>
                                            <tr>
                                                <td><?php echo $row['IdProducto']; ?></td>
                                                <td><?php echo $row['NombreProducto']; ?></td>
                                                <td>S/. <?php echo $row['Precio']; ?></td>
                                                <td class="<?php echo $clase; ?>"><?php echo $row['Stock']; ?></td>
                                                <td><?php echo $row['nombre_unidad']; ?></td>
                                                <td><?php echo $row['NombreCategoria']; ?></td>
                                                <td><img width="100" src="data:image;base64,<?php echo base64_encode($row['Imagen']); ?>"></td>
                                                <td>
                                                    <a href="producto_editar.php?id=<?php echo $row['IdProducto']; ?>">
                                                        <div>Editar</div>
                                                    </a>
                                                    <a href="producto_eliminar.php?id=<?php echo $row['IdProducto']; ?>">
                                                        <div>Eliminar</div>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr class="text-center">
                                            <td colspan="8">No existen registros</td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Aquí puede ir más contenido si lo necesitas -->
    </div>
</body>
</html>
