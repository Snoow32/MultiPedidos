<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["deletar"])) {
  $cart_id = $_SESSION['cart_id'];
  $sql = "DELETE FROM carrinho WHERE cart_id = '$cart_id'";

  if ($conn->query($sql) === TRUE) {
    echo "Colunas deletadas com sucesso!";
  } else {
    echo "Erro ao deletar colunas: " . $conn->error;
  }
}

$conn->close();
?>

