<?php if ($_settings->chk_flashdata('success')): ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>
<style>
    .order-logo {
        width: 3em;
        height: 3em;
        object-fit: cover;
        object-position: center center;
    }
</style>
<div class="card card-outline rounded-0 card-warning">
    <div class="card-header">
        <h3 class="card-title">Lista de pedidos</h3>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <table class="table table-hover table-striped table-bordered" id="list">
                <colgroup>
                    <col width="5%">
                    <col width="15%">
                    <col width="15%">
                    <col width="15%">
                    <col width="20%">
                    <col width="15%">
                    <col width="10%">
                </colgroup>
                <thead>
                    <tr> 
                        <th>ID</th>
                        <th>Data do pedido</th>
                        <th>Nome do cliente</th>
                        <th>Telefone</th>
                        <th>Valor total</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $uwhere = "";
                    if ($_settings->userdata('type') != '1')
                        $uwhere = " where user_id = '{$_settings->userdata('id')}' ";

                    $qry = $conn->query("SELECT * FROM `carrinho`");
                    while ($row = $qry->fetch_assoc()) :
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td class=""><?= $row['created_at'] ?></td>
                            <td class=""><?= $row['nome'] ?></td>
                            <td class=""><?= '(' . substr($row['tel'], 2, 2) . ') ' . substr_replace(substr($row['tel'], 4), '-', 4, 0) ?></td>
                            <td class=""><?= format_num($row['total_valor_total'], 2) ?></td>
                            <td class="text-center">
                                <?php
                                switch ($row['status']) {
                                    case 0:
                                        echo '<span class="badge badge-primary border-gradient-primary px-3 border">Pendente</span>';
                                        break;
                                    case 1:
                                        echo '<span class="badge badge-success border-gradient-success px-3 border">Aceito</span>';
                                        break;
                                    case 2:
                                        echo '<span class="badge badge-success border-gradient-sucess px-3 border">Entregue</span>';
                                        break;
                                    default:
                                        echo '<span class="badge badge-light border-gradient-light border px-3 border">Cancelado</span>';
                                        break;
                                }
                                ?>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <a class="btn btn-flat btn-sm btn-light bg-gradient-light border view_receipt" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>" title="Print Receipt"><small><span class="fa fa-receipt"></span></small></a>
                                    <a class="btn btn-flat btn-sm btn-danger bg-gradient-danger delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>" title="Delete Order"><small><span class="fa fa-trash"></span></small></a>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
	$(document).ready(function() {
    $('.delete_data').click(function() {
        var id = $(this).attr('data-id');
        if (confirm("Você tem certeza que deseja excluir permanentemente?")) {
            delete_order(id);
            pedido_cancelado();
        }
    });

    $('.view_receipt').click(function(e) {
        e.stopPropagation();
        var nw = window.open(_base_url_+"admin/orders/receipt.php?id="+$(this).attr('data-id'), '_blank', "width="+($(window).width() * .8)+",left="+($(window).width() * .1)+",height="+($(window).height() * .8)+",top="+($(window).height() * .1))
        setTimeout(() => {
            nw.print();
            setTimeout(() => {
                nw.close();
            }, 300);
        }, 200);
    });

    $('.table').dataTable({
        columnDefs: [
            { orderable: false, targets: [5] }
        ],
        order:[0,'asc']
    });

    $('.dataTable td, .dataTable th').addClass('py-1 px-2 align-middle');
});

function delete_order($id) {
    start_loader();
    $.ajax({
        url: _base_url_+"classes/Master.php?f=delete_order",
        method: "POST",
        data: { id: $id },
        dataType: "json",
        error: err => {
            console.log(err);
            alert_toast("Algo deu errado.", 'error');
            end_loader();
        },
        success: function(resp) {
            if (typeof resp === 'object' && resp.status === 'success') {
                location.reload();
            } else {
                alert_toast("Algo deu errado.", 'error');
                end_loader();
            }
        }
    });
}

function pedido_cancelado(id) {
    const url = '';
    const token = '';

    function enviarMensagem(dados) {
        const number = dados.tel;
        const message = `Desculpe, seu pedido foi cancelado. Entre em contato com o estabelecimento.`;

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
        url: _base_url_ + "admin/orders/dados.php",
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

</script>
