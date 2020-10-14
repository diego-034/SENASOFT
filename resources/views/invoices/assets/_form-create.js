function init_select2() {
    $('.select2-costumers').select2({ placeholder: "Seleccionar" });
}

function init_repeater() {
    $(".repeater").repeater({
        defaultValues: {
            "status": 1,
        },
        show: function() {
            $(this).slideDown();
            $('.select2-products').select2({ placeholder: "Seleccionar" });
        },
        ready: function(e) {
            $('.select2-products').select2({ placeholder: "Seleccionar" });
        }
    });
}

function onChangeFile(element, event) {
    var FILE = element.files[0];
    var label = document.querySelector('[name="' + element.name + '"] + label');
    label.innerHTML = FILE.name;
    var output = document.querySelector('[name="' + element.name.replace('image', 'imagePreview') + '"]');
    console.log(output);
    output.src = URL.createObjectURL(event.target.files[0]);
}

function handleSubmit() {
    var element_saving = document.querySelector('.saving');
    element_saving.classList.remove('d-none');
    return true;
}

$(document).ready(function() {
    init_repeater();
    init_select2();
});
