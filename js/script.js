
 // Definición de la función cargarFormularioRegistroUsuario
    function cargarFormularioRegistroUsuario(token) {
        // Realiza una solicitud AJAX para cargar el formulario de registro
        $.ajax({
            url: 'registreo_usuario.php',
            method: 'GET',
            data: { token: token },
            success: function(response) {
                // Muestra el formulario en un contenedor en la página actual
                $('#formularioRegistroUsuario').html(response);
            },
            error: function() {
                alert('Error al cargar el formulario de registro.');
            }
        });
    }

    // Asigna el evento onclick a un elemento (por ejemplo, un botón o enlace)
    // para llamar a la función cargarFormularioRegistroUsuario
    $('#miBoton').on('click', function() {
        var token = obtenerToken(); // Asegúrate de obtener el token adecuadamente
        cargarFormularioRegistroUsuario(token);
    });

