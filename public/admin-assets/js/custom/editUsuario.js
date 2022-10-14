$('#datepicker').datepicker({dateFormat:'dd-mm-yy'});

$('.novoUsuarioFrm').submit(function(e) {
    e.preventDefault();

    var form = $(this);
    var actionUrl = form.attr('action');
    var novoUsuarioFrmSubmit = $('.novoUsuarioFrmSubmit');

    novoUsuarioFrmSubmit.html('<i class="spinner-border" style="width: 1rem; height: 1rem;"></i> Salvar');

    $.ajax({
        type: "POST",
        url: actionUrl,
        data: form.serialize(), // serializes the form's elements.
        success: function(data)
        {
            novoUsuarioFrmSubmit.html('Salvar');
            if (data.status){
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso!',
                    text: 'Usuário atualizado com sucesso!'
                })
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.msg,
                    footer: 'Cod: PBET 3223'
                })
            }
        },
        error: function(data)
        {
            novoUsuarioFrmSubmit.html('Salvar');
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Erro no backend',
                footer: 'Cod: PBET 1'
            })
        }
    });

});

