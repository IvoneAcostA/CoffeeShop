<?php

include "conexion.php";

$user_id=null;
$sql1 = "SELECT * FROM productos"; // Cambiamos el nombre de la tabla a "productos"
$query = $con->query($sql1);
?>

<?php if($query->num_rows > 0): ?>
    <table class="table table-bordered table-hover">
    <thead>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Marca</th>
        <!--<th>Proveedor</th>-->
        <th>Stock</th>
        <th></th>
    </thead>
    <?php while ($r = $query->fetch_array()): ?>
        <tr>
            <td><?php echo $r["nombre"]; ?></td> 
            <td><?php echo $r["precio"]; ?></td>
            <td><?php echo $r["marca"]; ?></td>
            <!--<td><?php /*echo $r["descripcion"]; */?></td>-->
            <td><?php echo $r["stock"]; ?></td>
            <td style="width:150px;">

                <a href="/CoffeeShop/editar.php?id=<?php echo $r["id"];?>" class="btn btn-sm btn-warning">Editar</a>

                <a href="#" id="del-<?php echo $r["id"];?>" class="btn btn-sm btn-danger">Eliminar</a>
                <script>
                $("#del-<?php echo $r["id"];?>").click(function(e){
                    e.preventDefault();
                    p = confirm("Estás seguro?");
                    if(p){
                        window.location="./php/eliminar.php?id="+<?php echo $r["id"];?>;
                    }
                });
                </script>
            </td>
        </tr>
    <?php endwhile; ?>
    </table>
<?php else: ?>
    <p class="alert alert-warning">No hay resultados</p>
<?php endif; ?>
