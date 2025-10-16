<?php require '../layout/header.php'; ?>
<h1>Usuários</h1>
<a href="/users/create">Novo Usuário</a>
<table>
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
                    $profileNames = [];
                    foreach ($user->getProfiles() as $profile) {
                        $profileNames[] = $profile->nome;
                    }
                    echo implode(', ', $profileNames);
                    ?>
                </td>
                <td>
                    <a href="/users/edit/<?= $user->id ?>">Editar</a>
                    <a href="/users/delete/<?= $user->id ?>">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php require '../layout/footer.php'; ?>
