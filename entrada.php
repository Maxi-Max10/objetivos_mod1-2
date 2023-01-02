<?php


include "conexion.php";


//Consualta para ver todas las personas y poder seleccionarlas
# CONSULTA 1
$sentenciaPerso = "SELECT * FROM persona where cargo = 1";
$resultadoPerso = mysqli_query($conexion,$sentenciaPerso);

//Consulta para ver los objetivos que estén en estado "activo" para poder seleccionarlos y asignarlos a las personas
#CONSULTA 2
$sentencia = "SELECT * FROM objetivos WHERE estado = 'Activo'";
$resultado = mysqli_query($conexion,$sentencia);


//Consulta para ver todos los objetivos y hacer ABM 
# CONSULTA 3
$sentencia2 = "SELECT * FROM objetivos"; 
$resultado2 = mysqli_query($conexion,$sentencia2);




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

     <!-- JS ASIGNAR OBJETIVO -->
    <script src="ajax_asignar_objetivo.js"></script>

</head>

<body>
    <main>
        <div class="container shadow rounded mt-5">
            <div class="row justify-content-center align-items-center p-5">
                <!--
                #########################
                CREACION DE OBJETIVOS 
                ########################
                -->
                <div class="card mb-5 bg-secondary bg-opacity-10">
                    <div class="mt-3 mb-3 text-center">
                        <h4>Creación de Objetivos</h4>
                    </div>
                    <div id="mensajeC"></div>
                    <form action="" id="form_ajaxC" method="POST">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mt-3">
                                    <label for="nombre" class="form-label">Nombre Objetivo</label>
                                    <input class="form-control" id="nombre" name="nombre_objetivo"
                                        placeholder="Nombre Objetivo"></input>
                                </div>
                                <div id="aler_nombre" class="text-danger" style="font-size: 12px;"></div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <label class="form-label">Detalle Objetivo</label>
                            <textarea class="form-control" id="objetivo" name="detalle_objetivo"
                                placeholder="Detalle objetivo"></textarea>
                        </div>

                        <div id="aler_detalle" class="text-danger" style="font-size: 12px;"></div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3 mb-3">
                            <input type="button" id="btn_ajaxC" class="btn btn-primary mt-2 mb-2" value="Guardar">
                        </div>
                    </form>
                </div>
                <!--
                ###########################
                CREACION DE OBJETIVOS FINAL 
                ##########################
                -->


                <!--
                #########################
                ASIGNACION DE OBJETIVOS 
                ########################
                -->
                <div class="card mt-5 mb-5 bg-secondary bg-opacity-10">
                    <div class="mt-3 mb-3 text-center">
                        <h4>Asignación de objetivo</h4>
                    </div>
                    <div id="mensajeA"></div>
                    <form action="" id="form_ajaxA" method="POST">
                        <div class="row align-items-start mt-3 ">

                            <div class="col-md-4">

                                <label class="form-label">Persona</label>

                                <select class="form-select" name="selec_persona" id="nombre_persona">
                                    <option selected value="">Seleccione persona</option>
                                    <?php

                                    ########### USO DE CONSULTA 1 #############
                                    while($filaPerso = $resultadoPerso->fetch_array()){
                                        $cargo =$filaPerso['cargo'];
                                    ?>
                                    <option value="<?php echo $filaPerso['id_persona'];?>">
                                        <?php echo $filaPerso['nombre_apellido'];?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <div id="aler_selec_persona" class="text-danger" style="font-size: 12px;"></div>
                            </div>
                            <div class="col-md-4 ">
                                <label class="form-label">Objetivo</label>
                                <select class="form-select" name="selec_objetivo">
                                    <option selected value="">Seleccione objetivo</option>
                                    <?php

                                    ########### USO DE CONSULTA 2 #############
                                        while($filaObje = $resultado->fetch_array()){
                                                                                                                              
                                    ?>
                                    <option value="<?php echo $filaObje['id_objetivo']; ?>">
                                        <?php echo $filaObje['nombre_objetivo']; ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                                <div id="aler_selec_objetivo" class="text-danger" style="font-size: 12px;"></div>
                            </div>

                            <div class="col-md-2">
                                <label class="form-label">Porcentaje</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text">%</span>
                                    <input type="text" value="0" id="porcentaje" placeholder="000" class="form-control"
                                        name="porcentaje">
                                </div>
                                <div id="aler_porcent" class="text-danger" style="font-size: 12px;"></div>
                            </div>

                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3 mb-3">
                            <input type="hidden" name="cargo" value="<?php echo $cargo; ?>">
                            <input type="button" id="btn_ajaxA" class="btn btn-primary mt-2 mb-2" value="Asignar">
                        </div>
                    </form>
                </div>
                <!--
                #############################
                ASIGNACION DE OBJETIVOS FINAL
                #############################
                -->


                <!--
                #####################################
                ALTA, BAJA, MODIFICACION DE OBJETIVOS
                #####################################
                -->
                <div class="card mt-5">
                    <div class="card-header text-center mb-5">
                        <h2>ABM</h2>
                    </div>
                    <div class="p-4">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="table-dark">
                                    <tr class="text-center">
                                        <th scope="col">Nombre Objetivo</th>
                                        <th scope="col">Detalle </th>
                                        <th scope="col">Porcentaje</th>
                                        <th scope="col" colspan="2">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!---
                                    ################## 
                                    USO DE CONSULTA 3 
                                    #################
                                    -->
                                    <?php
                                        
                                            
                                        while($fila2 = $resultado2->fetch_array()){
                                            $id = $fila2['id_objetivo'];

                                            $sentenciPorcen = "SELECT SUM(personaobjetivo.porcentaje) FROM objetivos 
                                                                    INNER JOIN personaobjetivo ON objetivos.id_objetivo = personaobjetivo.objetivos_id_objetivo 
                                                                    INNER JOIN persona on personaobjetivo.persona_id_persona = persona.id_persona 
                                                                WHERE objetivos.id_objetivo = '".$id."' AND persona.cargo = 1;";
                                            $resultadPorcen = mysqli_query($conexion,$sentenciPorcen);
                                            $datPorcen = $resultadPorcen->fetch_column();
                                    ?>
                                    <tr class="">
                                        <td scope="row"><?php echo $fila2['nombre_objetivo']; ?></td>
                                        <td><?php echo $fila2['detalle_objetivo']; ?></td>
                                        <td>
                                        <?php if ($datPorcen == "") {
                                            echo 0;
                                        }else {
                                            echo $datPorcen;
                                        } ?>
                                        </td>

                                        <?php
                                            if($fila2['estado'] === "Activo"){
                                        ?>
                                        <td class="text-center"><button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#Baja<?php echo $fila2["id_objetivo"]; ?>">Baja</button>
                                        </td>
                                        <td class="text-center"><a href="modificar_objetivo.php?id_objetivo=<?php echo $fila2["id_objetivo"]; ?>">
                                            <button class="btn btn-warning">Modifi.</button></a></td>

                                        <?php include "modal_baja.php";?>

                                        <?php
                                            } 
                                        ?>

                                        <?php
                                            if ($fila2['estado'] === "Inactivo") {
                                        ?>

                                        <td class="text-center"><a
                                                href="alta_objetivo.php?id=<?php echo $fila2["id_objetivo"]; ?>"><button
                                                    class="btn btn-success">Alta</button></a></td>
                                        <td class="text-center"><a
                                                href="modificar_objetivo.php?id_objetivo=<?php echo $fila2["id_objetivo"]; ?>"><button
                                                    class="btn btn-warning">Modifi.</button></a></td>
                                        <?php 
                                            }
                                        ?>
                                    </tr>
                                    <?php 
                                        include "modal_baja.php";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--
                ###########################################
                ALTA, BAJA, MODIFICACION DE OBJETIVOS FINAL
                ###########################################
                -->
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


</body>

</html>

<!-- ENVIO DE DATOS crear_objetivo.php -->

<script>
$(function()
{
    $("#btn_ajaxC").click(function(){
        var url = "crear_objetivo.php";
        $.ajax({
            type:"POST",
            url: url,
            data: $("#form_ajaxC").serialize(),
            success: function(data)
            {
                $('#aler_nombre').html('');
                $('#aler_detalle').html('');

                $("#mensajeC").html(data);
                
            }

        });
    });
});
</script>