<?php

$id = $_GET['id'];
require_once ("../../includes/_db.php");
$consulta = "SELECT * FROM productos WHERE IdProducto = $id";
$resultado = mysqli_query($conexion, $consulta);
$productos = mysqli_fetch_assoc($resultado);
// Consulta para obtener las categorías de la tabla 'categoria'

$sql = "SELECT IdCategoria, NombreCategoria FROM categoria";
$resultado = $conexion->query($sql);

// Asegúrate de que la consulta sea exitosa y de que haya categorías
$opciones = $resultado->fetch_all(MYSQLI_ASSOC);
?> 

<?php 
// Consulta para obtener las unidades de medida
$sqlUnidadMedida = "SELECT id_unidad_medida, nombre_unidad FROM unidad_medida";
$resultadoUnidadMedida = $conexion->query($sqlUnidadMedida);

// Asegúrate de que la consulta sea exitosa y de que haya unidades de medida
$opcionesUnidadMedida = $resultadoUnidadMedida->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Editar Producto</title>
    <!-- Incluye aquí tus hojas de estilo, si las tienes -->
</head>
<body>
    <div class="container">
        <div class="col-sm-6 offset-3 mt-5">
            <form action="../../includes/_functions.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del Producto *</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" required value="<?php echo htmlspecialchars($productos['NombreProducto']); ?>">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio *</label>
                            <input type="number" id="precio" name="precio" class="form-control" required value="<?php echo htmlspecialchars($productos['Precio']); ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">  
                            <label for="cantidad" class="form-label">Stock *</label>
                            <input type="number" id="cantidad" name="cantidad" class="form-control" required value="<?php echo htmlspecialchars($productos['Stock']); ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <label for="unidad_medida" class="form-label">Unidad de Medida</label>
                    <div class="select-wrapper">
                        <select id="unidad_medida" name="unidad_medida" class="form-control">
                            <option value="">Seleccionar</option>
                            <?php foreach ($opcionesUnidadMedida as $opcionUnidad) { ?>
                                <option value="<?php echo htmlspecialchars($opcionUnidad['id_unidad_medida']); ?>" <?php if ($opcionUnidad['id_unidad_medida'] == $productos['IdUnidad_Medida']) echo 'selected'; ?>>
                                    <?php echo htmlspecialchars($opcionUnidad['nombre_unidad']); ?>
                                </option>
                            <?php } ?>
                        </select>
                        <i class="fas fa-chevron-down select-arrow"></i>
                    </div>
                </div>

                <div class="row">
                    <label for="categorias" class="form-label">Categorías</label>
                    <div class="select-wrapper">
                        <select id="categorias" name="categorias" class="form-control">
                            <option value="">Seleccionar</option>
                            <?php foreach ($opciones as $opcion) { ?>
                                <option value="<?php echo htmlspecialchars($opcion['IdCategoria']); ?>" <?php if ($opcion['IdCategoria'] == $productos['IdCategorias']) echo 'selected'; ?>>
                                    <?php echo htmlspecialchars($opcion['NombreCategoria']); ?>
                                </option>
                            <?php } ?>
                        </select>
                        <i class="fas fa-chevron-down select-arrow"></i>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="foto">Imagen del Producto</label>
                                <input type="file" class="form-control-file" name="foto" id="foto">
                                <!-- Opcional: Mostrar la imagen actual del producto -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <input type="hidden" name="accion" value="editar_producto">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
