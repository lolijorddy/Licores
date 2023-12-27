<?php
session_start();
if (empty($_SESSION["id"])) {
	header("location: login");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Inicio</title>
	<link rel="stylesheet" href="css/estilo.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	<script src="js/script.js"></script>
	<title>Registro de Usuario</title>
	<link rel="icon" type="image/x-icon" href="/login/img/favicon.ico">
	<style>
        /* Tu estilo CSS aquí */
        .jumbotron h1.display-4 {
            color: orangered; /* O el color que desees */
        }
		.carousel-caption h5 {
            color: orange; /* Cambia el color a tu elección */
        }
		.mission-heading {
            color: orange;
			font-size: 24px; /* Cambia el color a tu elección */
        }

        .vision-heading {
            color: orange;
			font-size: 24px; /* Cambia el color a tu elección */
        }
    </style>
	<!-- Agrega aquí el código JavaScript -->
    <script>
document.addEventListener('DOMContentLoaded', function () {
    // Verificar si existen datos en localStorage
    if (localStorage.getItem('nombre')) {
        // Recupera los valores del localStorage
        var nombre = localStorage.getItem('nombre');
        var apellido = localStorage.getItem('apellido');

        // Completa los campos del formulario
        var nombreInput = document.querySelector('input[name="nombre"]');
        var apellidoInput = document.querySelector('input[name="apellido"]');
        
        // Verificar si los campos no están vacíos antes de completarlos
        if (nombre && nombre.trim() !== '') {
            nombreInput.value = nombre;
        }

        if (apellido && apellido.trim() !== '') {
            apellidoInput.value = apellido;
        }
    }
});
</script>

</head>
<body>
	<div id="contenidoOculto">
	<div class="bd-example mb-0" style="height: 80vh">
		<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
				<li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
				<li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
			</ol>
			<div class="carousel-inner">
				<div class="carousel-item active" style="height: 80vh">
					<img src="img/licorerias.jpg" class="d-block w-100" alt="...">
					<div class="carousel-caption d-none d-md-block">
						<h5 class="display-4 mb-4 font-weight-bold">BARCELONA</h5>
						<p></p>
					</div>
				</div>
				<div class="carousel-item" style="height: 80vh">
					<img src="img/licores.jpeg" class="d-block w-100" alt="...">
					<div class="carousel-caption d-none d-md-block">
						<h5 class="display-4 mb-4 font-weight-bold">BARCELONA</h5>
						<p></p>
					</div>
				</div>
				<div class="carousel-item" style="height: 80vh">
					<img src="img/pal.jpg" class="d-block w-100" alt="...">
					<div class="carousel-caption d-none d-md-block">
						<h5 class="display-4 mb-4 font-weight-bold">BARCELONA</h5>
						<p></p>
					</div>
				</div>
			</div>
			<a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>
	</div>
	<nav class="navbar navbar-dark bg-dark  navbar-expand-md navbar-light bg-light fixed-top">
		<div class="text-white bg-success p-2">
			<?php
			echo $_SESSION["nombre"]." ".$_SESSION["apellido"];
			?>
		</div>
		<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
			<div class="navbar-nav mr-auto">
				<div class="offset-md-1 mr-auto text-center"></div>
				<a class="nav-item nav-link text-justify active ml-3 hover-primary" href="inicio">Inicio</a>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle text-justify ml-3" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Seguridad
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
					<a class="dropdown-item" href="registreo_usuario">Registrar Usuario</a>
						<a class="dropdown-item" href="registrar_perfil">Registrar Perfil</a>
						<a class="dropdown-item" href="visualiza_perfiles">Visualizar Perfiles</a>
						<a class="dropdown-item" href="visualiza_usuarios">Visualizar Usuarios</a>
						<a class="dropdown-item" href="servicios.html">Otros</a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle text-justify ml-3" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Compras
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
					<a class="dropdown-item" href="registrar_proveedor.php">Registrar proveedor</a>
						<a class="dropdown-item" href="servicios.html">Otros</a>
					</div>
				</li>
				<li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle text-justify ml-3" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Almacen
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						<a class="dropdown-item" href="views/usuarios/index.php">Productos</a>
						<a class="dropdown-item" href="views/usuarios/categorias.php">Categoria</a>
						<a class="dropdown-item" href="views/usuarios/unidad_medida.php">Unidad de medida</a>
						<a class="dropdown-item" href="registrar_orden_pedido.php">Registrar orden de pedido</a>
						<a class="dropdown-item" href="registrar_marca.php">Registrar marca</a>
						
					</div>
				</li>
				<li>
    <a class="nav-item nav-link text-justify ml-3 hover-primary" href="controlador/controlador_cerrar_sesion">Salir</a>
</li>

			</div>
			<div class="text-center justify-content-center">
				<a class="btn btn-outline-primary" target="_blank" href="https://www.facebook.com/licoresbarcelona">Facebook</a>
				<a class="btn btn-outline-danger" target="_blank" href="https://www.youtube.com">Youtube</a>
			</div>
		</div>
	</nav>
		<div id="formularioRegistroUsuario">
			<!-- El contenido del formulario se cargará aquí dinámicamente -->
		</div>
	<div id="contenido">
	<div class="">
	<div class="jumbotron bg-dark text-light rounded-0">
        <h1 class="display-4">Bienvenidos a Licoreria "Barcelona"</h1>
        <p class="lead mission-heading">Misión:</p>
        <p class="lead">Brindar a los clientes una experiencia única y satisfactoria al ofrecerles una gran
            variedad de productos y marcas de bebidas alcohólicas, piqueos, hielo y agua, con la
            mejor calidad, precio y servicio del mercado. </p>
        <hr class="my-4 bg-light">
        <p class="lead vision-heading">Visión:</p>
        <p class="lead">Ser la licorería líder en la ciudad de Tarapoto y en la región San Martín, reconocida
            por su excelencia, innovación y responsabilidad social. </p>
        <div class="d-flex justify-content-between align-items-center flex-wrap">
        </div>
    </div>
	</div>
	</div>
</body>
</html>
    
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</script>
</body>
</html>