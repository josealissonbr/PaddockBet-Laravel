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

    var submitBtn  = document.getElementById('palpite_btn');
    var form = $(this);
    var actionUrl = form.attr('action');
    //submitBtn.setAttribute('disabled', 'disabled');
    $.ajax({
        type: "POST",
        url: actionUrl,
        data: form.serialize(),
        success: function(data)
        {
            window.location.href=data.redirector;
        },
        error: function(data)
        {
            console.log('Falha ao processar request');
            //submitBtn.removeAttribute('disabled');
        }
    });

});
