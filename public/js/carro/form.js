
$("#carro_placa").mask("SSS-0000")

search = (selected=null) => {

    $.ajax({
        type: "GET",
        url: '/carro/modelos?marcas='+$('#marca').val(),
        success: function (data) {

            $("#carro_modelo option").remove()
            
            $("#carro_modelo").append(`<option value="">Selecione uma opção</option>`)

            data.map(function(modelo){
                $("#carro_modelo").append(`<option ${selected && selected == String(modelo['id']) ? 'selected' : ''} value="${modelo['id']}">${modelo['nome']}</option>`)
            })

        },
    })

}

$(document).ready(function() {
    $('.selectpicker').selectpicker();

    if($('#marca').val()){
        search($('#marca').attr('oldmodelo'))
    }else{
        $("#carro_modelo option").remove()
            
        $("#carro_modelo").append(`<option value="">Selecione uma opção</option>`)
    }

    $('#marca').on('change', function(){
        search()
    });  

    $('#form').validate({
        rules: {			
            "carro[placa]":{
                required: true,
                validaPlaca: true,
            },
            "carro[proprietario]":{
                required: true,
            },
            "marca":{
                required: true,
            },
            "carro[modelo]":{
                required: true,
            },
        },
        messages:{}
    })

    $(".sendForm").on("click",function() {
        if($("#form").valid())
            $("#form").submit()
    })

});