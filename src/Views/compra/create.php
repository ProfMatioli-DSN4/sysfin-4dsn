<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="col-md-6">
    <h1>Criar Compra (Teste)</h1>

    <form action="<?php echo BASE_URL; ?>/compras/create" method="post">
        <!-- Fornecedor -->
        <div class="mb-3">
            <label class="form-label" for="id_fornecedor">ID do Fornecedor:</label>
            <input class="form-control" type="number" id="id_fornecedor" name="id_fornecedor" required>
        </div>

        <!-- Itens da Compra -->
        <h3>Itens da Compra</h3>
        <div class="item-compra mb-3">
            <label class="form-label" for="produto1">Produto 1 (ID):</label>
            <input class="form-control" type="number" id="produto1" name="itens[0][id_produto]" required>
            
            <label class="form-label mt-2" for="quant1">Quantidade:</label>
            <input class="form-control" type="number" id="quant1" name="itens[0][quantidade]" required>
            
            <label class="form-label mt-2" for="valor1">Valor Unitário:</label>
            <input class="form-control" type="number" step="0.01" id="valor1" name="itens[0][valor_unitario]" required>
        </div>

        <!-- Valor Total -->
        <div class="mb-3">
            <label class="form-label" for="valor_total">Valor Total:</label>
            <input class="form-control" type="number" step="0.01" id="valor_total" name="valor_total" readonly>
        </div>

        <button type="submit" class="btn btn-primary">Enviar Compra</button>
    </form>
</div>

<script>
    // Seleciona os campos
    const quant = document.getElementById('quant1');
    const valorUnit = document.getElementById('valor1');
    const valorTotal = document.getElementById('valor_total');

    // Função para calcular o valor total
    function calcularTotal() {
        const q = parseFloat(quant.value) || 0;
        const v = parseFloat(valorUnit.value) || 0;
        valorTotal.value = (q * v).toFixed(2);
    }

    // Atualiza automaticamente ao digitar
    quant.addEventListener('input', calcularTotal);
    valorUnit.addEventListener('input', calcularTotal);
</script>

<?php require __DIR__ . '/../layout/footer.php'; ?>
