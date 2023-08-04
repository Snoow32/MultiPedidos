<?php
require_once('./../../config.php');
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT * FROM `carrinho` where id = '{$_GET['id']}'");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_array() as $k => $v) {
            if (!is_numeric($k))
                $$k = htmlspecialchars_decode($v);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Verggilios - Pedidos</title>
</head>
<body>
    <style>
        @page {
            size: 226.772mm 226.772mm;
            margin: 0 0 0 0;
        }

        .style {
            margin: 0 10px 0 10px;
            padding: 0 0 0 0;
        }

        .title {
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            font-weight: 400;
        }

        .product-row {
            margin-bottom: 5px;
        }
        
        .product-name {
            float: left;
        }
        
        .product-price {
            float: right;
            text-align: right;
            margin-right: 10px;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            font-weight: 400;
        }
        
        .col-auto {
            font-size: 14px;
            font-weight: 400;
        }
        
        .cl {
           font-family: Arial, Helvetica, sans-serif;
           font-size: 14px;
           font-weight: 400; 
        }
    </style>
    <div>
        <div class="title">METODO DE ENVIO</div>
        <div class="title"><?= isset($menvio) ? $menvio : '' ?></div>
        
        
        <div class="cl">Restaurante: <?= $_settings->info('name') ?></div>
        <div class="col-auto">Data: <?= isset($created_at) ? date("d/m/Y H:i", strtotime($created_at)) : '' ?></div>
        <div class="col-auto">Tempo previsto: 30 minutos</div>
        <br>
        <div class="col-auto">Dados do cliente</div>
        <div class="col-auto">Nome: <?= isset($nome) ? $nome : '' ?></div>
        <div class="col-auto">Telefone: <?= '(' . substr($tel, 2, 2) . ') ' . substr_replace(substr($tel, 4), '-', 4, 0) ?></div></div>
        <div class="col-auto">Endereco: <?= isset($endereco) ? $endereco : '' ?></div>
        <div class="col-auto">Cidade: <?= isset($cidade_estado) ? $cidade_estado : '' ?></div>
        <br>
        <div class="col-auto">Itens do pedido</div>
        <?php
        if (isset($id)) {
            $items = $conn->query("SELECT * FROM `carrinho` where id = '{$id}'");
            $productNames = array();
            $total = array();
            $quantities = array();
            $prices = array();
            while ($row = $items->fetch_assoc()) {
                $productNames = array_merge($productNames, explode(", ", $row['product_name']));
                $quantities = array_merge($quantities, explode(", ", $row['quantity']));
                $prices = array_merge($prices, explode(", ", $row['price']));
                $total = array_merge($total, explode(", ", $row['total_valor_total']));
            }

            foreach ($productNames as $index => $productName) {
            }
        }
        ?>
        <div class="product-name"><?= implode("<br>", $productNames) ?></div>
        <div class="product-price"><?= implode("<br>", $prices) ?></div>
        <div style="clear: both;"></div>
        <br>
        <div>------------------------------------------</div>
        <div class="product-name">Taxa de entrega:</div>
        <div class="product-price">0,00</div>
        <div style="clear: both;"></div>
        <div class="product-name">Desconto:</div>
        <div class="product-price">0.00</div>
        <div style="clear: both;"></div>
        <div class="product-name">Cobrar do cliente:</div>
        <div class="product-price"><?= implode(", ", $total) ?></div>
        <div style="clear: both;"></div>
        <div>------------------------------------------</div>
        <br>
        <div class="col-auto">Forma de pagamento</div>
        <div class="col-auto">Cartao de credito</div>
        <br>
        <div class="col-auto">Observacoes</div>
        <div class="col-auto">Nenhuma</div>
        <br>
        <div>------------------------------------------</div>
        <br>
        <div class="title">Volte sempre.</div>
        <div class="title">V2.1.1</div>
    
    </div>
    <script>
        document.querySelector('title').innerHTML = "Verggilios - Pedidos";
    </script>
</body>
</html>