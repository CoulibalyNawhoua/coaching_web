function AjaxQueryJSFileSweet(id_form, load = '') {

    $('.id_form').submit(function (e) {

        e.preventDefault();

        var form = new FormData($(this)[0]);

        var buttonDefault = $('#id_form').text();
        var button = $('#id_form');

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
                    // <?= $load ?>

                } else {
                    swal("", result.message, result.status);
                }


            }
        });

    });
}

function deleted(id, link) {
    swal({
        title: "Êtes-vous sûr?",
        text: "Voulez-vous vraiment supprimer cet élément?",
        icon: "warning",
        buttons: ["Annuler", "Oui"],
        dangerMode: true,
    }).then((willDelete) => {
        var Id = id;
        if (willDelete) {
            $.ajax({
                type: 'POST',
                url: link,
                data: { id: Id },
                dataType: 'json',
                success: function (result) {
                    swal("", result.message, result.status);
                    if (result.status === 'success') {
                        window.location.reload();
                    }
                },
            });
        }
    });
}

