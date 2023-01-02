<?php

include 'conexion.php';
$id_obj = $_REQUEST['id'];
$estado = "Inactivo";



//Se hace un cambio de estado
$sentencia = "UPDATE objetivos SET estado = '".$estado."' WHERE id_objetivo = '".$id_obj."'";
$query = $conexion->query($sentencia) or die (mysqli_error($conexion));

//Elimino el objetivo y las persona que tenian asignado el objetivo dado de baja de la tabla personaobjetivo. 
//Y la persona queda sin ningún objetivo asignado.
$sentencia = "DELETE FROM personaobjetivo WHERE objetivos_id_objetivo = '".$id_obj."'";
$query = $conexion->query($sentencia) or die (mysqli_error($conexion));

if ($query) {
    header('Location: entrada.php');
}

?>