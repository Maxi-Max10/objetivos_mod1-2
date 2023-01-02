<?php

if(!isset($_GET)){
    header('Location: entrada.php');

}else if(isset($_GET)){

    include "conexion.php";

    $id_objetivo = $_GET['id_objetivo'];

    //consulto para traer solamente el objetivo con el id que fue enviado por metodo GET
    $sentenciaObj = "SELECT * FROM objetivos WHERE id_objetivo = '".$id_objetivo."'";
    $resultadoObj = mysqli_query($conexion,$sentenciaObj);

    
    $sentenciaPer = "SELECT * FROM objetivos 
                    INNER JOIN personaobjetivo ON objetivos.id_objetivo = personaobjetivo.objetivos_id_objetivo
                    INNER JOIN persona on personaobjetivo.persona_id_persona = persona.id_persona
                    WHERE objetivos.id_objetivo = '".$id_objetivo."' and persona.cargo = 1";
    $resultadoPer= mysqli_query($conexion,$sentenciaPer);
    
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Modificación de objetivo</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    
    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <script src="ajax_modificar_objetivo.js"></script>

</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>
    <main>
        <div class="container shadow rounded mt-5 mb-5">
            <div class="row justify-content-center align-items-center p-5">
                <div class="mt-3 mb-3 text-center">
                    <h4>Modificación de objetivo</h4>
                </div>

                <?php
                    while($filaObj = $resultadoObj->fetch_array()){
                ?>
                 <!-- INICIO FORMULARIO MODIFICACION DE OBJETIVO -->
                <form action="" id="form_ajax" method="post">
                    <div id="mensaje"></div>
                    <div class="row justify-content-between">
                        <div class="col-md-4">
                            <div class="mt-3">
                                <label for="nombre" class="form-label">Nombre Objetivo</label>
                                <input class="form-control" id="nombre_" name="nombre_objetivo"
                                    placeholder="Nombre Objetivo"
                                    value="<?php echo $filaObj['nombre_objetivo'] ?>"></input>
                            </div>
                        <div id="aler_nombre_objetivo" class="text-danger" style="font-size: 12px;"></div>
                        </div>
                        <div class="mt-5">
                            <label class="form-label">Detalle Objetivo</label>
                            <textarea class="form-control" id="detalle_" name="detalle_objetivo" placeholder="Detalle objetivo"
                                value=""><?php echo $filaObj['detalle_objetivo'] ?></textarea>
                        </div>
                        <div id="aler_detalle_objetivo" class="text-danger" style="font-size: 12px;"></div>
                    </div>
            </div>

            <div class="mt-5">
                <label class="form-label mb-3">Personas asignadas</label>

                <div class="table-responsive">
                    <table class="table table-primary">
                        <thead>
                            <tr>
                                <th scope="col">Nombre y Apellido</th>
                                <th scope="col">Pocentaje</th>
                                <th scope="col">Eliminar de obejtivo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($filaPer = $resultadoPer->fetch_array()){
                            ?>
                            <tr >
                                <td scope="row"><?php echo $filaPer['nombre_apellido'] ?></td>
                                <td><?php echo $filaPer['porcentaje'] ?></td>
                                <td><input class="form-check-input" type="checkbox" name="check[]" value="<?php echo $filaPer["id_persona"]; ?>"></td>
                            </tr>
                            <?php
                                }      
                            ?>
                        </tbody>
                    </table>
                </div>
            <div class = "row">
            <div class="mt-3 col-md-1">
                <input type="hidden" name="id_objetivo" value="<?php echo $filaObj['id_objetivo']; ?>">
                <input type="button" id="btn_ajax" class="btn btn-primary mt-5 mb-5" value="Guardar">
            </div>
            <div class="mt-3 col-md-1">
                <a href="entrada.php" class="btn btn-danger mt-5 mb-5 m" role="button">Cancelar</a>
            </div>
            </div>
            </form>
            <!-- FIN FORMULARIO MODIFICACION DE OBJETIVO -->
            <?php
                }      
            ?>
            
        </div>
        </div>

    </main>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>

</body>

</html>