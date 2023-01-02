<?php

include 'conexion.php';
$id_obj = $_GET['id'];
$estado = "Activo";

//Se hace un cambio de estado a ACTIVO
$sentencia = "UPDATE objetivos SET estado = '".$estado."' WHERE id_objetivo = '".$id_obj."'";
$query = $conexion->query($sentencia) or die (mysqli_error($conexion));

if ($query) {
    header('Location: entrada.php');
}

?>