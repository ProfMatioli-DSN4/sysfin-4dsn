<?php require '../layout/header.php'; ?>
<h1>Editar Usuário</h1>
<form action="/users/update/<?= $user['id'] ?>" method="POST">
    <label for="name">Nome:</label>
    <input type="text" name="name" id="name" value="<?= $user['name'] ?>" required>
    <br>
    <label for="login">Login:</label>
    <input type="text" name="login" id="login" value="<?= $user['login'] ?>" required>
    <br>
    <label for="password">Nova Senha (deixe em branco para não alterar):</label>
    <input type="password" name="password" id="password">
    <br>
    <label for="profiles">Perfis:</label>
    <select name="profiles[]" id="profiles" multiple required>
        <?php foreach ($profiles as $profile): ?>
            <option value="<?= $profile['id'] ?>" <?= in_array($profile['id'], $user['profiles']) ? 'selected' : '' ?>>
                <?= $profile['name'] ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br>
    <button type="submit">Salvar</button>
</form>
<?php require '../layout/footer.php'; ?>

