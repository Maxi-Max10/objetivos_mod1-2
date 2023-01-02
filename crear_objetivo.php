<?php

include "conexion.php";
$mensajeC = null;
$query = null;


$nombre_obj = $_POST['nombre_objetivo'];
$detalle_obje = $_POST['detalle_objetivo'];
$estado = "Activo";

function validarNom(){
    $nombre_obj = $_POST['nombre_objetivo'];
    if ($nombre_obj == "") {
        return TRUE;
    }else{
        return FALSE;
    }

}

function validarDet(){
    $detalle_obje = $_POST['detalle_objetivo'];
    if ($detalle_obje == "") {
        return TRUE;
    }else{
        return FALSE;
    }
}

if (validarNom()) {
     echo "<script>
                document.getElementById('aler_nombre').innerHTML='Por favor asigne un nombre a objetivo.';
                document.getElementById('nombre').style.borderColor='red';
          </script>"; 

}else{
    echo "<script>
                document.getElementById('nombre').style.borderColor='green';
          </script>";
}

if (validarDet()) {
    echo "<script>
               document.getElementById('aler_detalle').innerHTML='Por favor asigne un detalle a objetivo.';
               document.getElementById('objetivo').style.borderColor='red';
         </script>"; 

}else{
    echo "<script>
                document.getElementById('objetivo').style.borderColor='green';
          </script>";
}

if (validarNom() === FALSE && validarDet() === FALSE) {
   $sentencia = "INSERT INTO objetivos(nombre_objetivo,detalle_objetivo, estado) 
            VALUES('".$nombre_obj."', '".$detalle_obje."', '".$estado."')";
   $query = $conexion->query($sentencia) or die (mysqli_error($conexion));
}


if($query === true){
    $mensajeC = '<script> swal("Exito!", "Se a creado objetivo!", "success").then(function(){window.location="entrada.php"}); </script>';
    }

echo $mensajeC;


?>