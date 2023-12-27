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
    <title>Registro de Usuario</title>
    <link rel="icon" type="image/x-icon" href="/login/img/favicon.ico">
    <script src="js/registro.js"></script>
    <script src="ruta/a/select2.min.js"></script>
    <script>
        function validarContraseña() {
            var contraseña = document.getElementById("input").value;
            var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;

            if (!regex.test(contraseña)) {
                alert("La contraseña debe tener entre 6 y 20 caracteres, incluir al menos un número, una letra mayúscula y una letra minúscula.");
                return false;
            }
            return true;
        }
    </script>
    <script>
    $(document).ready(function() {
        $('#miCuadroDeSeleccion').select2();
    });
</script>
    <style>
        body {
    background-image: url('img/barcelona.jpg');
    background-size: cover; /* Ajusta el tamaño de la imagen al tamaño de la ventana del navegador */
    background-repeat: no-repeat; /* Evita la repetición de la imagen de fondo */
    background-attachment: fixed; /* Fija la imagen de fondo para que no se desplace con el contenido */
}
.formulario {
    max-width: 400px; /* Cambia el ancho máximo según tus preferencias */
    margin: 0 auto; /* Centra el formulario horizontalmente en el contenedor */
}

/* Estilo para los elementos del formulario */
.formulario input[type="text"],
.formulario input[type="password"],
.formulario input[type="submit"],
.formulario a {
    width: 100%; /* Establece el ancho al 100% para que se ajusten al ancho del formulario */
    margin-bottom: 10px; /* Agrega un espacio entre los elementos */
}

/* Ajusta el tamaño del botón de registro */
.formulario input[type="submit"] {
    padding: 10px; /* Ajusta el tamaño del botón según tus preferencias */
}

/* Estilo para el enlace de regreso */
.formulario a {
    display: block; /* Hace que el enlace sea un bloque para ocupar todo el ancho disponible */
    text-align: center; /* Centra el texto del enlace */
}
.container {
    max-width: 400px; /* Ancho máximo del contenedor */
    margin: 0 auto; /* Centrar el contenedor horizontalmente */
    background-color: rgba(255, 255, 255, 0.8); /* Fondo blanco semi-transparente */
    padding: 20px; /* Espacio interno alrededor del formulario */
    border-radius: 10px; /* Bordes redondeados para el contenedor */
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2); /* Sombra ligera para el contenedor */
}
.container .titulo{
color: #000;
text-align: center;
margin-bottom: 20px;

}
.formulario .padre > div {
        margin-bottom: -30px; /* Ajusta el margen inferior según tus necesidades */
    }
.formulario label {
        font-weight: bold; /* Hace que los <label> estén en negrita */
        color: #000000; /* Cambia el color de las letras a rojo (#FF0000) */
    }
    .formulario .div h5 {
    font-weight: bold; /* Hace que el texto esté en negrita */
    color: #000000; /* Cambia el color del texto a negro (#000000) */
}
.formulario .fa-lock,
.formulario .fa-eye {
    color: #000000; /* Cambia el color de los íconos a negro (#000000) */
}
/* Estilo para el cuadro de selección */
.formulario select {
    appearance: none; /* Elimina la apariencia nativa del cuadro de selección */
    padding: 10px; /* Ajusta el espaciado interior */
    border: 1px solid #ccc; /* Agrega un borde */
    border-radius: 5px; /* Agrega bordes redondeados */
    background-color: #fff; /* Cambia el color de fondo */
    color: #000; /* Cambia el color del texto */
    width: 100%; /* Ajusta el ancho al 100% del contenedor */
}

/* Estilo para el cuadro de selección cuando está en foco (focus) */
.formulario select:focus {
    outline: none; /* Elimina el resaltado en el enfoque */
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2); /* Agrega una sombra suave en el enfoque */
}
/* Estilo para el título del perfil */
.perfil-titulo {
    display: flex;
    align-items: center; /* Alinea verticalmente con otros campos */
    margin-bottom: 10px; /* Espacio entre el título y el cuadro de selección */
}

.label-titulo {
    font-weight: bold; /* Texto en negrita */
    margin-right: 10px; /* Espacio a la derecha del título */
}
/* Estilo para el título general "REGISTRAR USUARIO" con alineación a la izquierda */
.titulo {
    font-weight: bold; /* Texto en negrita */
    text-align: left; /* Alineación horizontal a la izquierda */
    margin-bottom: 20px; /* Espacio inferior */
    white-space: nowrap; /* Evita el salto de línea */
    margin-left: -10px; /* Ajusta el margen izquierdo según sea necesario */
}
.select-arrow {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    font-size: 16px;
    color: #555; /* Color del ícono */
    transition: transform 0.2s ease-in-out; /* Transición suave */
}

    </style>
</head>
<body>

    <div class="container">
        <form action="" method="POST" class="formulario" id="registroForm">
            <h2 class="titulo">REGISTRAR USUARIO</h2>
            <?php
            include ("modelo/conexion.php");
            include ("controlador/controlador_registrar_usuario.php");
            include ("controlador/controlador_perfil.php");
            ?>
            <div class="padre">
            <div class="perfil-titulo">
                    <label for="miCuadroDeSeleccion" class="label-titulo">Perfil:</label>
                        <select id="miCuadroDeSeleccion" class="select-titulo">
                            <option value="">Seleccionar</option>
                            <?php foreach ($opciones     as $id => $nombre) { ?>
                                <option value="<?php echo $id; ?>"><?php echo $nombre; ?></option>
                            <?php } ?>
                        </select>   
                        <!-- Aquí se agrega el ícono de flecha hacia abajo de Font Awesome -->
                        <i class="fas fa-chevron-down select-arrow"></i>
                    
                </div>
                <div class="dni">
                    <label for="">Dni</label>
                    <input type="text" name="dni">
                </div>
                <div class="nombre">
                    <label for="">Nombres</label>
                    <input type="text" name="nombre">
                </div>
                <div class="apellido">
                    <label for="">Apellidos</label>
                    <input type="text" name="apellido">
                </div>
                <div class="correo_electronico">
                    <label for="">Correo Electronico</label>
                    <input type="text" name="correo_electronico">
                </div>
                <div class="usuario">
                    <label for="">Usuario</label>
                    <input type="text" name="usuario">
                </div>
                <div class="input-div pass">
                <div class="i">
                    <i class="fas fa-lock"></i>
                </div>
                <div class="div">
                    <h5>Contraseña</h5>
                    <input type="password" id="input" class="input" name="clave" required>
                </div>
                <div class="view">
                <div class="fas fa-eye" onclick="togglePasswordVisibility()" id="verPassword"></div>
                </div>
                </div>
                <div class="cuenta">
                    <input type="hidden" name="registro_token" value="<?php echo $token; ?>">
                    <input class="boton" type="submit" value="Resgistrar" name="registro" name="registro" onclick="return validarContraseña()">
                    <a href="inicio">Regresar al inicio</a> 
                </div>
            </div>


        </form>

    </div>
    <script>
        // JavaScript para controlar la animación de la flecha
        const selectTitulo = document.getElementById("miCuadroDeSeleccion");

        selectTitulo.addEventListener("change", () => {
            const selectArrow = selectTitulo.nextElementSibling.querySelector(".select-arrow");
            selectArrow.style.transform = "translateY(-50%) rotate(0deg)";
        });
    </script>
</body>
</html>

