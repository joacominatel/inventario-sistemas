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