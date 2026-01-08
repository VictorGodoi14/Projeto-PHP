<?php
require_once 'conecta.php'; // importa o $pdo
session_start();

// Verifica se os campos vieram
if (!isset($_POST['email']) || !isset($_POST['senha'])) {
    die("Requisição inválida.");
}

$email = trim($_POST['email']);
$senha = trim($_POST['senha']);

// Busca o usuário
$stmt = $pdo->prepare("SELECT * FROM user WHERE email = ? AND senha = ?");
$stmt->execute([$email, $senha]);
$usuario = $stmt->fetch();

if ($usuario) {
    // Login OK
    $_SESSION['usuario'] = $usuario['email'];
    header("Location: index.php"); // Página após login
    exit;
} else {
    // Login incorreto
    echo "<h2>Email ou senha inválidos!</h2>";
    echo '<a href="login.php">Tentar novamente</a>';
}
?>

