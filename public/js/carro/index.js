
search = (selected=null) => {

    $.ajax({
        type: "GET",
        url: '/carro/modelos?marcas='+$('#marcas').val(),
        success: function (data) {

            $("#modelos option").remove()

            data.map(function(modelo){
                $("#modelos").append(`<option ${selected && selected.includes(String(modelo['id'])) ? 'selected' : ''} value="${modelo['id']}">${modelo['nome']}</option>`)
            })

            $('#modelos').selectpicker('refresh');
        },
    })

}

$(document).ready(function() {
    $('.selectpicker').selectpicker();

    if($('#marcas').val()){
        var oldmodelos = JSON.parse($('#modelos').attr('oldvalues'))
        search(oldmodelos)
    }

    $('#marcas').on('change', function(){
        if($(this).val()){
            var modelos = $("#modelos").val()
            search(modelos)
        }
    });  

});