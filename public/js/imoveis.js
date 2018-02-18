var Imoveis = {
    remover: function (url) {
        $('#form').attr('action', url);
        $("input[name='_method']").val("DELETE");
        $('#form').submit();
    },
    consultaCep: function () {
        var cep = $("#cep").val();
        var token = $("input[name='_token']").val();
        $.ajax({
            type: "POST",
            url: "/admin/imoveis/consultacep",
            data: {"cep":cep,_token:token},
            success: Imoveis.callBackConsultaCep,
            dataType: "json"
        });
    },
    callBackConsultaCep: function(response){
        $("#logradouro").val(response.logradouro);
        $("#bairro").val(response.bairro);
        $("#cidade").val(response.localidade);
        $("#estado").val(response.uf);
    }
}

$(function () {
    $("#cep").mask("99999-999");
    $("#cep" ).on('blur',function() {
        if($(this).val().length == 9){
            Imoveis.consultaCep();
        }
    });
    $('#valor').maskMoney({
        allowNegative: false,
        thousands: '.',
        decimal: ',',
        affixesStay: false
    });
    $("#numero").numeric();
    $("#areaimovel").numeric();
    $("#numbanheiros").numeric();
    $("#numgaragem").numeric();
    $("#numquartos").numeric();
    $("#numsalas").numeric();
    $("#numsuites").numeric();
});