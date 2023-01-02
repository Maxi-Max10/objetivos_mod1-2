<?php

include "conexion.php";

//LISTA DE PERSONAS 
# CONSULTA 1
$sentenciaPer = "SELECT * FROM persona INNER join personaobjetivo ON persona.id_persona = personaobjetivo.persona_id_persona 
                WHERE personaobjetivo.cargo_pers = 1 GROUP BY persona.id_persona;";
$resultadoPer= mysqli_query($conexion,$sentenciaPer);

?>

<!doctype html>
<html lang="en">

<head>
    <title>Persona asigna</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>
    <main>
        <div class="container shadow rounded mt-5">
            <div class="row justify-content-center align-items-center p-5">
                <?php
                # USO CONSULTA 1
                    while($listPer= $resultadoPer->fetch_array()){
                        $idP = $listPer['id_persona'];
                        $nombrePer = $listPer['nombre_apellido'];
                ?>
                
                <div class="card mb-5 mt-4 bg-secondary bg-opacity-10">
                    <div class="mt-3 mb-3 text-center">
                        <h4><?php echo $nombrePer; ?></h4>
                    </div>
                    <h6>Objetivos</h6>
                    <?php
                        # # # OBTENGO EL OBJETIVO Y EL PORCENTAJE DE CADA PERSONA # # #

                        $sentenciaO = "SELECT * FROM persona 
                                       INNER JOIN personaobjetivo ON persona.id_persona = personaobjetivo.persona_id_persona
                                       INNER JOIN objetivos ON personaobjetivo.objetivos_id_objetivo = objetivos.id_objetivo
                                       WHERE persona.id_persona = '".$idP."';";
                        $resultadoO = mysqli_query($conexion,$sentenciaO);

                        while($listO= $resultadoO->fetch_array()){
                            
                        $idOBJ = $listO['objetivos_id_objetivo'];
                        $nombreOBJ = $listO['nombre_objetivo'];
                        $sentenciaPorcen = "SELECT SUM(personaobjetivo.porcentaje) FROM objetivos 
                                        INNER JOIN personaobjetivo ON objetivos.id_objetivo = personaobjetivo.objetivos_id_objetivo 
                                        INNER JOIN persona on personaobjetivo.persona_id_persona = persona.id_persona 
                                        WHERE personaobjetivo.persona_id_persona = '".$idP."' and personaobjetivo.objetivos_id_objetivo = '".$idOBJ."';";
                        $resultadoPorcen = mysqli_query($conexion,$sentenciaPorcen);
                        $datoPorcen = $resultadoPorcen->fetch_column();
                        
                    ?>
                    <div class="card bg-info bg-opacity-10 mb-4">
                        <div class="mt-3 mb-3 text-center">
                        <h6><?php echo $listO['nombre_objetivo'] ?></h6>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div>
                                    <h6>Porcentaje asignado:<?php echo $datoPorcen ?> </h6>
                                    
                                </div>
                            </div>
                            <div class="col"></div>
                        </div>
                        <div class="gap-2 d-md-flex md-end mt-3 mb-3">
                            <!-- INICIO FORM PARA ENVIAR INFORMACION ASIGNAR PERSONAS Y PORCENTAJES A asignar_personas_porcentajes.php-->
                            <form action="asignar_personas_porcentajes.php" method="post">
                            <input type="hidden" name="id_obj" value="<?php echo $idOBJ ?>">
                            <input type="hidden" name="id_per" value="<?php echo $idP ?>">
                            <input type="hidden" name="porc" value="<?php echo $datoPorcen ?>">
                            <input type="hidden" name="nombreobj" value="<?php echo $nombreOBJ ?>">
                            <input type="hidden" name="nombrePer" value="<?php echo $nombrePer ?>">
                            <input type="submit" id="" class="btn btn-primary mt-2 mb-2" value="Asignar personas y porcentajes">
                            </form>
                            <!-- FIN FORM PARA ENVIAR INFORMACION ASIGNAR PERSONAS Y PORCENTAJES -->
                            
                            <!-- INICIO FORM PARA ENVIAR INFORMACION REPORTE A reportes.php -->
                            <form action="reportes.php" method="post">
                            <input type="hidden" name="id_obj" value="<?php echo $idOBJ ?>">
                            <input type="hidden" name="id_per" value="<?php echo $idP ?>">
                            <input type="hidden" name="porc" value="<?php echo $datoPorcen ?>">
                            <input type="hidden" name="nombreobj" value="<?php echo $nombreOBJ ?>">
                            <input type="submit" id="" class="btn btn-primary mt-2 mb-2" value="Reporte">
                            </form>
                            <!-- FIN FORM PARA ENVIAR INFORMACION PORCENTAJES -->
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
                
                <?php
                    }
                ?>
            </div>
        </div>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>