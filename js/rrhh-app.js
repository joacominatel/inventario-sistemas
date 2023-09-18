$(document).ready(function () {
  $("#search").keyup(function () {
    var search = $(this).val();
    if (search != "") {
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

function copiarAlPortapapeles(texto, elemento) {
  const elementoTemp = document.createElement("textarea");
  elementoTemp.value = texto;
  document.body.appendChild(elementoTemp);
  elementoTemp.select();
  document.execCommand("copy");
  document.body.removeChild(elementoTemp);

  const cartel = document.getElementById("copiadoCartel");
  cartel.style.display = "block";

  setTimeout(function () {
    cartel.style.display = "none";
  }, 1500);
}

function borrarUsuario(workday_id) {
  if (
    confirm(
      "¿Estás seguro de que quieres borrar el usuario " + workday_id + "?"
    )
  ) {
    // Borrar usuario
    $.ajax({
      url: "../api/rrhh/borrar_user.php",
      type: "POST",
      data: { workday_id: workday_id },
      success: function (response) {
        if (response == 0) {
          alert("No se ha podido borrar el usuario");
          setTimeout(function () {
            location.reload();
          }, 2000);
        } else {
          alert("Usuario borrado correctamente");
          setTimeout(function () {
            location.reload();
          }, 2000);
        }
      },
    });
  }
}
