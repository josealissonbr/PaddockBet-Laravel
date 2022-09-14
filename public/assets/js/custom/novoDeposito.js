

window.onload = function(){
    $("#valorDeposito").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
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

        $('#pix-frm-div').hide();
        $('#pix-checkout-div').css('display', 'block');

        $('#copy-btn').popover();
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
