$('.novoEventoFrm').submit(function(e) {
    e.preventDefault();

    var form = $(this);
    var actionUrl = form.attr('action');

    $.ajax({
        type: "POST",
        url: actionUrl,
        data: form.serialize(), // serializes the form's elements.
        success: function(data)
        {
            console.log(data);
        },
        error: function(data)
        {
           console.log(data);
        }
    });

});

