<?php 
$date = isset($_GET['date']) ? $_GET['date'] : date("Y-m-d");
?>
<div class="content py-5 px-3 bg-gradient-warning">
    <h2>Historico</h2>
</div>
<div class="row flex-column mt-4 justify-content-center align-items-center mt-lg-n4 mt-md-3 mt-sm-0">
    <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12">
        <div class="card rounded-0 mb-2 shadow">
            <div class="card-body">
                <fieldset>
                    <legend>Filtro</legend>
                    <form action="" id="filter-form">
                        <div class="row align-items-end">
                            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="date" class="control-label">Escolha a data</label>
                                    <input type="date" class="form-control form-control-sm rounded-0" name="date" id="date" value="<?= $date ?>" required="required">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <button class="btn btn-sm btn-flat btn-primary bg-gradient-primary"><i class="fa fa-filter"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </fieldset>
            </div>
        </div>
    </div>
    <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12">
        <div class="card rounded-0 mb-2 shadow">
            <div class="card-header py-1">
                <div class="card-tools">
                    <button class="btn btn-flat btn-sm btn-light bg-gradient-light border text-dark" type="button" id="print"><i class="fa fa-print"></i> Print</button>
                </div>
            </div>
            <div class="card-body">
                <div class="container-fluid" id="printout">
                    <table class="table table-bordered">
                        <colgroup>
                            <col width="10%">
                            <col width="15%">
                            <col width="20%">
                            <col width="20%">
                            <col width="20%">
                            <col width="15%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="px-1 py-1 text-center">ID</th>
                                <th class="px-1 py-1 text-center">Horario</th>
                                <th class="px-1 py-1 text-center">Codigo da transação</th>
                                <th class="px-1 py-1 text-center">Numero na fila (trocar)</th>
                                <th class="px-1 py-1 text-center">Cliente</th>
                                <th class="px-1 py-1 text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $g_total = 0;
                            $i = 1;
                            $stock = $conn->query("SELECT * FROM `carrinho` where date(created_at) = '{$date}' order by abs(unix_timestamp(created_at)) asc");
                            while($row = $stock->fetch_assoc()):
                                $user = $conn->query("SELECT username FROM `users` where id= '{$row['user_id']}'");
                                $row['processed_by'] = "N/A";
                                if($user->num_rows > 0){
                                    $row['processed_by'] = $user->fetch_array()[0];
                                }
                                $g_total += $row['total_valor_total']; 
                            ?>
                            <tr>
                                <td class="px-1 py-1 align-middle text-center"><?= $i++ ?></td>
                                <td class="px-1 py-1 align-middle"><?= date("h:i", strtotime($row['created_at'])) ?></td>
                                <td class="px-1 py-1 align-middle"><?= $row['cart_id'] ?></td>
                                <td class="px-1 py-1 align-middle"><?= $row['queue'] ?></td>
                                <td class="px-1 py-1 align-middle"><?= $row['nome'] ?></td>
                                <td class="px-1 py-1 align-middle text-right"><?= $row['total_valor_total'] ?></td>
                            </tr>
                            <?php endwhile; ?>
                            <?php if($stock->num_rows <= 0): ?>
                                <tr>
                                    <td class="py-1 text-center" colspan="6">Historico vazio</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="5" class="text-center">Total Vendas</th>
                                <th class="text-right"><?= format_num($g_total,2) ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<noscript id="print-header">
    <div>
        <style>
            html{
                min-height:unset !important;
            }
        </style>
        <div class="d-flex w-100 align-items-center">
            <div class="col-2 text-center">
                <img src="<?= validate_image($_settings->info('logo')) ?>" alt="" class="rounded-circle border" style="width: 5em;height: 5em;object-fit:cover;object-position:center center">
            </div>
            <div class="col-8">
                <div style="line-height:1em">
                    <div class="text-center font-weight-bold h5 mb-0"><large><?= $_settings->info('name') ?></large></div>
                    <div class="text-center font-weight-bold h5 mb-0"><large>Historico de vendas</large></div>
                    <div class="text-center font-weight-bold h5 mb-0"><?= date("d/m/Y", strtotime($date)) ?></div>
                </div>
            </div>
        </div>
        <hr>
    </div>
</noscript>
<script>
    function print_r(){
        var h = $('head').clone()
        var el = $('#printout').clone()
        var ph = $($('noscript#print-header').html()).clone()
        h.find('title').text("Daily Sales Report - Print View")
        var nw = window.open("", "_blank", "width="+($(window).width() * .8)+",left="+($(window).width() * .1)+",height="+($(window).height() * .8)+",top="+($(window).height() * .1))
            nw.document.querySelector('head').innerHTML = h.html()
            nw.document.querySelector('body').innerHTML = ph[0].outerHTML
            nw.document.querySelector('body').innerHTML += el[0].outerHTML
            nw.document.close()
            start_loader()
            setTimeout(() => {
                nw.print()
                setTimeout(() => {
                    nw.close()
                    end_loader()
                }, 200);
            }, 300);
    }
    $(function(){
        $('#filter-form').submit(function(e){
            e.preventDefault()
            location.href = './?page=reports&'+$(this).serialize()
        })
        $('#print').click(function(){
            print_r()
        })

    })
</script>