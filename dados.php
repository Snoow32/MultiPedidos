<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = "localhost";
$dbname = "ffos_db";
$username = "root";
$password = "";


try {
  $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $query = "SELECT tel, nome FROM carrinho";
  $stmt = $conn->prepare($query);
  $stmt->execute();

  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $conn = null;

  echo json_encode($result);
} catch (PDOException $e) {
  error_log("Erro ao conectar ao banco de dados: " . $e->getMessage());

  echo "Ocorreu um erro ao processar a solicitação. Por favor, tente novamente mais tarde.";
}
?>
