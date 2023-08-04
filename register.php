<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    session_start();
    $cart_id = uniqid();

    $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

    try {
        $conn = new PDO("mysql:host=localhost;dbname=verggilios", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email]);
        $result = $stmt->fetch();

        if ($result) {
            echo "Email já cadastrado.";
        } else {
            $sql = "INSERT INTO usuarios (nome, email, senha, cart_id) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->execute([$nome, $email, $senhaCriptografada, $cart_id]);
                echo "Usuário registrado com sucesso!";
            } else {
                echo "Erro ao registrar usuário.";
            }
        }
    } catch (PDOException $e) {
        echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
    }
}
?>
