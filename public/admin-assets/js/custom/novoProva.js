
$('#datetimepicker').datetimepicker({format:'d/m/Y H:i'});

$('.novoProvaFrm').submit(function(e) {
    e.preventDefault();

    var form = $(this);
    var actionUrl = form.attr('action');

    $.ajax({
        type: "POST",
        url: actionUrl,
        data: form.serialize(), // serializes the form's elements.
        success: function(data)
        {
            if (data.status){

                let timerInterval
                Swal.fire({
                title: 'Sucesso!',
                html: 'Estamos te redirecionando a tela de edição',
                timer: 2000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                    b.textContent = Swal.getTimerLeft()
                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
                }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    window.location.href = window.location.origin + "/admin/provas/editar/"+data.idProva;
                }
                })

            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Ocorreu um erro, verifique se todos os campos foram digitados corretamente.',
                    footer: 'Cod: PBET 3'
                })
            }
        },
        error: function(data)
        {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ocorreu um erro.',
                footer: 'Cod: PBET 4'
            })
        }
    });

});
