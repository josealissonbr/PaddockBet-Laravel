var ID_EVENTO = 1;
var ID_PROVA = 1;


var APP_URL = '';

var API_KEY = '';

function defineKeys(KEY, URL){
    APP_URL = URL;
    API_KEY = KEY;
}

$(document).ready(function() {
    initPage();
});

function initPage(){
    $('.cota-x2').click(function(e){
        var qtdCotas = $('input[name="qtdCotas"]');

        if ((qtdCotas.val() * 2)  > 100){
            qtdCotas.val(100);
        }else{
            qtdCotas.val(qtdCotas.val() * 2);
        }
    });

    $('.cota-x5').click(function(e){
        var qtdCotas = $('input[name="qtdCotas"]');

        if ((qtdCotas.val() * 5)  > 100){
            qtdCotas.val(100);
        }else{
            qtdCotas.val(qtdCotas.val() * 5);
        }
    });

    $('.cota-x10').click(function(e){
        var qtdCotas = $('input[name="qtdCotas"]');

        if ((qtdCotas.val() * 10)  > 100){
            qtdCotas.val(100);
        }else{
            qtdCotas.val(qtdCotas.val() * 10);
        }
    });
}

function setData(id, idProva){
    ID_EVENTO = id;
    ID_PROVA = idProva;
}

$('.btn-number').click(function(e){
    e.preventDefault();

    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {

            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            }
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());

    var palpiteBaseValor = $('#valorProva').val();
    var valorTotal = palpiteBaseValor * $(this).val();
    $('#totalPalpiteValor').text(`R$ ${valorTotal.toFixed(2)}`);
});
$('.input-number').change(function() {

    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());

    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        $(this).val(minValue);
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        $(this).val(maxValue);
    }

    var palpiteBaseValor = $('#valorProva').val();
    var valorTotal = palpiteBaseValor * valueCurrent;
    $('#totalPalpiteValor').text(`R$ ${valorTotal.toFixed(2)}`);
});

$(".input-number").keydown(function (e) {
    // Allow: backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
         // Allow: Ctrl+A
        (e.keyCode == 65 && e.ctrlKey === true) ||
         // Allow: home, end, left, right
        (e.keyCode >= 35 && e.keyCode <= 39)) {
             // let it happen, don't do anything
             return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
});

$('#efetuar-palpite-frm').submit(function (e){
    e.preventDefault();

    var submitBtn  = $('#palpite_btn');
    var form = $(this);
    var actionUrl = form.attr('action');
    submitBtn.attr('disabled', 'disabled');
    submitBtn.html(`<i class="spinner-border spinner-border-sm"></i> Apostar`);

    $.ajax({
        type: "POST",
        url: actionUrl,
        data: form.serialize(),
        success: function(data)
        {
            if (data.status){

                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso!',
                    text: 'Sua aposta foi confirmada com sucesso!',
                    showCloseButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Ir para o Evento',
                    cancelButtonText: 'Apostar mais',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        window.location.href=`${window.location.origin}/dashboard/provas/${ID_EVENTO}`;
                    }
                })

                submitBtn.removeAttr('disabled');
                submitBtn.html(`<i class="fa fa-save"></i> Apostar`);
            }else{
                submitBtn.removeAttr('disabled');
                submitBtn.html(`<i class="fa fa-save"></i> Apostar`);
                if (data.err_type == 1){

                    Swal.fire({
                        icon: 'error',
                        title: 'Falha',
                        text: data.msg,
                        showCloseButton: true,
                        showCancelButton: true,
                        confirmButtonText: '<i class="fas fa-money-check"></i> Fazer Depósito!',
                        cancelButtonText: '<i class="fas fa-arrow-left"></i> Voltar',
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            window.location.href=`${window.location.origin}/dashboard/depositos/novo`;
                        }
                    })

                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Falha',
                        text: data.msg
                    })
                }

            }
        },
        error: function(data)
        {
            console.log('Falha ao processar request');
            submitBtn.removeAttr('disabled');
            submitBtn.html(`<i class="fa fa-save"></i> Apostar`);
            Swal.fire({
                icon: 'error',
                title: ':(',
                text: 'Ocorreu um erro na solicitação, tente atualizar a página'
            });

        }
    });

});

$('input[name="qtdCotas"]').change(function(e){
    var conjuntoSelecionado = $( "select[name='conjuntoSelecionado'] option:selected" ).val();
    $.ajax({
        type: 'POST',
        url: `${window.location.origin}/api/provas/palpites/calcOdds`,
        data: {apikey: API_KEY, idProva: ID_PROVA, qtdCotas: $(this).val()},
        success: function(response) {
            $('select[name="conjuntoSelecionado"]').html(response);

            $('select[name="conjuntoSelecionado"]').val(conjuntoSelecionado);
        }
    });
});
