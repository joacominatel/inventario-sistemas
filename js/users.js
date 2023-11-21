$(document).ready(function () {
  $('input[type="search"]').on("keyup", function () {
    var query = $(this).val();
    if (query.length >= 3) {
      $.ajax({
        url: "./php/search_user.php",
        method: "GET",
        data: { search: query },
        success: function (data) {
          $("#search-results").html(data);
        },
      });
    } else {
      $("#search-results").html("");
    }
  });
});

let buttonCreateUser = document.getElementById("add-user");

buttonCreateUser.addEventListener("click", () => {
  document.getElementById("form-create-user").style.display = "block";
  window.onclick = function (event) {
    if (event.target == document.getElementById("form-create-user")) {
      document.getElementById("form-create-user").style.display = "none";
    }
  };
});

$(document).ready(function () {
  $("#form-create-user").on("submit", function (e) {
    e.preventDefault();

    var password = prompt("Ingresa la contraseña de administrador");
    if (password === "global") {
      $.ajax({
        url: "php/insertar.php",
        type: "post",
        data: $("#form-create-user form").serialize(),
        success: function (response) {
          $("#form-post-button")
            .val("Enviado correctamente")
            .css("background-color", "green")
            .removeClass("button-error") // En caso de que previamente se haya mostrado un error
            .addClass("button-animation");
          setTimeout(function () {
            // Después de 1.4 segundos, se cierra el form y se resetea
            $("#form-post-button")
              .val("Enviar")
              .css("background-color", "#007bff")
              .removeClass("button-animation");
          }, 1400);
          setTimeout(function () {
            document.getElementById("form-create-user").style.display = "none";
          }, 1400);
        },
        error: function (xhr, status, error) {
          console.error(error);
          $("#form-post-button")
            .val("Error: intenta más tarde")
            .css("background-color", "red")
            .addClass("button-error")
            .removeClass("button-animation");
        },
      });
    } else {
      alert("Contraseña incorrecta");
    }
  });
});

let closeButton = document.getElementsByClassName("fa-xmark");

for (let i = 0; i < closeButton.length; i++) {
  closeButton[i].addEventListener("click", () => {
    document.getElementById("form-create-user").style.display = "none";
  });
}

$(document).on("click", ".fa-trash-alt", function () {
  // Obtener los detalles del usuario
  let userInfo = $(this).closest(".search-result-item").find("span").text();
  let [nombre, apellido, workdayId] = userInfo
    .match(/(.*) (.*) \((\d+)\)/)
    .slice(1);

  let confirmDelete = confirm(
    `¿Seguro que deseas borrar el usuario ${nombre} ${apellido} (${workdayId})?`
  );
  workdayId = [workdayId];

  var password = prompt("Ingresa la contraseña de administrador");
  if (password === "global") {
    try {
      if (confirmDelete) {
        $.ajax({
          url: "php/delete_user.php",
          type: "post",
          data: { workday_id: workdayId },
          success: function (response) {
            alert(response);
          },
          error: function (xhr, status, error) {
            console.error(error);
          },
        });
      }
    } catch (error) {
      console.error(error);
    }
  } else {
    alert("Contraseña incorrecta");
  }
});

$(document).on("click", ".fa-edit", function () {
  let workdayId = $(this)
    .closest(".search-result-item")
    .find("span")
    .text()
    .match(/\((\d+)\)/)[1];

  $.ajax({
    url: "php/buscar.php",
    type: "post",
    data: { workday_id: workdayId },
    success: function (response) {
      let userData = JSON.parse(response);

      // Cargar los datos en el formulario de edición
      $("#edit-workday_id").val(userData.workday_id);
      $("#edit-nombre").val(userData.nombre);
      $("#edit-apellido").val(userData.apellido);
      $("#edit-marca").val(userData.marca);
      $("#edit-modelo").val(userData.modelo);
      $("#edit-serie").val(userData.serie);
      $("#edit-mail").val(userData.mail);
      $("#edit-usuario").val(userData.usuario);

      $("#editUserModal").show();
    },
    error: function (xhr, status, error) {
      console.error(error);
      alert("Error al obtener los datos del usuario");
    },
  });
});

$("#updateUser").on("click", function () {
  let userData = $("#editUserForm").serialize();
  var password = prompt("Ingresa la contraseña de administrador");
  if (password === "global") {
    $.ajax({
      url: "php/update_user.php",
      type: "post",
      data: userData,
      success: function (response) {
        alert(response);
        $("#editUserModal").hide();
      },
      error: function (xhr, status, error) {
        console.error(error);
      },
    });
  } else {
    alert("Contraseña incorrecta");
  }
});

$("#cancelUpdate").on("click", function () {
  $("#editUserModal").hide();
});

$(document).on("click", "#return-user", function () {
  let workdayId = $(this)
    .closest(".search-result-item")
    .find("span")
    .text()
    .match(/\((\d+)\)/)[1];

  if (
    confirm(
      `¿Deseas devolver al usuario con ID ${workdayId} a la lista de usuarios activos?`
    )
  ) {
    $.ajax({
      url: "php/return_user.php",
      type: "post",
      data: { workday_id: workdayId },
      success: function (response) {
        alert(response);
      },
      error: function (xhr, status, error) {
        console.error(error);
      },
    });
  }
});

document.getElementById("delete-user").addEventListener("click", function () {
  let selectedCheckboxes = document.querySelectorAll(".user-checkbox:checked");
  let workday_id = Array.from(selectedCheckboxes).map(
    (checkbox) => checkbox.value
  );

  if (confirm(`¿Deseas eliminar ${workday_id.length} usuarios?`)) {
    var password = prompt("Ingresa la contraseña de administrador");
    if (password === "global") {
      $.ajax({
        url: "php/delete_user.php",
        type: "post",
        data: { workday_id: workday_id },
        success: function (response) {
          alert(response);
        },
        error: function (xhr, status, error) {
          console.error(error);
        },
      });
    } else {
      alert("Contraseña incorrecta");
    }
  }
});
