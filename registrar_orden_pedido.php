<?php
session_start();
if (empty($_SESSION["id"])) {
	header("location: login");
}
?>
<!DOCTYPE html>
<?php
    $conn = mysqli_connect("localhost","loli","73993727loli","prueba");
    $sql = "SELECT ruc_proveedor, razon_social FROM proveedores ORDER BY razon_social ASC";
    $result = mysqli_query($conn, $sql);
    $sql2 = "SELECT nombre_unidad, id_unidad_medida FROM unidad_medida ORDER BY nombre_unidad ASC";
    $result2 = mysqli_query($conn, $sql2);
    $result3 = mysqli_query($conn, $sql2);
    $sql3 = "SELECT n_marca, id_marca FROM marca ORDER BY n_marca ASC";
    $result4 = mysqli_query($conn, $sql3);
    $result5 = mysqli_query($conn, $sql3);
?>
<html>
<head>
    <title>Registrar orden de pedido</title>
    <style>
        td {
            text-align: center;
        }
        .producto, .cantidad, .precio, .sub, .total, .Uni, .Mar {
            border: none;
            outline: none;
        }
    </style>
</head>
<body>
    <?php
    if (!empty($_POST["registrar"])) {
        $conn = mysqli_connect("localhost", "loli", "73993727loli", "prueba");
        $ruc_proveedor = $_POST['proveedor'];
        $totalPedido = $_POST['total'] ?? 0.00;

        $insertarPedido = "INSERT INTO pedidos (ruc_proveedor, fecha_pedido, total) VALUES ('$ruc_proveedor', NOW(), '$totalPedido')";
        mysqli_query($conn, $insertarPedido);
        $id_pedido = mysqli_insert_id($conn);

        $numFilas = $_POST["numFilas"] ?? 1;
        for ($i = 1; $i <= $numFilas; $i++) {
            $producto = $_POST["producto" . $i] ?? null;
            $marca = $_POST["marca" . $i] ?? 0;
            $unidad = $_POST["uni" . $i] ?? 0;
            $cantidad = $_POST["cant" . $i] ?? 0;
            $precio = $_POST["prec" . $i] ?? 0;
            $subtotal = $_POST["res" . $i] ?? 0;

            $insertarDetalles = "INSERT INTO detalles_pedido (id_pedido, producto, idmarca, idunidad, cantidad, preciouni, subtotal) VALUES ('$id_pedido', '$producto', '$marca', '$unidad', '$cantidad', '$precio', '$subtotal')";
            mysqli_query($conn, $insertarDetalles);
        }

        mysqli_close($conn);
        echo "<script>var registroExitoso = true;</script>";


        // Redirigir después de un breve período de tiempo (por ejemplo, 3 segundos)
    header("Refresh: 0.5; URL=registrar_orden_pedido.php");
    exit();
    }
    
    ?>
    <div>
    <div id="registroExitoso" style="display: none; background-color: #4CAF50; color: white; text-align: center; padding: 10px; margin-top: 10px;">Registro exitoso.</div>
        <form class="cont_Pedido" action="" method="POST">
            <h1>Registrar Orden de Pedido</h1>
            <p>Proveedor:</p>
            <select id="proveedor" name="proveedor">
                <option value="0">Seleciona un proveedor</option>
                <?php
                    $conn = mysqli_connect("localhost", "loli", "73993727loli", "prueba");
                    $sql = "SELECT ruc_proveedor, razon_social FROM proveedores ORDER BY razon_social ASC";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['ruc_proveedor'] . "'>" . $row['razon_social'] . "</option>";
                    }
                ?>
            </select>     
                <h2>Productos</h2>
                <table class="tabla" id="tabla" border="1">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Marca</th>
                            <th>Unidad de Medida</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Sub Total</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th><input class="producto" id="producto1" name="producto1" type="text"></th>
                            <th>
                                <select class="Mar" id="marca1" name="marca1">
                                    <option value="0">Seleccionar marca:</option>
                                    <?php
                                        if($result4) {
                                            while($row = mysqli_fetch_assoc($result4)) {
                                                echo "<option value='" . $row['id_marca'] . "'>" . $row['n_marca'] . "</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </th>
                            <th>
                                <select class="Uni" id="uni1" name="uni1">
                                    <option value="0">Seleccionar unidad:</option>
                                    <?php
                                        if($result2) {
                                            while($row = mysqli_fetch_assoc($result2)) {
                                                echo "<option value='" . $row['id_unidad_medida'] . "'>" . $row['nombre_unidad'] . "</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </th>
                            <td><input class="cantidad" type="number" id="cant1" name="cant1" min="1" value="1" oninput="calcular()"></td>
                            <td><label>S/. </label><input class="precio" type="number" id="prec1" name="prec1" min="0" value="" placeholder="0.00" oninput="calcular()"></td>
                            <td><label>S/. </label><input class="sub" type="number" id="res1" name="res1" value="0.00" readonly></td>
                            <td><a class="primero" style="pointer-events: none;" onclick="eliminarFila(this)" href="#">Eliminar</a></td>
                        </tr>
                        <tr>
                            <th colspan="5">Total:</th>
                            <td><label>S/. </label><input class="total" type="number" id="total" value="0.00" readonly></th>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" name="total" id="hiddenTotal" value="0.00">
                <input type="submit" name="registrar" value="Registrar" onclick="return validacion()">
                
            </form>
            <div>
                <button onclick="agregarFila()">Agregar Producto</button>
            </div>
        </div>
    </body>
        <script>
        function agregarFila() {
            let Tabla = document.querySelector(".tabla");
            let row = Tabla.insertRow(Tabla.rows.length - 1);
            let cell1 = row.insertCell(0);
            let cell2 = row.insertCell(1);
            let cell3 = row.insertCell(2);
            let cell4 = row.insertCell(3);
            let cell5 = row.insertCell(4);
            let cell6 = row.insertCell(5);
            let cell7 = row.insertCell(6);
            cell1.innerHTML = '<input class="producto" id="producto' + (Tabla.rows.length - 2) + '" name="producto' + (Tabla.rows.length - 2) + '" type="text">';
            cell2.innerHTML = '<select class=Mar id=marca' + (Tabla.rows.length - 2) + ' name=marca' + (Tabla.rows.length - 2) + '>' +
                                '<?php
                                    echo "<option value=0>Seleccionar marca:</option>";
                                    if($result5) {
                                        while($row = mysqli_fetch_assoc($result5)) {
                                            echo "<option value=" . $row['id_marca'] . ">" . $row['n_marca'] . "</option>";
                                        }
                                    }
                                    echo "</select>"
                                ?>';
            cell3.innerHTML = '<select class=Uni id=uni' + (Tabla.rows.length - 2) + ' name=uni' + (Tabla.rows.length - 2) + '>' +
                                '<?php
                                    echo "<option value=0>Seleccionar unidad:</option>";
                                    if($result3) {
                                        while($row = mysqli_fetch_assoc($result3)) {
                                            echo "<option value=" . $row['id_unidad_medida'] . ">" . $row['nombre_unidad'] . "</option>";
                                        }
                                    }
                                    echo "</select>"
                                ?>';
            cell4.innerHTML = '<input class="cantidad" id="cant' + (Tabla.rows.length - 2) + '" name="cant' + (Tabla.rows.length - 2) + '" type="number" min="1" value="1" oninput="calcular()">';
            cell5.innerHTML = '<label>S/. </label><input class="precio" id="prec' + (Tabla.rows.length - 2) + '" name="prec' + (Tabla.rows.length - 2) + '" type="number" min="0" value="" placeholder="0.00" oninput="calcular()">';
            cell6.innerHTML = '<label>S/. </label><input class="sub" type="number" id="res' + (Tabla.rows.length - 2) + '" name="res' + (Tabla.rows.length - 2) + '" value="0.00" readonly>';
            cell7.innerHTML = '<a onclick="eliminarFila(this)" href="#">Eliminar</a>';
            
            document.querySelector(".primero").removeAttribute("style");
        }

        function calcular() {
    var Tabla = document.querySelector(".tabla");
    var resultado = 0;
    for(var i = 1; i <= Tabla.rows.length - 2; i++) {
        try { 
            var a = parseFloat(document.getElementById("cant" + i).value) || 0;
            var b = parseFloat(document.getElementById("prec" + i).value) || 0;
            var calcu = a * b;
            document.getElementById("res" + i).value = calcu.toFixed(2);
            resultado += calcu;
        }
        catch(e) {
            alert(e.toString());
        }   
    }
    document.getElementById("total").value = resultado.toFixed(2);
    document.getElementById("hiddenTotal").value = resultado.toFixed(2);
}


        function eliminarFila(r) { 
            var i = r.parentNode.parentNode.rowIndex;
            document.getElementById("tabla").deleteRow(i);
            var TablaEl = document.querySelector(".tabla");
            for(var j = i; j <= TablaEl.rows.length - 2; j++) {
                document.getElementById("producto" + (j + 1)).setAttribute("id", ("producto" + j));
                document.getElementById("marca" + (j + 1)).setAttribute("id", ("marca" + j));
                document.getElementById("uni" + (j + 1)).setAttribute("id", ("uni" + j));
                document.getElementById("cant" + (j + 1)).setAttribute("id", ("cant" + j));
                document.getElementById("prec" + (j + 1)).setAttribute("id", ("prec" + j));
                document.getElementById("res" + (j + 1)).setAttribute("id", ("res" + j));

                document.getElementById("producto" + j).setAttribute("name", ("producto" + j));
                document.getElementById("marca" + j).setAttribute("name", ("marca" + j));
                document.getElementById("uni" + j).setAttribute("name", ("uni" + j));
                document.getElementById("cant" + j).setAttribute("name", ("cant" + j));
                document.getElementById("prec" + j).setAttribute("name", ("prec" + j));
                document.getElementById("res" + j).setAttribute("name", ("res" + j));
            }
            calcular();
            if((TablaEl.rows.length - 2) == 1) {
                document.querySelector("a").setAttribute("style", "pointer-events: none;");
                document.querySelector("a").setAttribute("class", "primero");
            }
        }

        function prueba() {
            var filas = document.querySelector(".tabla").rows.length - 2;
            var elemento = document.createElement("input");
            var padre = document.querySelector(".tabla");

            
            elemento.setAttribute("type", "hidden");
            elemento.setAttribute("name", "numFilas");
            elemento.setAttribute("value", filas);

            padre.appendChild(elemento);
        }

        
        function validacion() {
            prueba();
            if(document.getElementById("proveedor").value == 0) {
                alert("Debe de elegir un proveedor"); 
                return false;
            }

            var tabla = document.querySelector(".tabla");
            for(var i = 1; i <= (tabla.rows.length - 2); i++) {
                if(document.getElementById("producto" + i).value == "" ||
                document.getElementById("marca" + i).value == 0 ||
                document.getElementById("uni" + i).value == 0 ||
                document.getElementById("cant" + i).value <= 0 ||
                document.getElementById("prec" + i).value <= 0) {
                    alert("Existen campos vacios");
                    return false;
                }
            }
        }
        
        // Verifica si se debe mostrar el mensaje de registro exitoso
if (typeof registroExitoso !== 'undefined' && registroExitoso === true) {
    // Muestra el mensaje de registro exitoso
    var mensajeRegistroExitoso = document.getElementById("registroExitoso");
    mensajeRegistroExitoso.style.display = "block";

    // Oculta el mensaje después de unos segundos (puedes ajustar el tiempo)
    setTimeout(function () {
        mensajeRegistroExitoso.style.display = "none";
    }, 5000);
    
    // Oculta el mensaje después de 5 segundos (puedes ajustar este valor)
}

    </script>
    
</html>