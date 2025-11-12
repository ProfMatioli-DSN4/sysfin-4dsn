<?php 

require __DIR__ . '/../layout/header.php';
use App\Models\Fornecedor;

?>
<div class="col-md-6">
    <h2><?= $fornecedor ? "Editar" : "Novo" ?> fornecedor</h2>

    <form method="post" action="<?php echo BASE_URL . ($fornecedor ? "/fornecedores/editar/" . $fornecedor['id'] : "/fornecedores/criar")?>">
        <input type="hidden" name="id" value="<?= $fornecedor['id'] ?? '' ?>">

        <div class="">
            <label class="form-label">Nome:</label><br>
            <input class="form-control" type="text" name="nome" required value="<?= htmlspecialchars($fornecedor['nome'] ?? '') ?>"><br><br>
        </div>

        <div class="">
            <label class="form-label">CNPJ:</label><br>
            <input class="form-control" type="text" name="cnpj" required maxlength="18"
                value="<?= isset($fornecedor['cnpj']) ? preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $fornecedor['cnpj']) : '' ?>"
                oninput="mascaraCNPJ(this)">
                <?php if (!empty($error)): ?>
                    <p class="text-danger">
                        <?php echo $error ?>
                    </p>
                <?php endif; ?>
                <br><br>
        </div>

        <div class="">
            <label class="form-label">Email:</label><br>
            <input class="form-control" type="email" name="email" value="<?= htmlspecialchars($fornecedor['email'] ?? '') ?>"><br><br>
        </div>

        <div class="">
            <label class="form-label">Telefone:</label><br>
            <input class="form-control" type="text" name="telefone" value="<?= htmlspecialchars($fornecedor['telefone'] ?? '') ?>"><br><br>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>

<script>
    function mascaraCNPJ(input) {
        let v = input.value.replace(/\D/g, '');
        if (v.length > 14) v = v.slice(0, 14);
        v = v.replace(/^(\d{2})(\d)/, "$1.$2");
        v = v.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");
        v = v.replace(/\.(\d{3})(\d)/, ".$1/$2");
        v = v.replace(/(\d{4})(\d)/, "$1-$2");
        input.value = v;
    }

</script>
<?php require __DIR__ . '/../layout/footer.php'; ?>