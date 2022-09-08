$('#datetimepicker').datetimepicker({format:'d/m/Y H:i'});

$('.novoUsuarioFrm').submit(function(e) {
    e.preventDefault();

    var form = $(this);
    var actionUrl = form.attr('action');
    var novoUsuarioFrmSubmit = $('.novoUsuarioFrmSubmit');

    novoUsuarioFrmSubmit.html('<i class="spinner-border" style="width: 1rem; height: 1rem;"></i> Adicionar Usuário');

    $.ajax({
        type: "POST",
        url: actionUrl,
        data: form.serialize(), // serializes the form's elements.
        success: function(data)
        {
            novoUsuarioFrmSubmit.html('Adicionar Usuário');
            if (data.status){
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso!',
                    text: 'Usuário criado com sucesso!'
                })
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.msg,
                    footer: 'Cod: PBET 2'
                })
            }
        },
        error: function(data)
        {
            novoUsuarioFrmSubmit.html('Adicionar Usuário');
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Erro no backend',
                footer: 'Cod: PBET 1'
            })
        }
    });

});

