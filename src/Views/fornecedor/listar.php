<?php require __DIR__ . '/../layout/header.php'; ?>
<h2>Fornecedores</h2>
<a href="fornecedor/create">+ Novo Fornecedor</a> |
<a href="fornecedor/relatorio" target="_blank">📄 Exportar PDF</a>

<form method="get" action="">
    <input type="text" name="busca" placeholder="Buscar por nome" value="<?= htmlspecialchars($_GET['busca'] ?? '') ?>">
    <button type="submit">Buscar</button>
</form>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th><th>Nome</th><th>CNPJ</th><th>Email</th><th>Telefone</th><th>Ações</th>
    </tr>
    <?php foreach($fornecedor as $f): ?>
        <tr>
            <td><?= $f['id'] ?></td>
            <td><?= htmlspecialchars($f['nome']) ?></td>
            <td><?= htmlspecialchars(preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $f['cnpj'])) ?></td>
            <td><?= htmlspecialchars($f['email']) ?></td>
            <td><?= htmlspecialchars($f['telefone']) ?></td>
            <td>
                <a href="fornecedor/<?= $f['id'] ?>/edit">✏️ Editar</a> |
                <a href="fornecedor/<?= $f['id'] ?>/delete" onclick="return confirm('Excluir fornecedor?')">🗑️ Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php require __DIR__ . '/../layout/footer.php'; ?>
