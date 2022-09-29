$('.novoEventoFrm').submit(function(e) {
    e.preventDefault();
    var btnSubmit = $('.novo-evento-btn');
    btnSubmit.html('<i class="spinner-border" style="width: 1rem; height: 1rem;"></i> Adicionar Evento');
    btnSubmit.attr('disabled', 'disabled');

    var form = $(this);
    var actionUrl = form.attr('action');

    $.ajax({
        type: "POST",
        url: actionUrl,
        data: form.serialize(), // serializes the form's elements.
        success: function(data)
        {
            btnSubmit.html('<i class="fa fa-plus" aria-hidden="true"></i> Adicionar evento');

            if (data.status){
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso!',
                    text: data.msg,
                    showCancelButton: true,
                    confirmButtonText: 'Ver Eventos',
                    cancelButtonText: `Adicionar Outro`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                      window.location.href=`${window.location.origin}/admin/eventos`;
                    }
                  })
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Ocorreu um erro, verifique se todos os campos foram digitados corretamente'
                })

                btnSubmit.removeAttr('disabled');
            }
        },
        error: function(data)
        {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Erro no Backend'
            })
            btnSubmit.removeAttr('disabled');
        }
    });

});

