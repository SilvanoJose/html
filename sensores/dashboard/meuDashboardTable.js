$(document).ready(function(){
    carregarLeituras();

    $('#registros_por_pagina').change(function(){
        carregarLeituras();
    });

    $('#btn_pagina_anterior').click(function(){
        var offset = $('#offset').val();
        offset = parseInt(offset) - parseInt($('#registros_por_pagina').val());
        $('#offset').val(offset);
        carregarLeituras();
    });

    $('#btn_pagina_proxima').click(function(){
        var offset = $('#offset').val();
        offset = parseInt(offset) + parseInt($('#registros_por_pagina').val());
        $('#offset').val(offset);
        carregarLeituras();
    });

    // Função para atualizar as leituras a cada 5 segundos
    setInterval(function(){
        //console.log("Dentro da função de contar tempo:");
        carregarLeituras();
    }, 5000);

    function carregarLeituras() {
        var registrosPorPagina = $('#registros_por_pagina').val();
        var offset = $('#offset').val();
        console.log("Dentro da função carregarLeituras:");
        $.ajax({
            url: 'meuDashboardTable.php',
            method: 'GET',
            data: { registrosPorPagina: registrosPorPagina, offset: offset },
            success: function(response){
                var hiddenInputIndex = response.indexOf('<input type="hidden" id="total_registros"');
                // Separa a parte do response que contém a última leitura
                var ultimaLeituraPart = response.substring(0, hiddenInputIndex);
                
                // Atualiza a última leitura
                //$('#ultima_leitura').html(ultimaLeituraPart);
            
                // Atualiza a tabela de leituras
                $('#leituras_table').html(response);
            
                // Atualiza os contadores e botões de paginação
                var totalRegistros = parseInt($('#total_registros').val());
                var paginaAtual = Math.ceil(offset / registrosPorPagina) + 1;
                var totalPages = Math.ceil(totalRegistros / registrosPorPagina);
                $('#btn_pagina_anterior').prop('disabled', paginaAtual === 1);
                $('#btn_pagina_proxima').prop('disabled', paginaAtual === totalPages);
                $('#total_registros').text('Total de Registros: ' + totalRegistros);
            }
        });
    }
});

