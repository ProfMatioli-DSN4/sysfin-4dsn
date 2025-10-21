<?php require __DIR__ . '/../layout/header.php'; ?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gestão de Perfis</h1>
        <a class="btn btn-primary" href="<?php echo BASE_URL; ?>/profiles/create">Adicionar Perfil</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($profiles as $profile): ?>
                    <tr>
                        <td><?= $profile->id ?></td>
                        <td><?= htmlspecialchars($profile->nome) ?></td>
                        <td>
                            <a href="profiles/edit/<?= $profile->id ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="profiles/delete/<?= $profile->id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este perfil?');">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>
