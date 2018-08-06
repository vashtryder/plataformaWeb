var js_institucion = function() {

    var handelInstitucionSubmit = function(){
        $('#btn-submit-update').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            btn.addClass('m-loader m-loader--right m-loader--primary').attr('disabled', true);

            form.ajaxSubmit({
                type: 'POST',
                url: 'view/module/administrador/administrador.php',
                data: form.serialize(),
                dataType: 'json',
                success: function(response, status, xhr, $form) {
                    btn.removeClass('m-loader m-loader--right m-loader--primary').attr('disabled', false);
                    if(response[0] == 1){
                        js_sistema.showErrorMsg(response[1],'success',3000);
                    }else{
                        js_sistema.showErrorMsg(response[1],'danger',3000);
                    }
                }
            });
        });

        $('#btn-cancel-update').click(function(e){
            $('#btn-submit-update').removeClass('m-loader m-loader--right m-loader--primary').attr('disabled', false)
        });

    }

    return{
        init: function(){
            handelInstitucionSubmit()
        }
    }
}();

$(document).ready(function() {
    js_institucion.init()
})