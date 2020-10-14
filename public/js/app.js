function init_ajax_current_projet() {
    $('#ajax_current_projet').on('change', function () {
        // motrar cargando....
        $.ajax({
            url: $(this).attr('data-ajax-url'),
            type: 'POST',
            data: {value: $(this).val()},
            success: function (res) {
                if (res) {
                    window.location.reload();
                }
                // ocultar cargando..
            }
        });
    });
}

function init_config() {
    $.ajaxSetup({
        headers: {
            'X-Csrf-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });
}

$(document).ready(function () {
    init_config();
    init_ajax_current_projet();
});
