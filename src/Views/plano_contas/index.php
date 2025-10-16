<h1>Listagem de Plano de Contas</h1>

<a href="/plano-contas/novo">Cadastrar Nova Conta</a>

<a href="/plano-contas/exportar">Exportar para PDF</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Descrição</th>
            <th>Tipo</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($contas as $conta): ?>
        <tr>
            <td><?= htmlspecialchars($conta['id']) ?></td>
            <td><?= htmlspecialchars($conta['descricao']) ?></td>
            <td><?= htmlspecialchars($conta['tipo']) ?></td>
            <td>
                <a href="/plano-contas/editar/<?= $conta['id'] ?>">Editar</a> |
                <a href="/plano-contas/excluir/<?= $conta['id'] ?>" onclick="return confirm('Confirmar exclusão?');">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>