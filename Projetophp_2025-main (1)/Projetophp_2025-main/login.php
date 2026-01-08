<?php

require_once 'header.php';
?>

<h1>Login</h1>

<form method="POST" action="valida_login.php">
    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Senha:</label><br>
    <input type="password" name="senha" required><br><br>

    <button type="submit">Entrar</button>
</form>

<p>Não tem conta? <a href="cadastro.php">Cadastre-se</a></p>

<?php
require_once 'footer.php';
?>
