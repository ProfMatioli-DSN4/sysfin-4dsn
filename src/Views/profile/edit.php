<?php require '../layout/header.php'; ?>
<h1>Editar Perfil</h1>
<form action="/profiles/update/<?= $profile['id'] ?>" method="POST">
    <label for="name">Nome:</label>
    <input type="text" name="name" id="name" value="<?= $profile['name'] ?>" required>
    <button type="submit">Salvar</button>
</form>
<?php require '../layout/footer.php'; ?>

