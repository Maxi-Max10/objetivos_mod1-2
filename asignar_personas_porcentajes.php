<?php

include "conexion.php";
//print_r($_POST);
$id_obj = $_POST['id_obj'];
$id_per = $_POST['id_per'];
$porc = $_POST['porc'];
$nombreobj = $_POST['nombreobj'];
$nombrePer = $_POST['nombrePer'];

// LISTO LAS PERSONA QUE TENGAR CARGO NUMERO 2
# CONSULTA 1
$sentenciaPers2 = "SELECT * FROM persona WHERE cargo = 2";
$resultadoPers2 = mysqli_query($conexion,$sentenciaPers2);

// LISTO LA PERSONAS QUE TENGA EL CAGO NUMERO 2, YA TENGAN UN OBJETIVO Y PORCENTAJE ASIGNADO Y HAYAN SIDO ASIGNADAS POR PERSONAS CON CARGO NUMERO 1
# CONSULTA 2
$sentenciaPD = "SELECT * FROM persona INNER JOIN personaobjetivo ON persona.id_persona = personaobjetivo.persona_id_persona
                WHERE personaobjetivo.porcentaje > 0 AND personaobjetivo.cargo_pers = 2 AND personaobjetivo.asignado_por = '".$id_per."' 
                      AND personaobjetivo.objetivos_id_objetivo = '".$id_obj."'";
$resultadoPD = mysqli_query($conexion,$sentenciaPD);

?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

    <!-- SWEETALERT -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>
    <main>
        <div class="container shadow rounded mt-5">
            <div class="row justify-content-center align-items-center p-5">
                <h2><?php echo $nombreobj; ?></h2>
                <div class="mt-5 mb-3">
                    <p><?php echo $nombrePer; ?>, seleccione las personas que desea añadir al objetivo
                        "<?php echo $nombreobj ?>" y asigne un porcentaje.</p>
                </div>
                <div id="mensajePer2"></div>

                <!--  INICIO FROMULARIO ASIGNACION DE PERSONAS Y PORCENTAJE -->
                <form action="" id="form_ajax_per2" method="post" onKeyPress="if(event.keyCode == 13) event.returnValue = false;">
                    <div class="row align-items-start mt-3 ">
                        <div class="col-md-4">
                            <label class="form-label">Persona</label>
                            <select class="form-select" name="selec_persona2" id="nombre_persona">
                                <option selected value="">Seleccione persona</option>
                                <?php
                                        ### USO CONSULTA 1 ###
                                        while($filaPer2 = $resultadoPers2->fetch_array()){
                                            $id_per2 = $filaPer2['id_persona'];
                                            $cargo_per2 = $filaPer2['cargo'];
                                            
                                    ?>
                                <option value="<?php echo $id_per2;?>">
                                    <?php echo $filaPer2['nombre_apellido'];?></option>
                                <?php
                                          
                                        }      
                                    ?>
                            </select>

                            <div id="aler_selec_per2" class="text-danger" style="font-size: 12px;"></div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Porcentaje</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text">%</span>
                                <input type="text" value="0" id="porcentaje2" placeholder="000" class="form-control"
                                    name="porcentaje2">
                            </div>
                            <div id="aler_porcent2" class="text-danger" style="font-size: 12px;"></div>
                        </div>
                        <input type="hidden" name=porcTotal value="<?php echo $porc; ?>">
                        <input type="hidden" name="id_per" value="<?php echo $id_per; ?>">
                        <input type="hidden" name="id_obj" value="<?php echo $id_obj; ?>">
                        <input type="hidden" name="cargo_per2" value="<?php echo $cargo_per2; ?>">
                    </div>
                    <input id="btn_ajax_per2" class="btn btn-primary mt-5" type="button" value="Guardar">
                    <a href="persona_asigna.php" class="btn btn-danger mt-5" role="button">Cancelar</a>
                </form>

                <!--  FIN FROMULARIO ASIGNACION DE PERSONAS Y PORCENTAJE -->
                
                <!-- LISTO PERSONAS ASGINADAS A ESTE OBJETIVO  -->
                <label class="mt-5 mb-2" for="">Personas asignadas</label>
                <div class="table-responsive">
                    <table class="table table-primary">
                        <thead>
                            <tr>
                                <th scope="col">Nombre y Apellido</th>
                                <th scope="col">Pocentaje</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                ### USO CONSULTA 2 ###
                                while($filaPerDos = $resultadoPD->fetch_array()){
                            ?>
                            <tr>
                                <td scope="row"><?php echo $filaPerDos['nombre_apellido'] ?></td>
                                <td><?php echo $filaPerDos['porcentaje'] ?></td>
                            </tr>
                            <?php
                                }      
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>

<!-- ENVIO DE DATOS control_asignar_personas_porcentajes.php -->
<script>
$(function() {
    $("#btn_ajax_per2").click(function(e) {
     
        var url = "control_asignar_personas_porcentajes.php";
        $.ajax({
            type: "POST",
            url: url,
            data: $("#form_ajax_per2").serialize(),
            success: function(data) {
                $('#aler_selec_per2').html('');
                $('#aler_porcent2').html('');

                $("#mensajePer2").html(data);
            }

        });
    });
});
</script>