<?php

include "conexion.php";
$mensajePer2=null;
$queryControl = null;
//print_r($_POST);

$porcentaje2 = $_POST['porcentaje2'];
$selec_persona2 = $_POST['selec_persona2'];
$id_per2 = $_POST['id_per'];
$id_obj2 = $_POST['id_obj'];
$cargo_per2 = $_POST['cargo_per2'];
$porcTotal = $_POST['porcTotal'];
$porcTotal = 100;

//OBTENGO LA PERSONA SELECCIONADA PARA LUEGO VERIFICAR SI YA TIENE EL OBJETIVO ASIGNADO(PERSONA CARGO 2)
# CONSULTA 1
$sentenciaPerso2 = "SELECT * FROM personaobjetivo 
                   WHERE personaobjetivo.objetivos_id_objetivo = '".$id_obj2."' 
                   AND personaobjetivo.persona_id_persona = '".$selec_persona2."'";
$resultadoPerso2 = mysqli_query($conexion,$sentenciaPerso2);
$datos2 = $resultadoPerso2->fetch_all();

//REALIZO UNA SUMATORIA DE LOS PORCENTAJES DEL OBJETIVO SELECCIONADO PARA VERIFICAR SI AUN TENGO PORCENTAJE DISPONIBLE PARA ASIGNAR (PERSONA CARGO 2)
$sentenciaPorcenP2 = "SELECT SUM(personaobjetivo.porcentaje) FROM objetivos 
                    INNER JOIN personaobjetivo ON objetivos.id_objetivo = personaobjetivo.objetivos_id_objetivo
                    WHERE objetivos.id_objetivo = '".$id_obj2."' AND personaobjetivo.cargo_pers = '".$cargo_per2."' AND personaobjetivo.asignado_por = '".$id_per2."';";
$resultadoPorcenP2 = mysqli_query($conexion,$sentenciaPorcenP2);
$datoPorcenP2 = $resultadoPorcenP2->fetch_column();

$sumaP2 = $datoPorcenP2 + intval($porcentaje2);// cambio string a int

// VALIDACIONES
if ($selec_persona2 == "") {
    echo "<script>
    document.getElementById('aler_selec_per2').innerHTML='Seleccione una persona.';
    </script>";

#### CONSULTA 1 ####
}else if($datos2){
    echo "<script>
    document.getElementById('aler_selec_per2').innerHTML='La persona seleccionada ya tiene este objetivo asignado.';
    </script>";

}else if($porcentaje2 == "" || $porcentaje2 <= 0 || !is_numeric($porcentaje2)) {
    echo "<script>
    document.getElementById('aler_porcent2').innerHTML='Ingrese un porcentaje válido';
    </script>";

}else if ($sumaP2 > $porcTotal) {
    echo "<script>
    document.getElementById('aler_porcent2').innerHTML='El porcentaje asignado es mayor al porcentaje disponible';
    </script>";
}else{
    // GUARDO LOS DATOS EN LA BASE DE DATOS
    $sentenciaControl = "INSERT INTO personaobjetivo (persona_id_persona, objetivos_id_objetivo, cargo_pers, asignado_por,porcentaje)
    VALUES('".$selec_persona2."', '".$id_obj2."', '".$cargo_per2."','".$id_per2."', '".$porcentaje2."') ";

    $queryControl = $conexion->query($sentenciaControl) or die (mysqli_error($conexion));
       
}  

if($queryControl === true){
    $mensajePer2 = '<script> swal("Exito!", "Se a asignado objetivo correctamente!", "success").then(function(){window.location="persona_asigna.php"}); </script>';
    }

echo $mensajePer2;

?>