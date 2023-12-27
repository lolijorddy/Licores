<!DOCTYPE html>
<html lang="es-MX">
<?php require '../../includes/_db.php'; 
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


<body>
<div class="container">
<div class="col-sm-6 offset-3 mt-5">
<form action="../../includes/_functions.php" method="POST"  enctype="multipart/form-data">

<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="nombre" class="form-label">Nombre del Producto *</label>
<input type="text"  id="nombre" name="nombre" class="form-control" required>
</div>
</div>

<div class="col-sm-6">
<div class="mb-3">
<label for="precio" class="form-label">Precio *</label>
<input type="number"  id="precio" name="precio" class="form-control" required>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-6">
<div class="mb-3">  
<label for="cantidad" class="form-label">Stock *</label>
<input type="number"  id="cantidad" name="cantidad" class="form-control" required>
</div>
</div>

</div>

<div class="row">
    <label for="unidad_medida" class="form-label">Unidad de Medida</label>
    <div class="select-wrapper">
        <select id="unidad_medida" name="unidad_medida" class="form-control">
            <option value="">Seleccionar</option>
            <?php foreach ($opcionesUnidadMedida as $opcionUnidad) { ?>
                <option value="<?php echo htmlspecialchars($opcionUnidad['id_unidad_medida']); ?>">
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
                <option value="<?php echo htmlspecialchars($opcion['IdCategoria']); ?>">
                    <?php echo htmlspecialchars($opcion['NombreCategoria']); ?>
                </option>
            <?php } ?>
        </select>
        <i class="fas fa-chevron-down select-arrow"></i>
    </div>
</div>                            
     
</div>
</div>
<div class="mb-3">
<div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <input type="file" class="form-control-file" name="foto" id="foto" required>
            </div>
        </div>
    </div>
</div>

<div class="mb-3">
<input type="hidden" name="accion" value="insertar_productos">
<button type="submit" class="btn btn-success">Guardar</button>
</div>
</form>
</div>
</div>
</body>

</html>