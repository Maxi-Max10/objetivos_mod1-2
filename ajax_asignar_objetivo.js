$(function()
{
    $("#btn_ajaxA").click(function(){
        var url = "asignar_objetivo.php";
        $.ajax({
            type:"POST",
            url: url,
            data: $("#form_ajaxA").serialize(),
            success: function(data)
            {
                $('#aler_selec_persona').html('');
                $('#aler_selec_objetivo').html('');
                $('#aler_porcent').html('');
                
                $("#mensajeA").html(data);
                
            }

        });
    });
});