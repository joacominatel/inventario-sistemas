$(document).ready(function () {
  $('input[type="search"]').on("keyup", function () {
    var query = $(this).val();
    if (query.length >= 3) {
      $.ajax({
        url: "./php/search_deleted_user.php",
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

document.addEventListener('click', function(event) {
  if (event.target.classList.contains('return-user')) {
      const workdayId = event.target.getAttribute('data-user-id');
      if (workdayId && confirm('¿Quieres devolver este usuario a la tabla principal?')) {
          var password = prompt("Por favor, ingresa la contraseña para continuar:");
          if (password === "global") {
              var xhr = new XMLHttpRequest();
              xhr.open("POST", "php/return_user.php", true);
              xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
              xhr.onload = function() {
                  if (this.status == 200) {
                      console.log(this.responseText);
                  }
              };
              xhr.send("workday_id=" + workdayId);
          } else {
              alert("Contraseña incorrecta.");
          }
      }
  }
});
