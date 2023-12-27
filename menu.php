<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú desplegable</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/pushbar.min.css">
    <script src="https://kit.fontawesome.com/03a89292db.js" crossorigin="anonymous"></script>
</head>

<body>

    <header class="encabezado">
        <div class="div__logo">
            <img class="logo" src="img/logo.png" alt="">
        </div>
        <nav class="menu__nav" id="menu__nav">            
            <ul class="menu__ul">
                <li><a href="#"><i class="fas fa-house-user"></i>&nbsp;&nbsp;Inicio</a></li>
                <li><a href="#"><i class="fas fa-taxi"></i>&nbsp;&nbsp;Servicio</a></li>
                <li><a href="#"><i class="fas fa-phone-volume"></i>&nbsp;&nbsp;Contactos</a></li>
                <li><a href="#"><i class="fas fa-location-arrow"></i>&nbsp;&nbsp;Ubicanos</a></li>
            </ul>
        </nav>
        <div  data-pushbar-target="contenido" class="icono"><i class="fas fa-bars"></i></div>
    </header>

    <main>
        <p> </p>
    </main>



    <div id="contenido" data-pushbar-id="contenido" data-pushbar-direction="left">
        <div class="cerrar"><button id="cerrar" data-pushbar-close>X</button></div>
    </div>

    <script src="js/main3.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pushbar.js@1.0.0/src/pushbar.min.js"></script>
    <script type="text/javascript">
        const pushbar = new Pushbar({
            blur: true,
            overlay: true,
        });
    </script>
</body>

</html>