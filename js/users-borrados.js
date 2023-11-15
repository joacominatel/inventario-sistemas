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