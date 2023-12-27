<?php
// Verifica si el usuario tiene privilegios de "superusuario"
if (isset($_SESSION["superuser"]) && $_SESSION["superuser"] === true) {
    // El usuario tiene privilegios de "superusuario", realiza acciones privilegiadas aquí
} else {
    // El usuario no tiene privilegios de "superusuario", muestra un mensaje de acceso denegado o realiza otra acción
    echo "Acceso denegado";
}
?>