var APIKEY = $('input[name="apikey"]').val();
var APPURL = window.location.origin;

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
            }elseSwal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Ocorreu um erro, verifique se todos os campos foram digitados corretamente.'
                }){

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

$('.conjunto-update-btn').click(function(e){
    var idConjunto      = $(this).attr('id').replace('conjunto_','');
    var nomeConjunto    = $('#conjuntoNome_'+idConjunto).val();
    var ordemConjunto   = $('#conjuntoOrdem_'+idConjunto).val();

    $.ajax({
        type: "POST",
        url: APPURL + '/api/admin/provas/edit/conjunto/_update',
        data: {
            apikey:         APIKEY,
            idConjunto:     idConjunto,
            nomeConjunto:   nomeConjunto,
            ordemConjunto:  ordemConjunto,
        },
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
                    text: 'Falha ao editar o conjunto'
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


$('.novoConjuntoForm').submit(function(e){
    e.preventDefault();
    var form = $(this);
    var actionUrl = form.attr('action');

    $.ajax({
        type: "POST",
        url: APPURL + '/api/admin/provas/edit/conjunto/_create',
        data: form.serialize(),
        success: function(data)
        {
            if (data.status){
                Swal.fire({
                    title: 'Sucesso!',
                    html: 'Estamos te redirecionando a tela de edição',
                    timer: 2000,
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
                        window.location.reload();
                    }
                });
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.msg
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

function makeid(length) {
    var result           = '';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}

  // Pricing add
function newMenuItem() {
    var newElem = $('tr.conjuntos-edit-list-item').first().clone();
    var uniqueID = makeid(12);
    newElem.find('input').val('');
    newElem.find('input[conjuntoOrdem=""]').attr('id', 'conjuntoOrdem_'+uniqueID);
    newElem.find('input[conjuntoOrdem=""]').attr('name', 'conjuntoOrdem[]');
    newElem.find('input[conjuntoNome=""]').attr('id', 'conjuntoNome_'+uniqueID);
    newElem.find('input[conjuntoNome=""]').attr('name', 'conjuntoNome[]');
    newElem.find('.row').append(`<div class="col-md-2">
    <div class="form-group">
        <a class="delete" href="#"><i class="fa fa-fw fa-remove"></i></a>
    </div>
</div>`);
    newElem.find('.just-btn').remove();
    newElem.appendTo('table#conjuntos-edit-list-container');
}

$('.add-conjuntos-list-item').on('click', function (e) {
    e.preventDefault();
    newMenuItem();
});
$(document).on("click", "#conjuntos-edit-list-container .delete", function (e) {
    e.preventDefault();
    $(this).parent().parent().parent().remove();
});
