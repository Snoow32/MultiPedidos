<style>
    #order-field{
        height:54em;
        overflow:auto;
    }
    .order-list{
        height:18em;
        overflow:auto;
        position:relative;
    }
    .order-list-header{
        position:sticky;
        top:0;
        z-index:2 !important;
    }
    .order-body{
        position:relative;
        z-index:1 !important;
    }
    #order-field:empty{
        display:flex;
        align-items:center;
        justify-content:center;
    }
    #order-field:empty:after{
        content:"Nenhum pedido está na fila.";
        color: #b7b4b4;
        font-size: 1.7em;
        font-style: italic;
    }
</style>
<div class="content bg-gradient-warning py-3 px-4">
    <h3 class="font-weight-bolder text-light">Ordem dos pedidos</h3>
</div>
<div class="row mt-n4 justify-content-center">
    <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12">
        <div class="card rounded-0">
            <div class="card-body">
                <div id="order-field" class="row row-cols-lg-3 rol-cols-md-2 row-cols-sm-1 gx-2 py-1"></div>
            </div>
        </div>
    </div>
</div>
<noscript id="order-clone">
<div class="col order-item">
    <div class="card rounded-0 shadow card-outline card-warning">
        <div class="card-header py-1">
            <div class="card-title"><b>Queue Code: 10001</b></div>
        </div>
        <div class="card-body">
            <div class="order-list">
                <div class="d-flex w-100 order-list-header bg-gradient-warning">
                    <div class="col-9 m-0 border"><b>Produto</b></div>
                    <div class="col-3 m-0 border text-center">QTY</div>
                </div>
                <div class="order-body">
                </div>
            </div>
        </div>
        <div class="card-footer py-1 text-center">
                <button class="btn btn-sm btn-light bg-gradient-light border order-served px-2 btn-block rounded-pill btn-send" type="button" data-id="" ></button>
        </div>
    </div>
</div>
</noscript>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    function get_order() {
        listed = [];
        $('.order-item').each(function () {
            listed.push($(this).attr('data-id'));
        });
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=get_order",
            method: 'POST',
            data: { listed: listed },
            dataType: 'json',
            error: err => {
                console.log(err);
                alert_toast("Algo deu errado", "error");
            },
            success: function (resp) {
                if (resp.status == 'success') {
                    Object.keys(resp.data).map(k => {
                        var data = resp.data[k];
                        var card = $($('noscript#order-clone').html()).clone();
                        card.attr('data-id', data.id);
                        card.find('.card-title').text('Fila n° #' + data.queue);
                        Object.keys(data.item_arr).map(i => {
                            var productNames = data.item_arr[i].product_name;
                            var quantities = data.item_arr[i].quantity;
                            for (var j = 0; j < productNames.length; j++) {
                                var row = card.find('.order-list-header').clone().removeClass('order-list-header bg-gradient-warning');
                                row.find('div').first().text(productNames[j]);
                                row.find('div').last().text(quantities[j]);
                                card.find('.order-body').append(row);
                            }
                        });
                        card.find('.order-served').attr('data-status-info', data.status_info);
                        var statusInfo = data.status_info;
                        var menvio_status = data.menvio;
                        card.find('.order-served').text(statusInfo);
                        $('#order-field').append(card);
                        card.find('.order-served').one('click', function () {
                            $(this).text('Pedido Pronto');
                            serve_order(data.id);
                            if (data.status_info === 'Aceitar pedido') {
                                open_receipt(data.id);
                                pedido_aceito(data.id);
                            }
                            if (data.status_info === 'Pedido pronto' && data.menvio === 'RETIRAR') {
                                pedido_retirar(data.id);
                            }
                            if (data.status_info === 'Pedido pronto' && data.menvio === 'ENTREGA') {
                                pedido_entrega(data.id);
                            }
                        });
                    });
                }
            }
        });
    }

    function serve_order($id) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=serve_order",
            method: "POST",
            data: { id: $id },
            dataType: "json",
            error: err => {
                console.log(err);
                alert_toast("Algo deu errado.", 'error');
                end_loader();
            },
            success: function (resp) {
                if (typeof resp === 'object' && resp.status === 'success') {
                    $('.modal').modal('hide');
                    $('.order-item[data-id="' + $id + '"]').remove();
                    alert_toast("O pedido foi " + resp.status_order + ".", 'success');
                    } else {
                        alert_toast("Algo deu errado.", 'error');
                    }
                    end_loader();
                }
        });
    }

    function open_receipt(id) {
        var width = window.innerWidth * 0.8;
        var height = window.innerHeight * 0.8;
        var left = window.innerWidth * 0.1;
        var top = window.innerHeight * 0.1;

        var nw = window.open(_base_url_ + "admin/kitchen/receipt.php?id=" + id, '_blank', "width=" + width + ",left=" + left + ",height=" + height + ",top=" + top);

        setTimeout(function() {
            nw.onload = function () {
                nw.print();
                setTimeout(function () {
                    nw.onafterprint = function () {
                        nw.close();
                    }
                    nw.onafterprint();
                }, 1000);
            };
        }, 200);
    }
    
    function pedido_aceito(id) {
        const url = '';
        const token = '';

        function enviarMensagem(dados) {
            const nome = dados.nome;
            const telmsg = dados.tel;
            const telefoneFormatado = telmsg.slice(2);
            const telefoneFormatadoFinal = `(${telefoneFormatado.slice(0, 2)}) ${telefoneFormatado.slice(2, 6)}-${telefoneFormatado.slice(6)}`;
            const endereco = dados.endereco;
            const queue = dados.queue;
            const created_at = dados.created_at;
            const currentDate = new Date(created_at);
            const formattedDate = currentDate.getHours().toString().padStart(2, '0') + ':' +
            currentDate.getMinutes().toString().padStart(2, '0') + ' ' +
            currentDate.getDate().toString().padStart(2, '0') + '/' +
            (currentDate.getMonth() + 1).toString().padStart(2, '0') + '/' +
            currentDate.getFullYear();
            const product_name = dados.product_name;
            const quantity = dados.quantity;
            const quantityFormatted = quantity.split(',').map(qty => `${qty.trim()}x`);
            const productLine = quantityFormatted.map((qty, index) => `${qty} ${product_name.split(',')[index].trim()}`).join('\n');
            const method = dados.method;
            const observacao = dados.observacao;
            const total_valor_total = dados.total_valor_total;
            const taxa = dados.taxa;
            const desconto = dados.desconto;
            const menvio = dados.menvio;
            const message = `*Olá ${nome}, seu pedido foi aceito.*
_________________________
Pedido numero #00${queue}
Forma de envio: ${menvio}
____________________________

Pedido feito as:  ${formattedDate}
Cliente:  ${nome}
Telefone:  ${telefoneFormatadoFinal}
Endereço:  ${endereco}
Qtd. Pedidos na frente: 0
____________________________
Itens do pedido
${productLine}
____________________________
Forma de pagamento:  ${method} 
Observações:  ${observacao}

Subtotal:  R$ ${total_valor_total}
Taxa de Entrega:  R$ ${taxa}

Desconto:  R$ ${desconto}
TOTAL:  R$ ${total_valor_total}
____________________________

O tempo estimado é de 15-45 min.

Obrigado pela preferencia ❤️
____________________________`;

            const requestData = {
                number: telmsg,
                token: token,
                message: message
            };

            $.ajax({
                url: url,
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify(requestData),
                success: function(response) {
                },
                error: function(error) {
                }
            });
        }
        $.ajax({
            url: _base_url_ + "admin/kitchen/dados.php",
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                let mensagensEnviadas = false;

                data.forEach((item) => {
                    enviarMensagem(item);
                    location.reload();
                });

                mensagensEnviadas = true;
            },
            error: function (error) {
                console.log("Erro ao obter os dados:", error);
            }
        });
    }

    function pedido_entrega(id) {
        const url = '';
        const token = '';
    
        function enviarMensagem(dados) {
            const number = dados.tel;
            const message = `Seu pedido esta pronto e o motoboy ja entregara em breve.`;
    
            const requestData = {
                number: number,
                token: token,
                message: message
            };
    
            $.ajax({
                url: url,
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify(requestData),
                success: function(response) {
                },
                error: function(error) {
                }
            });
        }
    
        $.ajax({
            url: _base_url_ + "admin/kitchen/dados.php",
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                let mensagensEnviadas = false;
    
                data.forEach((item) => {
                    enviarMensagem(item);
                });
    
                mensagensEnviadas = true;
            },
            error: function (error) {
                console.log("Erro ao obter os dados:", error);
            }
        });
    }

    function pedido_retirar(id) {
        const url = '';
        const token = '';
    
        function enviarMensagem(dados) {
            const number = dados.tel;
            const message = `Seu pedido esta pronto para retirar.`;
    
            const requestData = {
                number: number,
                token: token,
                message: message
            };
    
            $.ajax({
                url: url,
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify(requestData),
                success: function(response) {
                },
                error: function(error) {
                }
            });
        }
    
        $.ajax({
            url: _base_url_ + "admin/kitchen/dados.php",
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                let mensagensEnviadas = false;
    
                data.forEach((item) => {
                    enviarMensagem(item);
                });
    
                mensagensEnviadas = true;
            },
            error: function (error) {
                console.log("Erro ao obter os dados:", error);
            }
        });
    }

    $(function () {
        $('body').addClass('sidebar-collapse');
        var load_data = setInterval(() => {
            get_order();
    }, 500);

    $('.order-served').one('click', function () {
        $(this).text('Pedido Pronto');
        serve_order(data.id);
        if (data.status_info === 'Aceitar pedido') {
            open_receipt(data.id);
            pedido_aceito(data.id);
        }
        if (data.status_info === 'Pedido pronto' && data.menvio === 'RETIRAR') {
            pedido_retirar(data.id);
        }
        if (data.status_info === 'Pedido pronto' && data.menvio === 'ENTREGA') {
            pedido_entrega(data.id);
        } 
    });
});
</script>