<?php
session_start();
@include 'config.php';

if (!isset($_SESSION['cart_id'])) {
  $_SESSION['cart_id'] = session_id();
}

date_default_timezone_set('America/Sao_Paulo');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['carrinho'])) {
    $carrinho = json_decode($_POST['carrinho'], true);

    if (!empty($carrinho)) {
      $cart_id = $_SESSION['cart_id'];
      $user_id = $_SESSION['user_id'];
      $query = "SELECT cart_id, status_order FROM carrinho WHERE cart_id = '$cart_id'";
      $result = mysqli_query($conn, $query);

      $existingStatusOrders = [];
      $hasNonDeliveryStatusOrder = false;

      while ($row = mysqli_fetch_assoc($result)) {
        $existingStatusOrder = $row['status_order'];
        $existingStatusOrders[] = $existingStatusOrder;

        if ($existingStatusOrder !== 'Entregue') {
          $hasNonDeliveryStatusOrder = true;
        }
      }

      if ($hasNonDeliveryStatusOrder) {
        $deleteQuery = "DELETE FROM carrinho WHERE cart_id = '$cart_id' AND status_order != 'Entregue'";
        mysqli_query($conn, $deleteQuery);
      }

      $created_at = date('Y-m-d H:i:s');
      $totalValorTotal = 0;
      $product_names = [];
      $prices = [];
      $quantities = [];
      $queue = 1;

      foreach ($carrinho['items'] as $item) {
        $quantity = $item['quantidade'];
        $product_name = $item['nomeProduto'];
        $price = floatval($item['preco']);
        $valor_total = $item['valorTotal'];

        $totalValorTotal += $valor_total;
        $product_names[] = $product_name;
        $prices[] = $price;
        $quantities[] = $quantity;
      }

      $product_names_string = implode(", ", $product_names);
      $prices_string = implode(", ", array_map(function($price) {
        return number_format($price, 2, '.', '');
      }, $prices));
      $quantities_string = implode(", ", $quantities);

      $totalValorTotalFormatted = number_format($totalValorTotal, 2, '.', '');

      $query = "INSERT INTO carrinho (cart_id, created_at, product_name, price, quantity, total_valor_total, queue, status_order) VALUES ('$cart_id', '$created_at', '$product_names_string', '$prices_string', '$quantities_string', $totalValorTotalFormatted, $queue, 'Entregue')";

      if (mysqli_query($conn, $query)) {
        header("Location: formulario.php");
        exit;
      } else {
        echo "Ocorreu um erro ao inserir os dados do carrinho: " . mysqli_error($conn);
      }
    }
  }
}
?>
