$('#datetimepicker').datetimepicker({format:'d/m/Y H:i'});

$('.editarProvaFrm').submit(function(e) {
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
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso!',
                    text: data.msg
                })
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Ocorreu um erro, verifique se todos os campos foram digitados corretamente.'
                })
            }
        },
        error: function(data)
        {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ocorreu um erro.'
            })
        }
    });

});

function definirConjuntoVencedor(idConjunto, idProva){

    var URL = $('#conjunto_URL').val();
    var apikey = $('#apikey').val();

    console.log(URL);

    Swal.fire({
        title: 'Tem certeza?',
        text: "Definir um vencedor é irreversível.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, definir como vencedor',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {

            console.log('preparando!');

            $.ajax({
                type: "POST",
                url: URL,
                data: {apikey: apikey, idConjunto: idConjunto, idProva: idProva},
                success: function(data)
                {
                    console.log('Sucesso!');
                    if (data.status){

                        $('.conjunto-btn').attr('disabled','disabled');
                        $('#conjunto_'+idConjunto).text('Vencedor');

                        Swal.fire({
                            icon: 'success',
                            title: 'Sucesso!'
                        })
                    }else{
                        console.log('Oops!');
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.msg
                        })
                    }
                },
                error: function(data)
                {
                    console.log('erro!');
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Ocorreu um erro.'
                    })
                }
            });

        }
    })
}
