<?php require __DIR__ . '/../layout/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Gestão de Clientes</h1>
    <a class="btn btn-primary" href="<?php echo BASE_URL; ?>/clientes/novo">Adicionar Cliente</a>
</div>

<div class="mb-4">
    <form action="<?php echo BASE_URL; ?>/clientes" method="GET" class="d-flex">
        <input type="text" name="busca" class="form-control me-2" placeholder="Buscar por nome..." value="<?= isset($_GET['busca']) ? htmlspecialchars($_GET['busca']) : '' ?>">
        <button type="submit" class="btn btn-info">Buscar</button>
    </form>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover w-100 mx-auto">
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
                        <a class="btn btn-warning btn-sm" href="clientes/editar/<?= $cliente->id ?>">Editar</a>
                        <a class="btn btn-danger btn-sm" href="clientes/excluir/<?= $cliente->id ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>