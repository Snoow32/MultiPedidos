<?php
include 'config.php';
ini_set('display_errors', 0);
error_reporting(E_ALL & ~E_NOTICE);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $telefone = $_POST['tel'];
    $endereco = $_POST['endereco'];
    $residencia = $_POST['residencia'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $observacao = $_POST['observacao'];
    $method = $_POST['method'];
    $menvio = $_POST['menvio'];

    $telefone = preg_replace('/\D/', '', $telefone);
    $telefone = '55' . $telefone;

    if (strlen($telefone) > 10) {
        $telefone = substr_replace($telefone, '', 5, 1);
    }

    session_start();
    if (!isset($_SESSION['cart_id'])) {
        header('Location: erro.php');
        exit;
    }

    $cart_id = $_SESSION['cart_id'];

    $endereco .= ', ' . $residencia . ' - ' . $bairro;

    $cidade_estado = $cidade . ' - ' . $estado;

    $sql = "UPDATE carrinho SET nome = ?, tel = ?, endereco = ?, observacao = ?, method = ?, menvio = ?, cidade_estado = ? WHERE cart_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssisssi", $nome, $telefone, $endereco, $observacao, $method, $menvio, $cidade_estado, $cart_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        echo "Dados atualizados com sucesso!";
    } else {
        echo "Erro ao atualizar dados no carrinho: " . mysqli_error($conn);
    }
}
?>
