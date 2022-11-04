

window.onload = function(){
    $("#valorDeposito").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'', decimal:',', affixesStay: false});
    initFunction();
};

var TXID_PROCESSED = false;

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

                    $('#linhaPix').val(data.pix);
                    $('#linhaPix2').val(data.pix);

                    $('#pix-qrcode').attr('src', `https://chart.googleapis.com/chart?chs=420x420&cht=qr&chl=${data.pix}`);

                    //$('#copy-btn').popover();

                    //Inicia o contador visual, para redirecionamento para Dashboard
                    startVisualCountdownTimer();
                    startCheckerTimer(data.idDeposito);
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
        copyPix();
    });






}

function copyPix(){
    ClipboardHelper.copyText($('#linhaPix').val());
    alert('Linha do Pix copiado para área de transferência');
    /*$('#copy-btn').popover('show');
    setTimeout(function(){
        $('#copy-btn').popover('hide');
    }, 1000);*/

}

function startVisualCountdownTimer(){

    var d1 = new Date (),
    d2 = new Date ( d1 );
    d2.setMinutes ( d1.getMinutes() + 5 );

    // Set the date we're counting down to
    var countDownDate = d2.getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

    // Get today's date and time
    var now = new Date().getTime();

    // Find the distance between now and the count down date
    var distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Output the result in an element with id="timerLbl"
    document.getElementById("timerLbl").innerHTML = /* days + "d " + hours + "h "
    + */minutes + "m " + seconds + "s ";

    // If the count down is over, write some text
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("timerLbl").innerHTML = "Redirecionando...";
        var base_url = window.location.origin;
        window.location.href=`${base_url}/dashboard`;
    }
    }, 1000);

}

function startCheckerTimer(depositID){
    setInterval(function(txid = depositID) {
        if (TXID_PROCESSED)
            return;
        _CheckRequest(txid)
    },10000); //10 segundos
}

function _CheckRequest(depositID){

    var apikey = $('input[name="apikey"]').val();
    var base_url = window.location.origin;

    $.ajax({
        type: "POST",
        url: `${base_url}/api/dashboard/depositos/_checkDeposit`,
        data: {apikey: apikey, depositID: depositID},
        success: function(data)
        {
            if (data.status){
                TXID_PROCESSED = true;
                console.log('sucesso!');
                Swal.fire({
                    icon: 'success',
                    title: 'Depósito Confirmado!',
                    text: 'Depósito confirmado com sucesso!'
                }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href=`${base_url}/dashboard`;
                    }
                });
            }else{
                console.log('Pagamento ainda não processado!');
            }
        }
    });
}

function exibirQRCode(){

}
