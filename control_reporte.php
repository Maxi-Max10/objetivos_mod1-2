<?php
include "conexion.php";

$detalleR = $_POST['detalleR'];
$archivoR = $_FILES['archivoR']['name'];
$personaAsig = $_POST['personaAsig'];
$objAsig = $_POST['objAsig'];
$tipo = $_FILES['archivoR']['type'];
$temp = $_FILES['archivoR']['tmp_name'];

//INSERTO DATOS EN LA BASE DE DATOS
    $queryRep = "INSERT INTO reportes(reporte_id_objetivo,reporte_id_persona,detalle,archivo) values ('".$objAsig."', '".$personaAsig."', '".$detalleR."', '".$archivoR."')";
    $resulRep = $conexion->query($queryRep);  
    if ($resulRep) {
        move_uploaded_file($temp, 'files/'.$archivoR);
        echo '<script type="text/javascript">alert("Reporte creado correctamente!");</script>';
        echo '<script type="text/javascript">window.location="persona_asigna.php";</script>';
    }

?>