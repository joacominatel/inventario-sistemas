$(document).ready(function () {
  $("#search").on("input", function () {
    var search = $(this).val();
    if (search !== "") {
      $.ajax({
        url: "../api/rrhh/search.php",
        type: "POST",
        data: { search: search },
        success: function (response) {
          $("#resultados").html(response);
        },
      });
    } else {
      $("#resultados").html("");
    }
  });
});

function copiarAlPortapapeles(texto) {
  const elementoTemp = document.createElement("textarea");
  elementoTemp.value = texto;

  document.body.appendChild(elementoTemp);
  elementoTemp.select();

  document.execCommand("copy");
  document.body.removeChild(elementoTemp);

  const cartel = document.getElementById("copiadoCartel");
  cartel.classList.add("active");

  mostrarMensaje("Copiado al portapapeles");
}

function mostrarMensaje(mensaje) {
  const cartel = document.getElementById("copiadoCartel");
  cartel.style.display = "block";

  setTimeout(function () {
    cartel.style.display = "none";
  }, 1500);

  console.log(mensaje);
}

function abrirModal(workday_id) {
  var modal = document.getElementById('modal-' + workday_id);
  modal.style.display = 'block';
}

function cerrarModal(workday_id) {
  var modal = document.getElementById('modal-' + workday_id);
  modal.style.display = 'none';
}

var verMasButtons = document.getElementsByClassName('btn-verMas');
var cerrarButtons = document.getElementsByClassName('close');

for (var i = 0; i < verMasButtons.length; i++) {
  verMasButtons[i].addEventListener('click', function (event) {
      var workday_id = event.target.getAttribute('data-workday_id');
      abrirModal(workday_id);
  });
}

for (var i = 0; i < cerrarButtons.length; i++) {
  cerrarButtons[i].addEventListener('click', function (event) {
      var workday_id = event.target.getAttribute('data-workday_id');
      cerrarModal(workday_id);
  });
}

window.onclick = function(event) {
  if (event.target.className == 'modal') {
      event.target.style.display = 'none';
  }
}