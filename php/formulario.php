<?php
include "conexion.php";

$product_id = null;
if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM productos WHERE id = $id";
    $query = $con->query($sql);
    $producto = null;

    if ($query->num_rows > 0) {
        $producto = $query->fetch_object();
    }
}
?>

<?php if ($producto != null): ?>
    <form role="form" method="post" action="php/actualizar_producto.php">
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" value="<?php echo $producto->nombre; ?>" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="price">Precio</label>
            <input type="text" class="form-control" value="<?php echo $producto->precio; ?>" name="precio" required>
        </div>
        <div class="form-group">
            <label for="brand">Marca</label>
            <input type="text" class="form-control" value="<?php echo $producto->marca; ?>" name="marca" required>
        </div>
        <div class="form-group">
            <label for="tion">Proveedor</label>
            <textarea class="form-control" name="descripcion" required><?php echo $producto->descripcion; ?></textarea>
        </div>
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="text" class="form-control" value="<?php echo $producto->stock; ?>" name="stock" required>
        </div>
        <input type="hidden" name="id" value="<?php echo $producto->id; ?>">
        <button type="submit" class="btn btn-default">Actualizar</button>
    </form>
<?php else: ?>
    <p class="alert alert-danger">404 No se encuentra</p>
<?php endif; ?>
