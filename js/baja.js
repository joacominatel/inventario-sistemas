const fechaActual = new Date().toISOString().slice(0, 10);
const camposFechaDevolucion = document.querySelectorAll('#fecha-devolucion');
camposFechaDevolucion.forEach(campo => campo.value = fechaActual);