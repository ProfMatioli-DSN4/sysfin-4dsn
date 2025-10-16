<?php require __DIR__ . '/../layout/header.php'; ?>
<h2><?= $fornecedor ? "Editar" : "Novo" ?> fornecedor</h2>

<?php if (!empty($error)): ?>
    <div style="color: red;"><?= $error ?></div>
<?php endif; ?>

<form method="post" action="">
    <input type="hidden" name="id" value="<?= $fornecedor['id'] ?? '' ?>">

    <label>Nome:</label><br>
    <input type="text" name="nome" required value="<?= htmlspecialchars($fornecedor['nome'] ?? '') ?>"><br><br>

    <label>CNPJ:</label><br>
    <input type="text" name="cnpj" required maxlength="18"
           value="<?= isset($fornecedor['cnpj']) ? preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $fornecedor['cnpj']) : '' ?>"
           oninput="mascaraCNPJ(this)"><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?= htmlspecialchars($fornecedor['email'] ?? '') ?>"><br><br>

    <label>Telefone:</label><br>
    <input type="text" name="telefone" value="<?= htmlspecialchars($fornecedor['telefone'] ?? '') ?>"><br><br>

    <button type="submit">Salvar</button>
</form>

<script>
function mascaraCNPJ(input) {
    let v = input.value.replace(/\D/g, '');
    if (v.length > 14) v = v.slice(0,14);
    v = v.replace(/^(\d{2})(\d)/, "$1.$2");
    v = v.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");
    v = v.replace(/\.(\d{3})(\d)/, ".$1/$2");
    v = v.replace(/(\d{4})(\d)/, "$1-$2");
    input.value = v;
}

</script>
<?php require __DIR__ . '/../layout/footer.php'; ?>