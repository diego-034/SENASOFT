function init_select2() {
    $('.select2-costumers').select2({ placeholder: "Seleccionar" });
}

function saveTemp(value, name){
    $.ajax({
        url: '[URL_TMP]',
        type: 'POST',
        data: {value, name},
        success: function(res){
            console.log(res)
        }
    })
}

function updateQuantity(element){
    var contentItem = $(element).parents('[data-repeater-item]');

    var quantity = parseInt(element.value);
    var price = parseFloat(contentItem.find('.select2-products option:selected').attr('data-price'));
    var iva = parseFloat(contentItem.find('.select2-products option:selected').attr('data-iva'));

    var sub
    contentItem.find('.info-price').html('$ '+ (quantity*price));
    contentItem.find('.info-price').html('$ '+ (quantity*iva));
    console.log(quantity, price)
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

function AddCar() {
    let flag = true;
    let count = 0;
    let product = {
        id: $("#product").val(),
        quantity: $("#quantity").val(),
        total: $("#total").val()
    };
    do {
        if (localStorage.getItem("product_" + count)) {
            count++;
        } else {
            localStorage.setItem("product_" + count, JSON.stringify(product));
            flag = false;
        }
    } while (flag);
    let content = `<tr id="row_${count}">
        <td>${$('#product option:selected').text()}</td>
        <td>${product.quantity}</td>
        <td>${product.total}</td>
        <td>
            <span class = "material-icons ico-red ml-3" onclick="Remove(${count})" >
            delete </span>
        </td>
    </tr>`;
    $("tbody").append(content);
    let total = $("#totalInvoice").val();
    let value = parseFloat(total) + parseFloat($("#total").val());
    $("#totalInvoice").val(value);
    $("#product").val("");
    $("#product").trigger("change");
    $("#quantity").val(0);
    $("#subtotal").val(0);
    $("#price").val(0);
    $("#discount").val(0);
    $("#total").val(0);
    Hide();
}
$("#product").on("change", function() {
    if (this.value == "") {
        return;
    }
    var url =
        location.protocol + "//" + location.host + "/NewImperial/products/find";
    var form = new FormData();
    form.append("id", this.value);
    fetch(url, {
            method: "POST",
            body: form,
        })
        .then((res) => res.json())
        .catch((error) => console.error("Error:", error))
        .then(function(response) {
            stock = response.OK[0].Cantidad;
            $("#price").val(response.OK[0].Precio);
        });
});
