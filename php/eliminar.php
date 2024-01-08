<?php

if (!empty($_GET)) {
    if (isset($_GET["id"])) {
        if ($_GET["id"] != "") {
            include "conexion.php";

            // Modificamos la consulta SQL para eliminar el producto de la tabla "productos"
            $sql = "DELETE FROM productos WHERE id = $_GET[id]";
            $query = $con->query($sql);
            if ($query != null) {
                print "<script>alert(\"Eliminado exitosamente.\");window.location='../ver.php';</script>";
            } else {
                print "<script>alert(\"No se pudo eliminar.\");window.location='../ver.php';</script>";
            }
        }
    }
}
?>
