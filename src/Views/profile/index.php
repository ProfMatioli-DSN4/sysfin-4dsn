<?php require '../layout/header.php'; ?>
<h1>Perfis</h1>
<a href="/profiles/create">Novo Perfil</a>
<table>
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
                <td><?= $profile->nome ?></td>
                <td>
                    <a href="/profiles/edit/<?= $profile->id ?>">Editar</a>
                    <a href="/profiles/delete/<?= $profile->id ?>">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php require '../layout/footer.php'; ?>
