function init_select2() {
    $('#select2-rol').select2({ placeholder: "Seleccionar" });
    $('#select2-branch').select2({ placeholder: "Seleccionar" });
}


$(document).ready(function() {
    init_select2();
});