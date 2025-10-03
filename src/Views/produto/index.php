<?php require __DIR__ . '/../layout/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Gestão de Produtos</h1>
    <a class="btn btn-primary" href="<?php echo BASE_URL; ?>/produtos/novo">Adicionar Produto</a>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover w-100 mx-auto">

        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço de Venda</th>
                <th>Estoque</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produtos as $produto): ?>
                <tr>
                    <td><?= $produto->id ?></td>
                    <td><?= htmlspecialchars($produto->nome) ?></td>
                    <td><?= htmlspecialchars($produto->descricao) ?></td>
                    <td><?= htmlspecialchars($produto->preco_venda) ?></td>
                    <td><?= htmlspecialchars($produto->estoque_atual) ?></td>
                    <td>
                        <a class="btn btn-warning btn-sm" href="produtos/editar/<?= $produto->id ?>">Editar</a>
                        <a class="btn btn-danger btn-sm" href="produtos/excluir/<?= $produto->id ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

    <?php require __DIR__ . '/../layout/footer.php'; ?>