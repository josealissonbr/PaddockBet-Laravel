

window.onload = function(){
    $("#valorDeposito").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'', decimal:',', affixesStay: false});
    initFunction();
};

var ClipboardHelper = {

    copyElement: function ($element)
    {
       this.copyText($element.text())
    },
    copyText:function(text) // Linebreaks with \n
    {
        var $tempInput =  $("<textarea>");
        $("body").append($tempInput);
        $tempInput.val(text).select();
        document.execCommand("copy");
        $tempInput.remove();
    }
};

function initFunction(){
    console.log('Initialized');
    $('.novoDeposito-frm').submit(function (e){
        e.preventDefault();

        var submitBtn  = $('.submit-btn');
        var form = $(this);
        var actionUrl = form.attr('action');
        submitBtn.attr('disabled', 'disabled');
        submitBtn.html(`<i class="spinner-border spinner-border-sm"></i> Depositar`);

        $.ajax({
            type: "POST",
            url: actionUrl,
            data: form.serialize(),
            success: function(data)
            {
                if (data.status){
                    $('#pix-frm-div').hide();
                    $('#pix-checkout-div').css('display', 'block');

                    $('#pix-payment-value').text('R$ ' + $('#valorDeposito').val());

                    $('#copy-btn').popover();
                }else{
                    submitBtn.removeAttr('disabled');
                    submitBtn.html(`<i class="fa fa-plus"></i> Depositar`);
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
                submitBtn.html(`<i class="fa fa-save"></i> Depositar`);

                Swal.fire({
                    icon: 'error',
                    title: 'Poxa...',
                    text: data.msg
                })
            }
        });

    });

    $('#linhaPix').click(function(){
        ClipboardHelper.copyText(this.value);
        $('#copy-btn').popover('show');
    });

    $('#copy-btn').click(function(){
        ClipboardHelper.copyText(this.value);
        $('#copy-btn').popover('show');
    });


}

function exibirQRCode(){

}
