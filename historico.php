<?php
function obterHistorico($cart_id) {
    $conexao = mysqli_connect('localhost', 'root', '', 'ffos_db');

    if (!$conexao) {
        die('Erro na conexão com o banco de dados: ' . mysqli_connect_error());
    }

    $consulta = "SELECT COUNT(id) AS total FROM carrinho WHERE cart_id = ?";

    $stmt = mysqli_prepare($conexao, $consulta);

    if (!$stmt) {
        die('Erro na preparação da consulta: ' . mysqli_error($conexao));
    }

    mysqli_stmt_bind_param($stmt, 'i', $cart_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $total);

    if (mysqli_stmt_fetch($stmt)) {
        mysqli_stmt_close($stmt);
    } else {
        $total = 0;
    }

    mysqli_close($conexao);
    return $total;
}

?>