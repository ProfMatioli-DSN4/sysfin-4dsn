<?php require __DIR__ . '/../layout/header.php'; ?>
<h1>Editar Perfil</h1>
<form action="/profiles/update/<?= $profile->id ?>" method="POST">
    <label for="nome">Nome:</label>
    <input type="text" name="nome" id="nome" value="<?= $profile->nome ?>" required>
    <button type="submit">Salvar</button>
</form>
<?php require __DIR__ . '/../layout/footer.php'; ?>
