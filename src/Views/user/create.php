<?php require '../layout/header.php'; ?>
<h1>Novo Usuário</h1>
<form action="/users/store" method="POST">
    <label for="name">Nome:</label>
    <input type="text" name="name" id="name" required>
    <br>
    <label for="login">Login:</label>
    <input type="text" name="login" id="login" required>
    <br>
    <label for="password">Senha:</label>
    <input type="password" name="password" id="password" required>
    <br>
    <label for="profiles">Perfis:</label>
    <select name="profiles[]" id="profiles" multiple required>
        <?php foreach ($profiles as $profile): ?>
            <option value="<?= $profile['id'] ?>"><?= $profile['name'] ?></option>
        <?php endforeach; ?>
    </select>
    <br>
    <button type="submit">Salvar</button>
</form>
<?php require '../layout/footer.php'; ?>

