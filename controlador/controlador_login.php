<?php
session_start();
if (!empty($_POST["btningresar"])) {
    if (!empty($_POST["usuario"]) && !empty($_POST["password"])) {
        $usuario = $_POST["usuario"];
        $password = md5($_POST["password"]); // No se debe usar MD5 para almacenar contraseñas, es una técnica obsoleta y no segura.

        // Verificar si las credenciales coinciden con el superusuario "admin" y la contraseña deseada
        if ($usuario === "admin" && $password === md5("dd9c7576bcfa961baa6788c2a431afb7")) {
            // Las credenciales coinciden con el superusuario
            // Puedes definir aquí qué hacer específicamente para el superusuario
            header("Location: inicio");
        } else {
            // Las credenciales no coinciden con el superusuario, proceder con la verificación de usuarios normales
            // Consulta SQL para verificar las credenciales de usuarios normales
            $sql_usuario_normal = $conexion->query("SELECT * FROM usuario WHERE usuario = '$usuario' AND clave = '$password'");

            if ($sql_usuario_normal->num_rows > 0) {
                // Las credenciales coinciden con un usuario normal
                $datos = $sql_usuario_normal->fetch_object();
                $_SESSION["id"] = $datos->id;
                $_SESSION["nombre"] = $datos->nombres;
                $_SESSION["apellido"] = $datos->apellidos;
                
                if ($datos->id_cargo == 1) {
                    // Usuario con cargo 1 (por ejemplo, administrador)
                    header("Location: inicio");
                } elseif ($datos->id_cargo == 2) {
                    // Usuario con cargo 2 (por ejemplo, cajero)
                    header("Location: views/usuarios/index.php");
                }
            } else {
                // Ninguna de las consultas arrojó resultados, las credenciales no son válidas
                echo "<div class='alert alert-danger'>Acceso denegado</div>";
            }
        }
    } else {
        echo "Campos vacíos";
    }
}

?>