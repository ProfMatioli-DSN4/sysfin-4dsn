<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Gestão de Usuários</h1>
    <a class="btn btn-primary" href="<?php echo BASE_URL; ?>/users/create">Adicionar Usuário</a>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Login</th>
                <th>Ativo</th>
                <th>Perfis</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user->id ?></td>
                <td><?= $user->nome ?></td>
                <td><?= $user->login ?></td>
                <td><?= $user->ativo ? 'Sim' : 'Não' ?></td>
                <td>
                    <?php
                    $profiles = $user->getProfiles();
                    if (!empty($profiles)) {
                        echo implode(', ', array_map(function($p) { return $p->nome; }, $profiles));
                    }
                    ?>
                </td>
                <td>
                    <a href="users/edit/<?= $user->id ?>" class="btn btn-sm btn-warning">Editar</a>
                    <a href="users/delete/<?= $user->id ?>" class="btn btn-sm btn-danger" onclick="return confirm('Deseja realmente excluir este usuário?');">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require __DIR__ . '/../layout/footer.php'; ?>
