<?php require __DIR__ . '/../layout/header.php'; ?>

<h1>Editar Perfil</h1>
<form action="<?php echo BASE_URL; ?>/profiles/update/<?= $profile->id ?>" method="POST">
    <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" class="form-control" value="<?= $profile->nome ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>

<?php require __DIR__ . '/../layout/footer.php'; ?>
