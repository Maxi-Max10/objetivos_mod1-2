<?php

include "conexion.php";
//print_r($_POST);

$mensajeA = null;
$query = null;
$suma = 0;
$datoPorcen = 0;

$id_obj = $_POST['selec_objetivo'];
$id_per = $_POST['selec_persona'];
$porcentaje = $_POST['porcentaje'];
$cargo = $_POST['cargo'];

//Busco la persona seleccionada y el objetivo seleccionado, para comprobar si ya tiene asignado el objetivo que se selecciono(PERSONA CARGO 1)
# Validacion objetivo_persona #
$sentenciaPerso = "SELECT * FROM persona 
                   INNER JOIN personaobjetivo ON persona.id_persona = personaobjetivo.persona_id_persona
                   WHERE personaobjetivo.objetivos_id_objetivo = '".$id_obj."' and persona.id_persona='".$id_per."';";
$resultadoPerso = mysqli_query($conexion,$sentenciaPerso);
$datos = $resultadoPerso->fetch_all();


//REALIZO UNA SUMATORIA DE LOS PORCENTAJES DEL OBJETIVO SELECCIONADO PARA VERIFICAR SI AUN TENGO PORCENTAJE DISPONIBLE PARA ASIGNAR (PERSONA CARGO 1)
$sentenciaPorcen = "SELECT SUM(personaobjetivo.porcentaje) FROM objetivos 
                    INNER JOIN personaobjetivo ON objetivos.id_objetivo = personaobjetivo.objetivos_id_objetivo 
                    INNER JOIN persona on personaobjetivo.persona_id_persona = persona.id_persona 
                    WHERE objetivos.id_objetivo = '".$id_obj."' and persona.cargo = 1;";
$resultadoPorcen = mysqli_query($conexion,$sentenciaPorcen);
$datoPorcen = $resultadoPorcen->fetch_column();
//Sumo el porcentaje total obtenido del objetivo seleccionado mas el porcentaje ingresado por el usuario
//Validacion
$suma = $datoPorcen + intval($porcentaje);// cambio string a int
//print_r($suma);

### INICIO FUNCIONES VALIDACION SELECT Y INPUT PORCENTAJE ###
function validarSelectPer(){
    $id_per = $_POST['selec_persona'];

    if($id_per == ""){
        return TRUE;
    }else{
        return FALSE;
    }
}

function validarSelectObje(){
    $id_obj = $_POST['selec_objetivo'];

    if($id_obj == ""){
        return TRUE;
    }else{
        return FALSE;
    }
}

function validarPorcent(){
    $porcentaje = $_POST['porcentaje'];

    if($porcentaje == "" || !is_numeric($porcentaje) || $porcentaje <= 0){
        return TRUE;
    }else {
        return FALSE;
    }
}

if(validarSelectPer()){
    echo "<script>
                document.getElementById('aler_selec_persona').innerHTML='Seleccione una persona.';
                </script>";
}

if(validarSelectObje()){
    echo "<script>
                document.getElementById('aler_selec_objetivo').innerHTML='Seleccione un objetivo.';
                </script>";
}

if(validarPorcent()){
    echo "<script>
                document.getElementById('aler_porcent').innerHTML='Ingrese un porcentaje válido.';
                document.getElementById('porcentaje').style.borderColor='red';
                </script>";
}else if ($suma > 100) {
    echo "<script>
                document.getElementById('aler_porcent').innerHTML='El porcentaje asignado sobre pasa el 100%.';
                document.getElementById('porcentaje').style.borderColor='red';
          </script>";
}else{
    echo "<script>
                document.getElementById('porcentaje').style.borderColor='green';
          </script>";
}
########################

# Validacion objetivo_persona #
if($datos){
    echo "<script>
                document.getElementById('aler_selec_objetivo').innerHTML='La persona seleccionada ya tiene este objetivo asigando.';
                </script>";
}

//INSERTO DATOS EN BASE DE DATOS
if (validarSelectPer() === FALSE && validarSelectObje() == FALSE && validarPorcent() == FALSE && $datos == FALSE && ($suma < 101)) {
    
    $sentencia = "INSERT INTO personaobjetivo(persona_id_persona,objetivos_id_objetivo,porcentaje,cargo_pers) VALUES ('".$id_per."', '".$id_obj."', '".$porcentaje."', '".$cargo."')";
    $query = $conexion->query($sentencia) or die (mysqli_error($conexion));

}

if($query === true){
    $mensajeA = '<script> swal("Exito!", "Se a asignado objetivo correctamente!", "success").then(function(){window.location="entrada.php"}); </script>';
    }

echo $mensajeA;


?>