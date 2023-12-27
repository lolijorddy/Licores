<?php

require_once ("_db.php");


if(isset($_POST['accion'])){ 
    switch($_POST['accion']){
        case 'eliminar_producto':
            eliminar_producto();

        break;        
        case 'editar_producto':
        editar_producto();

        break;

        case 'insertar_productos':
        insertar_productos();

        break;    
    }

}

function insertar_productos() {
    global $conexion;
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $precio = mysqli_real_escape_string($conexion, $_POST['precio']);
    $cantidad = mysqli_real_escape_string($conexion, $_POST['cantidad']);
    $unidad_medida = mysqli_real_escape_string($conexion, $_POST['unidad_medida']);
    $categorias = mysqli_real_escape_string($conexion, $_POST['categorias']);
    // Proceso de la imagen
    $tamanoArchvio = $_FILES['foto']['size'];
    $imagenSubida = fopen($_FILES['foto']['tmp_name'], 'r');
    $binariosImagen = fread($imagenSubida, $tamanoArchvio);
    $imagenFin = mysqli_escape_string($conexion, $binariosImagen);
    
    // Asegúrate de que estas son las columnas correctas y existen en tu tabla
    $consulta = "INSERT INTO productos (NombreProducto, Precio, Stock, IdUnidad_Medida, IdCategorias, Imagen) VALUES ('$nombre', '$precio', '$cantidad', '$unidad_medida', '$categorias', '$imagenFin');";

    if(mysqli_query($conexion, $consulta)){
        header("Location: ../views/usuarios/index.php");
        exit();
    } else {
        echo "Error en la inserción: " . mysqli_error($conexion);
    }
}

function editar_producto(){
    global $conexion;
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $precio = mysqli_real_escape_string($conexion, $_POST['precio']);
    $cantidad = mysqli_real_escape_string($conexion, $_POST['cantidad']);
    $unidad_medida = mysqli_real_escape_string($conexion, $_POST['unidad_medida']);
    $categorias = mysqli_real_escape_string($conexion, $_POST['categorias']);
    $id = mysqli_real_escape_string($conexion, $_POST['id']); // Asegúrate de que el ID se pasa correctamente

    // Manejo de la imagen
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $tamanoArchivo = $_FILES['foto']['size'];
        $imagenSubida = fopen($_FILES['foto']['tmp_name'], 'r');
        $binariosImagen = fread($imagenSubida, $tamanoArchivo);
        $imagenFin = mysqli_escape_string($conexion, $binariosImagen);
        $consultaImagen = ", Imagen = '$imagenFin'";
    } else {
        $consultaImagen = "";
    }

    // Consulta SQL para actualizar los datos
    $consulta = "UPDATE productos SET NombreProducto = '$nombre', Precio = '$precio', Stock = '$cantidad', IdUnidad_Medida = '$unidad_medida', IdCategorias = '$categorias' $consultaImagen WHERE IdProducto = $id";

    if(mysqli_query($conexion, $consulta)){
        header("Location: ../views/usuarios/index.php"); // Redirecciona solo si la consulta fue exitosa
    } else {
        echo "Error al actualizar el producto: " . mysqli_error($conexion);
    }
}

function eliminar_producto(){

    global $conexion;
    extract($_POST);
    $id = $_POST['id'];
    $consulta = "DELETE FROM productos WHERE IdProducto = $id";
    mysqli_query($conexion, $consulta);
    header("Location: ../views/usuarios/");
}

// Consulta a la base de datos para obtener las opciones
$query = "SELECT IdCategoria, NombreCategoria, Descripcion FROM categoria";
$resultado = mysqli_query($conexion, $query);

$opcioness = array();

// Asumiendo que esta es la línea 85 en _functions.php
$resultado = mysqli_query($conexion, $query);

if (!$resultado) {
    // Manejar el error de la consulta
    die("Error en la consulta: " . mysqli_error($conexion));
}

while ($fila = mysqli_fetch_assoc($resultado)) {
    // Tu lógica aquí
}

?>