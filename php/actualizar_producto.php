<?php
if (!empty($_POST)) {
    if (isset($_POST["nombre"]) && isset($_POST["precio"]) && isset($_POST["marca"]) && isset($_POST["descripcion"]) && isset($_POST["stock"]) && isset($_POST["id"])) {
        if ($_POST["nombre"] != "" && $_POST["precio"] != "" && $_POST["marca"] != "" && $_POST["id"] != "") {
            include "conexion.php";

            // Utilizamos consultas preparadas para evitar inyección de SQL
            $sql = "UPDATE productos SET nombre = ?, precio = ?, marca = ?, descripcion = ?, stock = ? WHERE id = ?";
            $stmt = $con->prepare($sql);

            // Verificamos si la preparación de la consulta fue exitosa
            if ($stmt) {
                // Vinculamos los parámetros y ejecutamos la consulta
                $stmt->bind_param("ssssii", $_POST["nombre"], $_POST["precio"], $_POST["marca"], $_POST["descripcion"], $_POST["stock"], $_POST["id"]);
                $stmt->execute();

                // Verificamos si la actualización fue exitosa
                if ($stmt->affected_rows > 0) {
                    print "<script>alert(\"Actualizado exitosamente.\");window.location='../ver.php';</script>";
                } else {
                    print "<script>alert(\"No se pudo actualizar.\");window.location='../ver.php';</script>";
                }

                // Cerramos la consulta preparada
                $stmt->close();
            } else {
                // Si hubo un error en la preparación de la consulta
                print "<script>alert(\"Error en la consulta.\");window.location='../ver.php';</script>";
            }
        } else {
            // Si faltan campos obligatorios en el formulario
            print "<script>alert(\"Todos los campos son obligatorios.\");window.location='../ver.php';</script>";
        }
    } else {
        // Si no se recibieron todos los parámetros esperados
        print "<script>alert(\"Parámetros incompletos.\");window.location='../ver.php';</script>";
    }
} else {
    // Si no se recibió ningún dato del formulario
    print "<script>alert(\"No se recibieron datos.\");window.location='../ver.php';</script>";
}
?>
