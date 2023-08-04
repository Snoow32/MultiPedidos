<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    try {
        $conn = new PDO("mysql:host=localhost;dbname=verggilios", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email]);
        $result = $stmt->fetch();

        if ($result && password_verify($senha, $result['senha'])) {
            $_SESSION['user_id'] = $result['id'];
            $_SESSION['cart_id'] = $result['cart_id'];
        
            $response = array('message' => 'success');
            echo json_encode($response);
        } else {
            $response = array('message' => 'Credenciais inválidas.');
            echo json_encode($response);
        }
    } catch (PDOException $e) {
        echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
    }
}
?>
