<?php

$user = "root";
$password = "";
$baseNombre = "db_objetivos";


try {
    $conexion = new mysqli("localhost",$user, $password, $baseNombre);

} catch (Exception $e) {
    printf("Fallo la conexión".$e->getMessage());
}



?>