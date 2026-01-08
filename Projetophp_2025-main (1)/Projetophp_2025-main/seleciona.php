<?php
require_once 'proteger.php';
require_once 'config.php';
require_once 'conecta.php';
require_once 'header.php';


// A mensagem de feedback (GET) será exibida automaticamente pelo header.php

$query = "SELECT id_user, email, data FROM user ORDER BY id_user DESC";
$stmt = $pdo->prepare($query);
$stmt->execute();

$registros = $stmt->fetchAll();

echo "<h1>Lista de Usuários Cadastrados</h1>";

if (count($registros) > 0) {
    echo "<table border='1' cellpadding='10' cellspacing='0' style='width: 100%; text-align:center;'>";
    echo "<thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Data de Cadastro</th>
                <th colspan='2'>Ações</th>
            </tr>
          </thead>";
    echo "<tbody>";

    foreach($registros as $user) {
        $id = htmlspecialchars($user['id_user']);
        echo "<tr>";
        echo "<td>$id</td>";
        echo "<td>" . htmlspecialchars($user['email']) . "</td>";
        echo "<td>" . htmlspecialchars($user['data']) . "</td>";

        // Botões de ação
        echo "<td><a href='atualiza.php?id=$id' style='background:#4CAF50;color:white;padding:5px 10px;border-radius:5px;text-decoration:none;'>Editar</a></td>";
        echo "<td><a href='excluir.php?id=$id' onclick='return confirm(\"Tem certeza que deseja excluir este usuário?\");' style='background:#f44336;color:white;padding:5px 10px;border-radius:5px;text-decoration:none;'>Excluir</a></td>";

        echo "</tr>";
    }

    echo "</tbody></table>";
} else {
    echo "<p>Nenhum usuário cadastrado. Que tal <a href='cadastro.php'>adicionar um</a>?</p>";
}

$stmt = null;
$pdo = null;

require_once 'footer.php';
?>
