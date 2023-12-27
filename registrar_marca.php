<!DOCTYPE html>
<?php
    if(!empty($_POST["registrar"])) {
        $marca = $_POST["marca"];
        $descripcion = $_POST["descripcion"];
        $conn = mysqli_connect("localhost","loli","73993727loli","prueba");
        $sql = "INSERT INTO marca(n_marca, descripcion) VALUES('$marca', '$descripcion')";
        mysqli_query($conn, $sql);
        echo "<script>alert('Marca registrada correctamente')</script>";
    }
?>
<html>
    <head>
        <title>Registro de Marcas</title>
    </head>
    <body>
        <div>
            <form action="" method="POST">
                <label for="">Marca</label>
                <input type="text" name="marca" id="marca">
                <label for="">Descripción:</label>
                <textarea name="descripcion" id="descripcion" cols="50" rows="5"></textarea>
                <input type="submit" name="registrar" value="Registrar" onclick="return validar()">
            </form>
            <button>Regresar al menú principal</button>
        </div>
    </body>
    <script>
        function validar() {
            if(document.getElementById("marca").value == "") {
                alert("En nombre de la marca no debe de estar vacio");
                return false;
            }
        }
    </script>
</html>