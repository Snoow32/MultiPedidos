<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ffos_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

$sql = "SELECT status FROM config WHERE id = 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $status = $row["status"];
  echo $status;
} else {
  echo "0";
}

$conn->close();
?>
