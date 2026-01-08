<?php
require_once 'proteger.php';
require_once 'config.php';
require_once 'conecta.php';
require_once 'header.php';



// --- [1] Atualização (UPDATE) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_user'] ?? '';
    $email = trim($_POST['email'] ?? '');
    $data = $_POST['data'] ?? '';

    if (empty($id) || empty($email) || empty($data)) {
        $msg = urlencode("Preencha todos os campos antes de atualizar.");
        header("Location: atualiza.php?status=error&msg={$msg}");
        exit;
    }

    try {
        $sql = "UPDATE user SET email = :email, data = :data WHERE id_user = :id_user";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':data', $data);
        $stmt->bindValue(':id_user', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $msg = urlencode("Usuário ID {$id} atualizado com sucesso!");
            header("Location: seleciona.php?status=success&msg={$msg}");
            exit;
        } else {
            $msg = urlencode("Nenhuma alteração realizada. Verifique os dados.");
            header("Location: atualiza.php?status=error&msg={$msg}");
            exit;
        }
    } catch (PDOException $e) {
        $msg = urlencode("Erro ao atualizar: " . $e->getMessage());
        header("Location: atualiza.php?status=error&msg={$msg}");
        exit;
    }
}

// --- [2] Exibição da lista para seleção (READ) ---
$stmt = $pdo->query("SELECT id_user, email, data FROM user ORDER BY id_user DESC");
$usuarios = $stmt->fetchAll();
?>

<h1>Atualizar Usuário</h1>
<p>Selecione um usuário e atualize o e-mail ou a data de cadastro.</p>

<?php if (count($usuarios) > 0): ?>
<form method="post" action="atualiza.php">
  <label for="id_user"><b>Selecione o usuário:</b></label>
  <select name="id_user" id="id_user" required>
    <option value="">-- Escolha --</option>
    <?php foreach ($usuarios as $u): ?>
      <option value="<?= htmlspecialchars($u['id_user']) ?>">
        <?= htmlspecialchars($u['id_user']) ?> - <?= htmlspecialchars($u['email']) ?>
      </option>
    <?php endforeach; ?>
  </select>
  <br><br>

  <label for="email"><b>Novo Email:</b></label><br>
  <input type="email" name="email" id="email" placeholder="novoemail@exemplo.com" required style="width: 300px;">
  <br><br>

  <label for="data"><b>Nova Data de Cadastro:</b></label><br>
  <input type="date" name="data" id="data" required value="<?= date('Y-m-d'); ?>">
  <br><br>

  <input type="submit" value="Atualizar Usuário">
</form>

<?php else: ?>
  <p>Nenhum usuário encontrado. <a href="cadastro.php">Cadastre um novo</a>.</p>
<?php endif; ?>

<?php require_once 'footer.php'; ?>
