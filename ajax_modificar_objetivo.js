$(function()
{
    $("#btn_ajax").click(function(){
        var url = "modificar.php";
        $.ajax({
            type:"POST",
            url: url,
            data: $("#form_ajax").serialize(),
            success: function(data)
            {
                $('#aler_nombre_objetivo').html('');
                $('#aler_detalle_objetivo').html('');

                $("#mensaje").html(data);
            }

        });
    });
});


