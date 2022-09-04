$('.editar-perfil-form').submit(function (e){
    e.preventDefault();

    var submitBtn  = $('#editar-perfil-submit');
    var form = $(this);
    var actionUrl = form.attr('action');
    submitBtn.attr('disabled', 'disabled');
    submitBtn.html(`<i class="spinner-border spinner-border-sm"></i> Atualizando...`);

    $.ajax({
        type: "POST",
        url: actionUrl,
        data: form.serialize(),
        success: function(data)
        {
            if (data.status){
                submitBtn.removeAttr('disabled');
                submitBtn.html(`<i class="fa fa-save"></i> Atualizar`);

                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso!',
                    text: data.msg
                })
            }else{
                submitBtn.removeAttr('disabled');
                submitBtn.html(`<i class="fa fa-save"></i> Atualizar`);
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
            submitBtn.html(`<i class="fa fa-save"></i> Atualizar`);

            Swal.fire({
                icon: 'error',
                title: 'Poxa...',
                text: data.msg
            })
        }
    });

});
