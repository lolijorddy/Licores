<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <link rel="stylesheet" href="css/bootstrap.css">
   <link rel="stylesheet" type="text/css" href="css/style.css">
   <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
   <!-- <link rel="stylesheet" href="css/all.min.css"> -->
   <!-- <link rel="stylesheet" href="css/fontawesome.min.css"> -->
   <title>Inicio de sesión</title>
   <link rel="icon" type="image/x-icon" href="/login/img/favicon.ico">
   <style>
      /* Estilo para el contenedor principal */
.container {
    display: flex;
    justify-content: flex-end; /* Alinea el contenido a la derecha */
    align-items: center; /* Centra verticalmente */
    height: 100vh; /* Establece la altura del contenedor al 100% del viewport */
}
      /* Estilo para el formulario */
.login-content {
   background-color: rgba(255, 255, 255, 0.8); /* Fondo blanco semi-transparente */
    padding: 50px;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    height: 550px; /* Ajusta el alto vertical */
    width: 450px; /* Ajusta el ancho horizontal */
}

/* Estilo para los campos de entrada y etiquetas */
.input-div {
    background-color: #f2f2f2; /* Fondo gris claro */
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
}

.input-div h5 {
    margin: 0;
    color: #333; /* Color de texto negro */
}

.input {
    width: 100%;
    padding: 5px;
    margin: 5px 0;
    border: 1px solid #ccc;
    border-radius: 3px;
}

/* Estilo para el enlace "Olvidé mi contraseña" */
.font-italic.isai5 {
    color: #333; /* Color de texto negro */
}

/* Estilo para el botón de inicio de sesión */
.btn {
    background-color: #007bff; /* Fondo azul */
    color: #fff; /* Color de texto blanco */
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}
   </style>
</head>

<body>
   <img class="wave" src="img/barcelona.jpg"></img>
   <div class="container">
      <div class="img">
         <img src="">
      </div>
      <div class="login-content">
         <form method="post" action="">
            <img src="img/avatar.svg">
            <h2 class="title">BIENVENIDO</h2>
            <?php
            include "modelo/conexion.php";
            include "controlador/controlador_login.php";
            
            ?>
            <div class="input-div one">
               <div class="i">
                  <i class="fas fa-user"></i>
               </div>
               <div class="div">
                  <h5>Usuario</h5>
                  <input id="usuario" type="text" class="input" name="usuario">
               </div>
            </div>
            <div class="input-div pass">
               <div class="i">
                  <i class="fas fa-lock"></i>
               </div>
               <div class="div">
                  <h5>Contraseña</h5>
                  <input type="password" id="input" class="input" name="password">
               </div>
            </div>
            <div class="view">
               <div class="fas fa-eye verPassword" onclick="vista()" id="verPassword"></div>
            </div>

            <div class="text-center"> 
               <a class="font-italic isai5" href="">Olvidé mi contraseña</a>
            </div>
            <input name="btningresar" class="btn" type="submit" value="INICIAR SESION">
         </form>
      </div>
   </div>
   <script src="js/fontawesome.js"></script>
   <script src="js/main.js"></script>
   <script src="js/main2.js"></script>
   <script src="js/jquery.min.js"></script>
   <script src="js/bootstrap.js"></script>
   <script src="js/bootstrap.bundle.js"></script>

</body>

</html>