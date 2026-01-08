<?php
require_once 'proteger.php';
require_once 'config.php';
require_once 'conecta.php';

// Verifica se recebeu o ID via GET
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: seleciona.php?status=error&msg=ID inválido.");
    exit;
}

$id = (int) $_GET['id'];

// Prepara e executa o DELETE com segurança (PDO + bind)
$query = "DELETE FROM user WHERE id_user = :id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

if ($stmt->execute()) {
    header("Location: seleciona.php?status=success&msg=Usuário excluído com sucesso!");
    exit;
} else {
    header("Location: seleciona.php?status=error&msg=Erro ao excluir o usuário.");
    exit;
}

// Fecha conexão
$stmt = null;
$pdo = null;
?>
