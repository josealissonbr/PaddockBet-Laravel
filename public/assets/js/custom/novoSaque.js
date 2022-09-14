
window.onload = function(){
    $("#valorSaque").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
    initFunction();
};

function initFunction(){
    $('.novoSaque-frm').submit(function (e){
        e.preventDefault();

        var submitBtn  = $('.submit-btn');
        var form = $(this);
        var actionUrl = form.attr('action');
        submitBtn.attr('disabled', 'disabled');
        submitBtn.html(`<i class="spinner-border spinner-border-sm"></i> Solicitar`);

        $.ajax({
            type: "POST",
            url: actionUrl,
            data: form.serialize(),
            success: function(data)
            {
                if (data.status){
                    submitBtn.html(`<i class="fa fa-save"></i> Solicitado`);

                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso!',
                        text: data.msg
                    })
                }else{
                    submitBtn.removeAttr('disabled');
                    submitBtn.html(`<i class="fa fa-save"></i> Solicitar`);
                    Swal.fire({
                        icon: 'error',
                        title: 'Poxa...',
                        text: data.msg
                    })
                }
            },
            error: function(data)
            {
                submitBtn.removeAttr('disabled');
                submitBtn.html(`<i class="fa fa-save"></i> Solicitar`);

                Swal.fire({
                    icon: 'error',
                    title: 'Poxa...',
                    text: data.msg
                })
            }
        });

    });

}
