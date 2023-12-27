<?php
session_start();
if (empty($_SESSION["id"])) {
	header("location: login");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Registro de Perfil</title>
    <link rel="icon" type="image/x-icon" href="/login/img/favicon.ico">
    <style>
        body {
    background-image: url('img/barcelona.jpg');
    background-size: cover; /* Ajusta el tamaño de la imagen al tamaño de la ventana del navegador */
    background-repeat: no-repeat; /* Evita la repetición de la imagen de fondo */
    background-attachment: fixed; /* Fija la imagen de fondo para que no se desplace con el contenido */
}
    </style>
</head>
<body>

    <div class="container">
        <form action="" method="POST" class="formulario" id="registroForm">
            <h2 class="titulo">REGISTRAR PERFIL</h2>
            <?php
            include ("modelo/conexion.php");
            include ("controlador/controlador_registrar_perfil.php");
            ?>
            <div class="padre">
                <div class="nombre">
                    <label for="">Nombre del Perfil</label>
                    <input type="text" name="nombre_perfil">
                </div>
                <div class="cuenta">
                    <input type="hidden" name="registro_token" value="<?php echo $token; ?>">
                    <input class="boton" type="submit" value="Resgitrar" name="registro">
                    <a href="inicio">Regresar al inicio</a> 
                </div>
            </div>


        </form>

    </div>
    <script src="js/registro.js"></script>
</body>