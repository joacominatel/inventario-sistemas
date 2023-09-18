$(document).ready(function(){
    $('#search').keyup(function(){
        var search = $(this).val();
        if(search != ""){
            $.ajax({
                url:'../api/rrhh/search.php',
                type:'POST',
                data:{search:search},
                success:function(response){
                    $('#resultados').html(response);
                }
            });
        }else{
            $('#resultados').html('');
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