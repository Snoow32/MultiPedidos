<?php
function obterNomeUsuario($cart_id) {
  $conexao = mysqli_connect('localhost', 'root', '', 'verggilios');

  if (!$conexao) {
    die('Erro na conexão com o banco de dados: ' . mysqli_connect_error());
  }

  $consulta = "SELECT nome FROM usuarios WHERE id = ?";

  $stmt = mysqli_prepare($conexao, $consulta);

  if (!$stmt) {
    die('Erro na preparação da consulta: ' . mysqli_error($conexao));
  }

  mysqli_stmt_bind_param($stmt, 'i', $cart_id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $nomeUsuario);

  if (mysqli_stmt_fetch($stmt)) {
    mysqli_stmt_close($stmt);
  } else {
    $nomeUsuario = 'Usuário não encontrado';
  }

  mysqli_close($conexao);
  return $nomeUsuario;
}
?>