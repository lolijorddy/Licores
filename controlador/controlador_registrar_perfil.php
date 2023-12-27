<?php
if (!empty($_POST["registro"])) {
    if (empty($_POST["nombre_perfil"])) {
        echo '<div class ="alerta">Uno de los campos esta vacio</div>';
    } else {
        if (!empty($_POST["registro"])) {
            $nombre_perfil = $_POST["nombre_perfil"];
        
            // Consulta SQL para verificar si el perfil ya existe
            $sql = "SELECT * FROM cargo WHERE descripcion = '$nombre_perfil'";
            $result = mysqli_query($conexion, $sql);
        
            if (mysqli_num_rows($result) > 0) {
                // El perfil ya existe, muestra un mensaje de error
                echo '<div class="alert alert-danger">El perfil ya existe. Por favor, elige otro nombre.</div>';
            } else {
                $nombre_perfil = $_POST["nombre_perfil"];
                $sql = $conexion->query ("INSERT INTO cargo (descripcion) VALUES ('$nombre_perfil')");
                if ($sql==1) {
                    echo '<div class ="success">Usuario registrado correctamente</div>';
                    unset($_SESSION['registro_token']);
        } else {
            echo '<div class ="alerta">Error al registrar usuario</div>';
        }
        
        }
    }
}
    
}
?>