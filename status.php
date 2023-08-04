<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ffos_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}

$result = mysqli_query($conn, "SELECT status FROM config");
$row = mysqli_fetch_assoc($result);
$status = $row['status'];

mysqli_close($conn);
echo $status;
?>
