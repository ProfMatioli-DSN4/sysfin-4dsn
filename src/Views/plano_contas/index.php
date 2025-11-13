<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Listagem de Plano de Contas</h1> 
    <a href="<?= BASE_URL ?>/plano-contas/criar" class="btn btn-primary">Cadastrar Nova Conta</a>
</div>

<div class="mb-3">
    <a href="<?= BASE_URL ?>/plano-contas/relatorio" class="btn btn-secondary">
        <i class="bi bi-file-earmark-pdf"></i> Exportar para PDF
    </a>
</div>

<table class="table table-striped table-hover">
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
            <td><?= htmlspecialchars($conta->id) ?></td>
            <td><?= htmlspecialchars($conta->descricao) ?></td>
            <td><?= htmlspecialchars($conta->tipo) ?></td>
            <td>
                <a href="<?= BASE_URL ?>/plano-contas/editar/<?= $conta->id ?>" class="btn btn-warning btn-sm">Editar</a>
                <a 
                    href="<?= BASE_URL ?>/plano-contas/excluir/<?= $conta->id ?>" 
                    class="btn btn-danger btn-sm" 
                    onclick="return confirm('Confirmar exclusão?');"
                >
                    Excluir
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>