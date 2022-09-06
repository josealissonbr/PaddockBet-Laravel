
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
