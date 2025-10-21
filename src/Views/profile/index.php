<?php require __DIR__ . '/../layout/header.php'; ?>
<div class="container">
    <h1 class="mt-4">Perfis</h1>
    <a href="profiles/create" class="btn btn-primary mb-3">Novo Perfil</a>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
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
                    <td><?= $profile->nome ?></td>
                    <td>
                        <a href="profiles/edit/<?= $profile->id ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="profiles/delete/<?= $profile->id ?>" class="btn btn-danger btn-sm">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>
