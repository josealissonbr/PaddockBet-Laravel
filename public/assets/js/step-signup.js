$(document).ready(function(){

    var inputed = false;

    // confirmation step
    var secondConfirm = $('#2nd-confirm');
    var thirdConfirm = $('#3rd-confirm');
    var finalConfirm = $('#final-confirm');

    // all form step
    var firstBtn =  $('#first-step').find('.next');
    var secondBtn =  $('#second-step').find('.next');
    var thirdBtn =  $('#third-step').find('.next');

    function nextStep() {
        $('#first-step').hide(500);
        $('#second-step').show(500);
        secondConfirm.addClass('active');
    }

    function secondStep() {
        $('#second-step').hide(500);
        $('#third-step').show(500);
        thirdConfirm.addClass('active');
    }

    function finalStep() {

        var firstName = $('#first-step').find('input#firstName').val();
        var lastName = $('#first-step').find('input#lastName').val();
        var dataNascimento = $('#first-step').find('input#dataNascimento').val();
        var cpfNumber = $('#second-step').find('input#cpf').val();
        var mobileNumber = $('#second-step').find('input#phoneNumber').val();
        var emailAdd = $('#third-step').find('input#emailAdd').val();
        var passwordNo = $('#third-step').find('input#passwordNo').val();
        var passwordAgain = $('#third-step').find('input#passwordAgain').val();
        var CSRFtoken = $('[name="_token"]').val();


        $.post(
            '/cadastro/process',
            {
                firstName: firstName,
                lastName: lastName,
                dataNascimento: moment(dataNascimento, "DD/MM/YYYY").format('MM/DD/YYYY'),
                cpfNumber: cpfNumber,
                mobileNumber: mobileNumber,
                emailAdd: emailAdd,
                passwordNo: passwordNo,
                _token: CSRFtoken,
            },
            function(response){
                if (response.status){
                    $('#third-step').hide(500);
                    $('#fourth-step').show(0);
                    finalConfirm.addClass('active');

                    setInterval(function(){
                        window.location.href="/dashboard";
                    }, 2500);

                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Poxa...',
                        text: response.msg
                        })
                }
            },"json"
        );

        // $('#third-step').hide(500);
        // $('#fourth-step').show(0);
        // finalConfirm.addClass('active');
    }

    firstBtn.on('click', function(){
        event.preventDefault();
        var firstName = $('#first-step').find('input#firstName').val();
        var lastName = $('#first-step').find('input#lastName').val();
        var dataNascimento = $('#first-step').find('input#dataNascimento').val();

        if (!isDate(dataNascimento)){
            Swal.fire({
                icon: 'error',
                title: 'Poxa...',
                text: 'Você deve inserir uma data de nascimento válida!',
                footer: '<a>Exemplo: 01/01/1990</a>'
              })
            return;
        }

        if(firstName.length === 0 || lastName.length === 0 || dataNascimento.length === 0) {

        } else {
            nextStep();
        }
    });
    secondBtn.on('click', function(){
        event.preventDefault();
        var cpfNumber = $('#second-step').find('input#cpf').val();
        var mobileNumber = $('#second-step').find('input#phoneNumber').val();
        if(cpfNumber.length < 11|| mobileNumber.length === 0) {

        } else {
            secondStep();
        }
    });
    thirdBtn.on('click', function(){
        event.preventDefault();
        var emailAdd = $('#third-step').find('input#emailAdd').val();
        var passwordNo = $('#third-step').find('input#passwordNo').val();
        var passwordAgain = $('#third-step').find('input#passwordAgain').val();
        if(emailAdd.length === 0 || passwordNo.length === 0 || passwordAgain.length === 0 || (passwordNo != passwordAgain)) {

        } else {
            finalStep();
        }
    });

    $('.single-form').each(function(){
        var inputed = false;
        var allValue = $(this).find('input').val();
        var buttonNext = $(this).find('.next');
        $(this).find('input').each(function(){
            $(this).focusin(function(){
                if($(this).val().length === 0) {
                    $(this).siblings('label').addClass('active');
                    console.log('nothing here');
                }
            });
            $(this).focusout(function(){
                if($(this).val().length === 0) {
                    $(this).siblings('label').removeClass('active');
                    console.log('nothing here');
                }
            });
        });
    });

});

const isDate = (date) => {
    var day = moment(date, "DD/MM/YYYY");

    return (new Date(date) !== "Invalid Date") && !isNaN(new Date(day.format('MM/DD/YYYY')));
}

function is_cpf (c) {

    if((c = c.replace(/[^\d]/g,"")).length != 11)
      return false

    if (c == "00000000000")
      return false;

    var r;
    var s = 0;

    for (i=1; i<=9; i++)
      s = s + parseInt(c[i-1]) * (11 - i);

    r = (s * 10) % 11;

    if ((r == 10) || (r == 11))
      r = 0;

    if (r != parseInt(c[9]))
      return false;

    s = 0;

    for (i = 1; i <= 10; i++)
      s = s + parseInt(c[i-1]) * (12 - i);

    r = (s * 10) % 11;

    if ((r == 10) || (r == 11))
      r = 0;

    if (r != parseInt(c[10]))
      return false;

    return true;
  }


  function fMasc(objeto,mascara) {
  obj=objeto
  masc=mascara
  setTimeout("fMascEx()",1)
  }

    function fMascEx() {
  obj.value=masc(obj.value)
  }

  function mCPF(cpf){
  cpf=cpf.replace(/\D/g,"")
  cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
  cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
  cpf=cpf.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
  return cpf
  }

  cpfCheck = function (el) {
      document.getElementById('cpfResponse').innerHTML = is_cpf(el.value)? '<span style="color:green">válido</span>' : '<span style="color:red">inválido</span>';
      if(el.value=='') document.getElementById('cpfResponse').innerHTML = '';
  }

  function mask(o, f) {
    setTimeout(function() {
      var v = mphone(o.value);
      if (v != o.value) {
        o.value = v;
      }
    }, 1);
  }

  function mphone(v) {
    var r = v.replace(/\D/g, "");
    r = r.replace(/^0/, "");
    if (r.length > 10) {
      r = r.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
    } else if (r.length > 5) {
      r = r.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
    } else if (r.length > 2) {
      r = r.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
    } else {
      r = r.replace(/^(\d*)/, "($1");
    }
    return r;
  }

  function mascaraData(val) {
    var pass = val.value;
    var expr = /[0123456789]/;

    for (i = 0; i < pass.length; i++) {
      // charAt -> retorna o caractere posicionado no índice especificado
      var lchar = val.value.charAt(i);
      var nchar = val.value.charAt(i + 1);

      if (i == 0) {
        // search -> retorna um valor inteiro, indicando a posição do inicio da primeira
        // ocorrência de expReg dentro de instStr. Se nenhuma ocorrencia for encontrada o método retornara -1
        // instStr.search(expReg);
        if ((lchar.search(expr) != 0) || (lchar > 3)) {
          val.value = "";
        }

      } else if (i == 1) {

        if (lchar.search(expr) != 0) {
          // substring(indice1,indice2)
          // indice1, indice2 -> será usado para delimitar a string
          var tst1 = val.value.substring(0, (i));
          val.value = tst1;
          continue;
        }

        if ((nchar != '/') && (nchar != '')) {
          var tst1 = val.value.substring(0, (i) + 1);

          if (nchar.search(expr) != 0)
            var tst2 = val.value.substring(i + 2, pass.length);
          else
            var tst2 = val.value.substring(i + 1, pass.length);

          val.value = tst1 + '/' + tst2;
        }

      } else if (i == 4) {

        if (lchar.search(expr) != 0) {
          var tst1 = val.value.substring(0, (i));
          val.value = tst1;
          continue;
        }

        if ((nchar != '/') && (nchar != '')) {
          var tst1 = val.value.substring(0, (i) + 1);

          if (nchar.search(expr) != 0)
            var tst2 = val.value.substring(i + 2, pass.length);
          else
            var tst2 = val.value.substring(i + 1, pass.length);

          val.value = tst1 + '/' + tst2;
        }
      }

      if (i >= 6) {
        if (lchar.search(expr) != 0) {
          var tst1 = val.value.substring(0, (i));
          val.value = tst1;
        }
      }
    }

    if (pass.length > 10)
      val.value = val.value.substring(0, 10);
    return true;
  }
