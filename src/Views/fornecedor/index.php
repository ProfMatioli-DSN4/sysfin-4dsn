<?php require __DIR__ . '/../layout/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-4"></div>
<h2>Gestão de Fornecedores</h2>
<div class="mb-3">
    <a class="btn btn-primary" href="fornecedores/criar">Adicionar Fornecedor</a>
    <a class="btn btn-secondary" href="fornecedores/relatorio" target="_blank">📄 Exportar PDF</a>
</div>
</div>

<div class="col-md-12">
    <div class="mb-3">
        <form class="row g-3" method="get" action="">
            <div class="col-md-10">
                <input class="form-control" type="text" name="busca" placeholder="Buscar por nome"
                    value="<?= htmlspecialchars($_GET['busca'] ?? '') ?>">
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary" type="submit">Buscar</button>
            </div>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover w-100 mx-auto">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CNPJ</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
            <?php foreach ($fornecedor as $f): ?>
                <tr>
                    <td><?= $f['id'] ?></td>
                    <td><?= htmlspecialchars($f['nome']) ?></td>
                    <td><?= htmlspecialchars(preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $f['cnpj'])) ?>
                    </td>
                    <td><?= htmlspecialchars($f['email']) ?></td>
                    <td><?= htmlspecialchars($f['telefone']) ?></td>
                    <td>
                        <a class="btn btn-warning btn-sm" href="fornecedores/editar/<?= $f['id'] ?>">Editar</a>
                        <a class="btn btn-danger btn-sm" href="fornecedores/excluir/<?= $f['id'] ?>"
                            onclick="return confirm('Tem certeza que deseja excluir este fornecedor?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>