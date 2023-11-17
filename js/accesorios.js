$(document).ready(function() {
    $('.accesorios-item').on('click', function() {
        var tipoAccesorio = $(this).data('accesorio');
        cargarAccesorios(tipoAccesorio);
    });
});

function cargarAccesorios(tipoAccesorio) {
    var data = tipoAccesorio === 'otros' ? { accesorio: ['mouse', 'otros', 'silla'] } : { accesorio: tipoAccesorio };

    $.ajax({
        url: 'php/load_accesories.php', 
        type: 'post',
        data: data,
        success: function(response) {
            console.log(response);
            var accesorios = JSON.parse(response);
            var html = '';
            accesorios.forEach(function(accesorio) {
                html += '<tr>' +
                            '<td>' + accesorio.workday_id + '</td>' +
                            '<td>' + accesorio.nombre + '</td>' +
                            '<td>' + accesorio.accesorio + '</td>' +
                            '<td>' + accesorio.detalle + '</td>' +
                        '</tr>';
            });
            $('#bottom-data-accesorios').html(html);
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}

// Form de agregar accesorio
let btnAddAccessory = document.getElementById('add-accessory');

btnAddAccessory.addEventListener('click', function() {
    let formAddAccessory = document.getElementById('agregar-accesorio');
    formAddAccessory.style.display = 'block';

    let closeFormAddAccessory = document.getElementById('close-add-accessory');
    
    closeFormAddAccessory.addEventListener('click', function() {
        let formAddAccessory = document.getElementById('agregar-accesorio');
        formAddAccessory.style.display = 'none';
    });
});

$(document).ready(function() {
    $('.form-agregar-accesorio').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: 'php/add_accesory.php',
            type: 'post',
            data: $(this).serialize(), 
            success: function(response) {
                alert('Accesorio agregado con éxito');
                let formAddAccessory = document.getElementById('agregar-accesorio');
                formAddAccessory.style.display = 'none';
                // Limpiar campos
                $('#workday_id').val('');
                $('#nombre').val('');
                $('#accesorio').val('');
                $('#detalle').val('');

            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
});