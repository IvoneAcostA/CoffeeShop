<?php
include "conexion.php";

$user_id = null;
$sql1 = "SELECT * FROM productos"; 
$query = $con->query($sql1);
?>

<?php if ($query->num_rows > 0): ?>
    <table class="table table-bordered table-hover">
    <thead>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Marca</th>
        <!--<th>Proveedor</th>-->
        <th>Stock</th>
    </thead>
    <?php while ($r = $query->fetch_array()): ?>
        <tr>
            <td><?php echo $r["nombre"]; ?></td> 
            <td><?php echo $r["precio"]; ?></td>
            <td><?php echo $r["marca"]; ?></td>
            <!--<td><?php /*echo $r["descripcion"]; */?></td>-->
            <td><?php echo $r["stock"]; ?></td>
        </tr>
    <?php endwhile; ?>
    </table>
<?php else: ?>
    <p class="alert alert-warning">No hay resultados</p>
<?php endif; ?>
