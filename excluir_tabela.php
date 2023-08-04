<?php
session_start();
@include 'config.php';

if (isset($_SESSION['cart_id'])) {
  $cart_id = $_SESSION['cart_id'];

  $query = "DROP TABLE IF EXISTS carrinho_$cart_id";
  if (mysqli_query($conn, $query)) {
    echo "Tabela excluída com sucesso.";
  } else {
    echo "Ocorreu um erro ao excluir a tabela: " . mysqli_error($conn);
  }
} else {
  echo "A sessão do carrinho não está definida.";
}
?>
