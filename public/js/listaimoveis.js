$(function () {
    $(document).ready(function() {
        var token = $("input[name='_token']").val();
        var table = $('#tableImoveis').DataTable( {
            "processing": true,
            "serverSide": true,
            "lengthMenu": [1,5, 10, 25, 50, 75, 100 ],
            "pageLength": 10,
            "language": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar por Código",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }

            },
            "ajax": {
                url: "/admin/imoveis/listaimoveis",
                type: 'POST',
                data:{_token:token}
            },
            columnDefs: [
                {
                    targets: 6,
                    render: function(data) {
                        if(data.length) {
                            return '<img src="' + data + '" class="img-thumbnail" >'
                        }
                        return "";
                    }
                },
                {
                    "targets": [ 0 ],
                    "visible": false,
                    "searchable": false
                }
            ]
        } );
        $('#tableImoveis tbody').on('click', 'tr', function () {
            var data = table.row( this ).data();
            window.location = ("/admin/imoveis/"+data[0]+"/edit");
        } );
    } );


});