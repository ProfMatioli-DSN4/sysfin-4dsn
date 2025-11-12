<?php require __DIR__ . '/../layout/header.php'; ?>
<div class="container">
    <h1 class="mt-4">Editar Usuário</h1>
    <form action="<?php echo BASE_URL; ?>/usuario/editar/<?= $user->id ?>" method="POST">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" name="nome" id="nome" class="form-control" value="<?= htmlspecialchars($user->nome) ?>" required>
        </div>
        <div class="mb-3">
            <label for="login" class="form-label">Login:</label>
            <input type="text" name="login" id="login" class="form-control" value="<?= htmlspecialchars($user->login) ?>" required>
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Nova Senha (deixe em branco para não alterar):</label>
            <input type="password" name="senha" id="senha" class="form-control">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="ativo" id="ativo" class="form-check-input" value="1" <?= $user->ativo ? 'checked' : '' ?>>
            <label for="ativo" class="form-check-label">Ativo</label>
        </div>
        <div class="mb-3">
            <label for="profiles" class="form-label">Perfis:</label>
            <select name="profiles[]" id="profiles" class="form-select" multiple required>
                <?php foreach ($allProfiles as $profile): ?>
                    <option value="<?= $profile->id ?>" <?= $user->hasProfile($profile->id) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($profile->nome) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>
