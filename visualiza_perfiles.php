<?php
session_start();
if (empty($_SESSION["id"])) {
	header("location: login");
}
?>
<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">
<head>
    <title>Lista de Usuarios</title>
    <link rel="icon" type="image/x-icon" href="/login/img/favicon.ico">

    <!--JQUERY-->
    <script
        src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- FRAMEWORK BOOTSTRAP para el estilo de la pagina-->
    <link rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script
        src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script 
        src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script 
        src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <!-- Los iconos tipo Solid de Fontawesome-->
    <link rel="stylesheet"
        href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
    <script src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>

    <!-- Nuestro css-->
    <link rel="stylesheet" type="text/css" href="css/user-form.css"
        th:href="@{/css/user-form.css}">
    <!-- DATA TABLE -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">   
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

    <script type="text/javascript">
    </script>
    <style>
        body {
    background-image: url('img/barcelona.jpg');
    background-size: cover; /* Ajusta el tamaño de la imagen al tamaño de la ventana del navegador */
    background-repeat: no-repeat; /* Evita la repetición de la imagen de fondo */
    background-attachment: fixed; /* Fija la imagen de fondo para que no se desplace con el contenido */
}
    /* Estilos para hacer la tabla más grande */
#userList {
    width: 500%; /* Ancho de la tabla al 100% del contenedor */
    font-size: 16px; /* Tamaño de fuente */
}

#userList th,
#userList td {
    padding: 10px; /* Espacio interno de celda */
}

/* Estilos para el encabezado de la tabla */
#userList th {
    background-color: #f2f2f2; /* Color de fondo del encabezado */
    font-weight: bold; /* Texto en negrita */
    text-align: center; /* Alineación del texto en el centro */
}

/* Estilos para las filas impares de la tabla */
#userList tbody tr:nth-child(odd) {
    background-color: #f9f9f9; /* Color de fondo de filas impares */
}

/* Estilos para las filas pares de la tabla */
#userList tbody tr:nth-child(even) {
    background-color: #ffffff; /* Color de fondo de filas pares */
}

/* Estilos para los enlaces de acciones */
.action-buttons a {
    margin-right: 5px; /* Margen derecho entre los enlaces */
    color: #007bff; /* Color de enlace */
}

.action-buttons a:hover {
    text-decoration: none; /* Eliminar subrayado en el hover */
}

</style>
</head>
<body>
    <div class="container">
    <div class="mx-auto col-sm-8 main-section" id="myTab" role="tablist">
        <ul class="nav nav-tabs justify-content-end">
            
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="list" role="tabpanel" aria-labelledby="list-tab">
                <div class="card">
                    <div class="card-header">
                        <h4>Lista de Perfiles</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="userList" class="table table-bordered table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Perfil</th>
                                        <th scope="col">Acciones</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Conexión a la base de datos (ajusta los detalles de la conexión)
                                    $conn = mysqli_connect("localhost", "loli", "73993727loli", "prueba");

                                    // Verificar la conexión
                                    if (!$conn) {
                                        die("Error en la conexión: " . mysqli_connect_error());
                                    }

                                    // Consulta SQL para obtener datos de la tabla de usuarios (ajusta la consulta según tu esquema)
                                    $sql = "SELECT * FROM prueba.cargo;";

                                    // Ejecutar la consulta
                                    $result = mysqli_query($conn, $sql);

                                    // Verificar si hay filas de datos
                                    if ($result) { // Verificar que la consulta se haya ejecutado correctamente
                                        $numeroCorrelativo = 1;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<th scope='row'>" . $numeroCorrelativo . "</th>";
                                            echo "<td>" . $row['descripcion'] . "</td>";       
                                            echo "<td class='action-buttons'>
                                                    <a href='editar_perfiles?id=" . $row['id'] . "'><i class='fas fa-edit'></i></a> |
                                                    <a href='borrar_perfiles?id=" . $row['id'] . "' onclick=\"return confirm('¿Estás seguro de que deseas borrar este usuario?');\"><i class='fas fa-user-times'></i></a>
                                                  </td>";
                                            echo "</tr>";
                                            $numeroCorrelativo++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='7'>Error en la consulta: " . mysqli_error($conn) . "</td></tr>";
                                    }
                                    
                                    // Cerrar la conexión
                                    mysqli_close($conn);
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <a href="inicio">Regresar al inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
