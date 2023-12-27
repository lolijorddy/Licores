<!DOCTYPE html>
<html lang="es-MX">
<body>
<div class="container">
        <form action="" method="POST" class="formulario" id="registroForm">
            <h2 class="titulo">REGISTRAR CATEGORIA</h2>
            <?php
            include ("modelo/conexion.php");
            include ("controlador/controlador_registra_categoria.php");
            ?>    
<div class="container">
        <div class="col-sm-6 offset-3 mt-5">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre de la Categoría *</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción *</label>
                    <textarea id="descripcion" name="descripcion" class="form-control" required></textarea>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-success">Guardar Categoría</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
