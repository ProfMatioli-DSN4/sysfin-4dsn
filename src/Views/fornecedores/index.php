<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Gestão de Fornecedores</h1>
    <a class="btn btn-primary" href="<?php echo BASE_URL; ?>/fornecedores/novo">Adicionar Fornecedor</a>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover w-100 mx-auto">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CNPJ</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($fornecedores)): ?>
                <?php foreach ($fornecedores as $fornecedor): ?>
                    <tr>
                        <td><?= $fornecedor->id ?></td>
                        <td><?= htmlspecialchars($fornecedor->nome) ?></td>
                        <td><?= htmlspecialchars($fornecedor->cnpj) ?></td>
                        <td><?= htmlspecialchars($fornecedor->email) ?></td>
                        <td><?= htmlspecialchars($fornecedor->telefone) ?></td>
                        <td>
                            <a class="btn btn-warning btn-sm" href="<?php echo BASE_URL; ?>/fornecedores/edit/<?= $fornecedor->id ?>">Editar</a>
                            <a class="btn btn-danger btn-sm" href="<?php echo BASE_URL; ?>/fornecedores/delete/<?= $fornecedor->id ?>" onclick="return confirm('Tem certeza que deseja excluir este fornecedor?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">Nenhum fornecedor cadastrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
