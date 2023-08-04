<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ffos_db";

$status = $_POST['status'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

$sql = "UPDATE config SET status = $status WHERE id = 1";

if ($conn->query($sql) === TRUE) {
  echo "Status atualizado com sucesso.";
} else {
  echo "Erro ao atualizar o status: " . $conn->error;
}

$conn->close();
?>
