<?php require __DIR__ . '/../layout/header.php'; ?>
<h1>Editar Usuário</h1>
<form action="/users/update/<?= $user->id ?>" method="POST">
    <label for="nome">Nome:</label>
    <input type="text" name="nome" id="nome" value="<?= $user->nome ?>" required>
    <br>
    <label for="login">Login:</label>
    <input type="text" name="login" id="login" value="<?= $user->login ?>" required>
    <br>
    <label for="senha">Nova Senha (deixe em branco para não alterar):</label>
    <input type="password" name="senha" id="senha">
    <br>
    <label for="ativo">Ativo:</label>
    <input type="checkbox" name="ativo" id="ativo" value="1" <?= $user->ativo ? 'checked' : '' ?>>
    <br>
    <label for="profiles">Perfis:</label>
    <select name="profiles[]" id="profiles" multiple required>
        <?php foreach ($profiles as $profile): ?>
            <option value="<?= $profile->id ?>" <?= $user->hasProfile($profile->id) ? 'selected' : '' ?>>
                <?= $profile->nome ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br>
    <button type="submit">Salvar</button>
</form>
<?php require __DIR__ . '/../layout/footer.php'; ?>
