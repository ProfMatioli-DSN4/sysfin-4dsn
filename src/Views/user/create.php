<?php require __DIR__ . '/../layout/header.php'; ?>
<h1>Novo Usuário</h1>
<form action="<?php echo BASE_URL; ?>/users/store" method="POST">
    <label for="nome">Nome:</label>
    <input type="text" name="nome" id="nome" required>
    <br>
    <label for="login">Login:</label>
    <input type="text" name="login" id="login" required>
    <br>
    <label for="senha">Senha:</label>
    <input type="password" name="senha" id="senha" required>
    <br>
    <label for="ativo">Ativo:</label>
    <input type="checkbox" name="ativo" id="ativo" value="1" checked>
    <br>
    <label for="profiles">Perfis:</label>
    <select name="profiles[]" id="profiles" multiple required>
        <?php foreach ($profiles as $profile): ?>
            <option value="<?= $profile->id ?>"><?= $profile->nome ?></option>
        <?php endforeach; ?>
    </select>
    <br>
    <button type="submit">Salvar</button>
</form>
<?php require __DIR__ . '/../layout/footer.php'; ?>
