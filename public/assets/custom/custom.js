function ajaxQueryJSFile(idForm, load = '') {

    $('.' + idForm).submit(function (e) {
        
        e.preventDefault();

        var form = new FormData($(this)[0]);
        var buttonDefault = $('#' + idForm).text();
        var button = $('#' + idForm);

        button.attr('disabled', true);
        button.text('Veuillez patienter ...');

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: form,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (result) {
                button.attr('disabled', false);
                button.text(buttonDefault);

                if (result.status == "success") {
                    swal("", result.message, result.status);
                    if (load) {
                        eval(load);
                    }
                } else {
                    swal("", result.message, result.status);
                }
            }
        });
    });
}
