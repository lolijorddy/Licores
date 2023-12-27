<?php
if (!empty($_POST["registro"])) {
    if (empty($_POST["dni"]) || empty($_POST["nombre"]) || empty($_POST["apellido"]) || empty($_POST["correo_electronico"])|| empty($_POST["usuario"]) || empty($_POST["clave"]) || empty($_POST["perfil"])) {
        echo '<div class ="alerta">Uno de los campos está vacío</div>';
    } else {
// Obtén el número de DNI enviado desde el formulario
$dni = $_POST["dni"];

// Conecta a la base de datos (ajusta los detalles de la conexión)
$conn = mysqli_connect("localhost", "loli", "73993727loli", "prueba");

// Verifica la conexión
if (!$conn) {
    die("Error en la conexión: " . mysqli_connect_error());
}

// Consulta SQL para verificar si el DNI ya existe
$sql = "SELECT dni FROM usuario WHERE dni = '$dni'";

// Ejecuta la consulta
$result = mysqli_query($conn, $sql);

// Verifica si se encontraron resultados (si el DNI ya existe)
if (mysqli_num_rows($result) > 0) {
    echo "El número de DNI ya está registrado. Por favor, elija otro.";
} else {
    // El número de DNI es único, puedes proceder con el registro
    // (agregar el registro a la base de datos, etc.)
    // ... tu código para agregar el registro ...
    
            $dni = $_POST["dni"];
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $correo_electronico = $_POST["correo_electronico"];
            $usuario = $_POST["usuario"];
            $clave = md5($_POST["clave"]);
            $perfil_id = $_POST["perfil"];
    
            // Construir la consulta SQL
            $sql = "INSERT INTO usuario (dni, nombres, apellidos,correo_electronico, usuario, clave, id_cargo) VALUES ('$dni', '$nombre', '$apellido','$correo_electronico', '$usuario', '$clave', '$perfil_id')";
    
            // Ejecutar la consulta SQL
            if ($conexion->query($sql) === TRUE) {
                echo '<div class="success">Usuario registrado correctamente</div>';
            } else {
                echo '<div class="alerta">Error al registrar usuario: ' . $conexion->error . '</div>';
            }
        }
    }
}




?>