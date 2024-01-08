<?php

if (!empty($_POST)) {
    if (isset($_POST["nombre"]) && isset($_POST["precio"]) && isset($_POST["marca"]) && isset($_POST["descripcion"]) && isset($_POST["stock"])) {
        if ($_POST["nombre"] != "" && $_POST["precio"] != "" && $_POST["marca"] != "") {
            include "conexion.php";

            // Modificamos la consulta SQL para insertar los datos sin la columna "created_at"
            $sql = "INSERT INTO productos (nombre, precio, marca, descripcion, stock) VALUES ('$_POST[nombre]', '$_POST[precio]', '$_POST[marca]', '$_POST[descripcion]', '$_POST[stock]')";
            $query = $con->query($sql);
            if ($query != null) {
                print "<script>alert(\"Agregado exitosamente.\");window.location='../ver.php';</script>";
            } else {
                print "<script>alert(\"No se pudo agregar.\");window.location='../ver.php';</script>";
            }
        }
    }
}
?>

