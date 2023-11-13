const fechaActual = new Date().toISOString().slice(0, 10);
const camposFechaDevolucion = document.querySelectorAll('#fecha-devolucion');
camposFechaDevolucion.forEach(campo => campo.value = fechaActual);

// func to add a new row to the table
function addRow() {
    const row = document.createElement('tr');
    row.innerHTML = `
        <td contenteditable='true'></td>
        <td contenteditable='true'></td>
        <td contenteditable='true'><input type='date' value='${fechaActual}' name='fecha-devolucion' id='fecha-devolucion'></td>
        <td id='delete-button' ><button onclick='deleteRow()' class="delete-row">X</button></td>
    `;

    // append row to table
    document.querySelector('.tabla-equipo').lastElementChild.appendChild(row);
    document.querySelector('#fecha-devolucion').value = fechaActual;
}

function deleteRow() {
    if (document.querySelectorAll('.tabla-equipo tr').length > 2) {
        document.querySelector('.tabla-equipo tbody').lastElementChild.remove();
    }
}