<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>PHP PDO CRUD Aula</title>
    <link rel="stylesheet" href="style.css"> <!-- CSS externo -->
</head>
<body>

    <div class="nav-menu">
        <a href="index.php">Home/Menu</a>
        <a href="perfil.php">Quem Somos</a>
        <a href="cadastro.php">Cadastrar (Create)</a>
        <a href="seleciona.php">Visualizar (Read)</a>
        <a href="atualiza.php">Atualizar (Update)</a>
            <?php if (isset($_SESSION['usuario'])): ?>
            <span>Olá, <?= htmlspecialchars($_SESSION['usuario']) ?>!</span>
            <a href="logout.php">Sair</a>
        <?php else: ?>
            <a href="login.php">Entrar</a>
        <?php endif; ?>


       
       <?php if (basename($_SERVER['PHP_SELF']) === 'index.php'): ?>
            <a href="conecta.php" target="_blank" class="teste-btn">Testar Conexão</a>
        <?php endif; ?>
    </div>
    <div class="container">
    <?php
    // LEITURA DE MENSAGENS VIA GET
    $status = $_GET['status'] ?? '';
    $mensagem = $_GET['msg'] ?? '';

    if (!empty($status)) {
        $class = ($status === 'success') ? 'feedback-success' : 'feedback-error';
        echo "<div class='{$class}'>**" . htmlspecialchars(ucfirst($status)) . ":** " . htmlspecialchars($mensagem) . "</div>";
        // A mensagem é lida, mas não é limpa, pois está na URL.
    }
    ?>
    