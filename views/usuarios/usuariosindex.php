
<!DOCTYPE html>
<html lang="en">
<?php require '../../includes/_db.php' ?>
<?php require '../../includes/_header.php' ?>

<body>
  
<div id= "content">
        <section>
        <div class="container mt-5">
<div class="row">
<div class="col-sm-12 mb-3">
<center><h1>Información de sesion actual</h1></center>
</div>
<div class="col-sm-12">
<div class="table-responsive">


<table class="table table-striped table-hover">
<thead>

<tr>
<th>Dni</th>
<th>Nombre</th>
<th>Apellidos</th>
<th>Correo electronico</th>
<th>Usuario</th>
<th>Clave</th>
<th>Cargo</th>


</tr>

</thead>

<tbody>

<?php

$sql = "SELECT  usuario.*, cargo.descripcion AS cargo FROM usuario LEFT JOIN cargo ON usuario.id_cargo = cargo.id ";
$usuarios = mysqli_query($conexion, $sql);
if($usuarios -> num_rows > 0){
foreach($usuarios as $key => $row ){


?>
<tr>
<td><?php echo $row['dni']; ?></td>
<td><?php echo $row['nombres']; ?></td>
<td><?php echo $row['apellidos']; ?></td>
<td><?php echo $row['correo_electronico']; ?></td>
<td><?php echo $row['usuario']; ?></td>
<td><?php echo $row['clave']; ?></td>
<td><?php echo $row['cargo']; ?></td>
</tr>


<?php
}
}else{

    ?>
    <tr class="text-center">
    <td colspan="4">No existe registros</td>
    </tr>

    <?php
}?>
</tbody>

</table>
</div>
</div>
</div>
</div>
        </section>


        <section>
            <div class= "container">
                <div class= "row">
                    <div class= "col-lg-9">
            </div>
        </section>
    </div>
    
    <?php require '../../includes/_footer.php' ?>
    </body>

</html>