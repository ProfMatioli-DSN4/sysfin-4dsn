<div class="header-with-button" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
    <h1>Listagem de Plano de Contas</h1> 
    
    <a href="<?= BASE_URL ?>/plano-contas/criar" class="btn btn-primary">Cadastrar Nova Conta</a>
</div>

<div class="top-actions" style="margin-bottom: 20px;">
    <a href="<?= BASE_URL ?>/plano-contas/relatorio" class="btn btn-secondary">Exportar para PDF</a>
</div>

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
            <td><?= htmlspecialchars($conta->id) ?></td>
            <td><?= htmlspecialchars($conta->descricao) ?></td>
            <td><?= htmlspecialchars($conta->tipo) ?></td>
            <td>
                <a href="<?= BASE_URL ?>/plano-contas/editar/<?= $conta->id ?>" class="btn btn-warning">Editar</a>
                <a href="<?= BASE_URL ?>/plano-contas/excluir/<?= $conta->id ?>" class="btn btn-danger" onclick="return confirm('Confirmar exclusão?');">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>