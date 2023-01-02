<?php

include "conexion.php";
$nombre_objetivo = $_POST['nombre_objetivo'];
$detalle_objetivo = $_POST['detalle_objetivo'];
$mensaje = null;
$queryOb = null;
$query = null;
$arrayCheck = [];


$id_objetivo = $_POST['id_objetivo'];

function validarNombre(){
    $nombre_objetivo = $_POST['nombre_objetivo'];
    if ($nombre_objetivo == "") {
        return TRUE;
    }else{
        return FALSE;
    }

}

function validarDetalle(){
    $detalle_objetivo = $_POST['detalle_objetivo'];
    if ($detalle_objetivo == "") {
        return TRUE;
    }else{
        return FALSE;
    }
}

if(validarNombre()){
    echo "<script>
                document.getElementById('aler_nombre_objetivo').innerHTML='Por favor ingrese nombre.';
                document.getElementById('nombre_').style.borderColor='red';
                </script>";
}else{
    echo "<script>
                document.getElementById('nombre_').style.borderColor='green';
                </script>";
}

if (validarDetalle()) {
    echo "<script>
                document.getElementById('aler_detalle_objetivo').innerHTML='Por favor ingrese detalle.';
                document.getElementById('detalle_').style.borderColor='red';
                </script>"; 

}else{
    echo "<script>
                document.getElementById('detalle_').style.borderColor='green';
                </script>"; 

}

if(validarNombre() === FALSE && validarDetalle() === FALSE){

    $sentenciaOb = "UPDATE objetivos SET nombre_objetivo = '".$nombre_objetivo."', detalle_objetivo = '".$detalle_objetivo."' WHERE id_objetivo = '".$id_objetivo."'";
    $queryOb = $conexion->query($sentenciaOb) or die (mysqli_error($conexion));
    
    if (isset($_POST['check'])) {
        $arrayCheck = $_POST['check'];
        foreach($arrayCheck as $id_persona){
    
            $sentencia = "DELETE FROM personaobjetivo WHERE persona_id_persona = '".$id_persona."' AND objetivos_id_objetivo = '".$id_objetivo."'" ;
            $query = $conexion->query($sentencia) or die (mysqli_error($conexion));       
        }
        if ($query) {
            $sentenciaAsig = "DELETE FROM personaobjetivo WHERE asignado_por = '".$id_persona."' AND objetivos_id_objetivo = '".$id_objetivo."'" ;
                $queryAsig = $conexion->query($sentenciaAsig) or die (mysqli_error($conexion)); 
        }
    }
    
}

if($queryOb === true || $query === true){
    $mensaje = '<script> swal("Exito!", "Se a modificado correctamente!", "success").then(function(){window.location="entrada.php"}); </script>';
    }

echo $mensaje;

?>