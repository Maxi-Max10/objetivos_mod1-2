<?php
# OBTENGO LOS DATOS ENVIADOS DE persona_asigna.php
 $nombreobjR = $_POST['nombreobj'];
 $id_obR = $_POST['id_obj'];
 $id_perR = $_POST['id_per'];

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

    <main>
        <div class="container shadow rounded mt-5">
            <div class="row justify-content-center align-items-center p-5">
                <h2 class=" text-center">Reporte de <?php echo $nombreobjR ?></h2>
            </div>
            <div class="container">

                <!-- INICIO FORMULARIO CREAR REPORTE -->

                <form id="form_ajaxRep" action="control_reporte.php" enctype="multipart/form-data" method="POST">
                    <div class="mb-3 row">
                        <label class="col-4 col-form-label">Detalle</label>
                        <div class="col-8">
                            <textarea type="text" class="form-control" id="detalleR" name="detalleR"></textarea>
                        </div>
                    </div>
                    <div id="aler_detalleRep" class="text-danger" style="font-size: 12px;"></div>
                    <div class="mb-3 row">
                        <label class="col-4 col-form-label">Adjunte archivo</label>
                        <div class="col-8">
                            <input type="file" class="form-control" id="archivoR" name="archivoR">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="offset-sm-4 col-sm-8">
                            <input type="hidden" name="personaAsig" value="<?php echo $id_perR ?>">
                            <input type="hidden" name="objAsig" value="<?php echo $id_obR ?>">
                            <input type="submit" id="btn_ajaxRep" class="btn btn-primary mt-2 mb-2" value="Guardar">
                            <a href="persona_asigna.php" class="btn btn-danger mt-5 mb-5 m" role="button">Cancelar</a>
                        </div>
                    </div>
                </form>

                <!-- FIN FORMULARIO CREAR REPORTE -->

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