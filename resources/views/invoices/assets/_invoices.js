function deleteItem(ID) {
    $.confirm({
        title: null,
        content: '¿Realmente desea eliminar este registro?',
        buttons: {
            delete: {
                text: 'Eliminar',
                btnClass: 'btn-danger',
                action: function() {
                    // Ajax para eliminar el registro
                    $.ajax({
                        url: `[URL_DELETE]/${ID}`,
                        type: 'DELETE',
                        success(res) {
                            if (res) {
                                $.alert('Registro eliminado!');
                                table.ajax.reload();
                            } else
                                $.alert('Error al intentar eliminar el usuario, por favor contactar con su administrador.');
                        }
                    });
                }
            },
            cancelar() {},
        }
    });
}

/* Cuando el documento termine de cargar */
$(document).ready(function() {
    window['table'] = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        language: { url: '[URL_ES]' },
        ajax: {
            url: '[PATH_AJAX]',
            type: 'POST',
            dataType: 'json',
            data(d) {
                return JSON.stringify(d);
            }
        },
        columnDefs: [
            { "className": "text-center text-capitalize", "targets": [0, 5] },
            { "className": "text-left text-capitalize", "targets": [1, 2, 3, 4] },
        ],
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'email' },
            {
                data: function(item) {
                    return item.pros ? item.pros : 'Sin proyecto';
                }
            },
            {
                data: function(item) {
                    return item.rol;
                }
            },
            {
                data(data) {
                    return `<a href="[URL_FORM]/${data.id}" class="btn btn-sm btn-outline-dark" title="Actualizar"><i class="fas fa-pencil-alt"></i></a>
                            <a href="javascript:void(0);" onclick="deleteItem(${data.id})" class="btn btn-sm btn-outline-dark" title="Eliminar"><i class="fas fa-trash"></i></a>`;
                }
            }
        ]
    });
});