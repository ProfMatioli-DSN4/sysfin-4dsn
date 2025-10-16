<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Registro de Compras</h1>
</div>

<div class="row">
    <div class="col-md-12">
        <form id="formRegistroCompra" action="<?php echo BASE_URL; ?>/compras/finalizar" method="post">
            <div class="card mb-4">
                <div class="card-header">
                    Informações da Compra
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="fornecedor_id" class="form-label">Fornecedor:</label>
                        <select class="form-select" id="fornecedor_id" name="fornecedor_id" required>
                            <option value="">Selecione um fornecedor</option>
                            <?php foreach ($fornecedores as $fornecedor): ?>
                                <option value="<?= $fornecedor->id ?>"><?= htmlspecialchars($fornecedor->nome) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="data_compra" class="form-label">Data da Compra:</label>
                        <input type="date" class="form-control" id="data_compra" name="data_compra" value="<?= date('Y-m-d') ?>" required>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    Adicionar Itens
                </div>
                <div class="card-body">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-5">
                            <label for="produto_id" class="form-label">Produto:</label>
                            <select class="form-select" id="produto_id">
                                <option value="">Selecione um produto</option>
                                <?php foreach ($produtos as $produto): ?>
                                    <option value="<?= $produto->id ?>"
                                            data-nome="<?= htmlspecialchars($produto->nome) ?>"
                                            data-preco-venda="<?= htmlspecialchars($produto->preco_venda) ?>">
                                        <?= htmlspecialchars($produto->nome) ?> (R$ <?= number_format($produto->preco_venda, 2, ',', '.') ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="quantidade" class="form-label">Quantidade:</label>
                            <input type="number" class="form-control" id="quantidade" min="1" value="1">
                        </div>
                        <div class="col-md-3">
                            <label for="valor_unitario" class="form-label">Valor Unitário de Custo:</label>
                            <input type="number" class="form-control" id="valor_unitario" step="0.01" min="0.01" value="0.00">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-success w-100" id="adicionarItem">Add</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    Itens da Compra
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover w-100" id="tabelaItensCompra">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Produto</th>
                                    <th>Quantidade</th>
                                    <th>Valor Unit. Custo</th>
                                    <th>Subtotal</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-end">Valor Total da Compra:</th>
                                    <th id="valorTotalCompra" colspan="2">R$ 0,00</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <input type="hidden" name="itens_compra" id="itens_compra_input">
            <input type="hidden" name="valor_total" id="valor_total_input">

            <button type="submit" class="btn btn-primary" id="finalizarCompraBtn">Finalizar Compra</button>
        </form>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const produtoSelect = document.getElementById('produto_id');
        const quantidadeInput = document.getElementById('quantidade');
        const valorUnitarioInput = document.getElementById('valor_unitario');
        const adicionarItemBtn = document.getElementById('adicionarItem');
        const tabelaItensCompraBody = document.querySelector('#tabelaItensCompra tbody');
        const valorTotalCompraDisplay = document.getElementById('valorTotalCompra');
        const itensCompraInput = document.getElementById('itens_compra_input');
        const valorTotalInput = document.getElementById('valor_total_input');
        const finalizarCompraBtn = document.getElementById('finalizarCompraBtn');

        let itensCompra = [];

        produtoSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const precoVenda = parseFloat(selectedOption.dataset.precoVenda || 0);
            valorUnitarioInput.value = precoVenda.toFixed(2);
        });

        function calcularTotal() {
            let total = 0;
            itensCompra.forEach(item => {
                total += item.quantidade * item.valor_unitario;
            });
            valorTotalCompraDisplay.textContent = 'R$ ' + total.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            valorTotalInput.value = total.toFixed(2);
        }

        function renderizarItens() {
            tabelaItensCompraBody.innerHTML = '';
            itensCompra.forEach((item, index) => {
                const row = tabelaItensCompraBody.insertRow();
                const subtotal = item.quantidade * item.valor_unitario;

                row.innerHTML = `
                    <td>${item.id}</td>
                    <td>${item.nome}</td>
                    <td>${item.quantidade}</td>
                    <td>R$ ${item.valor_unitario.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                    <td>R$ ${subtotal.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm remover-item" data-index="${index}">Remover</button>
                    </td>
                `;
            });
            calcularTotal();
            itensCompraInput.value = JSON.stringify(itensCompra);
            finalizarCompraBtn.disabled = itensCompra.length === 0;
        }

        adicionarItemBtn.addEventListener('click', function() {
            const selectedOption = produtoSelect.options[produtoSelect.selectedIndex];
            const produtoId = selectedOption.value;
            const produtoNome = selectedOption.dataset.nome;
            const quantidade = parseInt(quantidadeInput.value);
            const valorUnitario = parseFloat(valorUnitarioInput.value);

            if (!produtoId || isNaN(quantidade) || quantidade <= 0 || isNaN(valorUnitario) || valorUnitario <= 0) {
                alert('Por favor, selecione um produto, uma quantidade e um valor unitário válidos.');
                return;
            }

            const itemExistenteIndex = itensCompra.findIndex(item => item.id === produtoId);

            if (itemExistenteIndex > -1) {
                itensCompra[itemExistenteIndex].quantidade = quantidade;
                itensCompra[itemExistenteIndex].valor_unitario = valorUnitario;
            } else {
                itensCompra.push({
                    id: produtoId,
                    nome: produtoNome,
                    quantidade: quantidade,
                    valor_unitario: valorUnitario
                });
            }

            produtoSelect.value = '';
            quantidadeInput.value = 1;
            valorUnitarioInput.value = '0.00';

            renderizarItens();
        });

        tabelaItensCompraBody.addEventListener('click', function(event) {
            if (event.target.classList.contains('remover-item')) {
                const indexToRemove = parseInt(event.target.dataset.index);
                itensCompra.splice(indexToRemove, 1);
                renderizarItens();
            }
        });

        finalizarCompraBtn.disabled = true;
    });
</script>

<?php require __DIR__ . '/../layout/footer.php'; ?>