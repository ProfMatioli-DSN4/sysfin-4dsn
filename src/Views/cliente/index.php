<h1>Lista de Clientes</h1>
<a href="/clientes/novo">Adicionar Cliente</a>
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>CPF/CNPJ</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($clientes as $cliente): ?>
            <tr>
                <td><?= $cliente->id ?></td>
                <td><?= htmlspecialchars($cliente->nome) ?></td>
                <td><?= htmlspecialchars($cliente->cpf_cnpj) ?></td>
                <td>
                    <a href="/clientes/editar/<?= $cliente->id ?>">Editar</a>
                    <a href="/clientes/excluir/<?= $cliente->id ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>