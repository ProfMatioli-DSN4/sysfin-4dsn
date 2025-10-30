<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Registro de Compras</h1>
</div>

<div class="row">
    <div class="col-md-12">
        <form id="formRegistroCompra" action="<?php echo BASE_URL; ?>/compras/registrar" method="post">
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
        <form method="post" action="">
            <div class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label for="produto_id_add" class="form-label">Produto:</label>
                    <select class="form-select" id="produto_id_add" name="produto_id_add" required>
                        <option value="">Selecione um produto</option>
                        <?php foreach ($produtos as $produto): ?>
                            <option value="<?= $produto->id ?>"
                                data-preco-venda="<?= htmlspecialchars($produto->preco_venda) ?>">
                                <?= htmlspecialchars($produto->nome) ?> (R$ <?= number_format($produto->preco_venda, 2, ',', '.') ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="quantidade_add" class="form-label">Quantidade:</label>
                    <input type="number" class="form-control" id="quantidade_add" name="quantidade_add" min="1" value="1" required>
                </div>
                <div class="col-md-3">
                    <label for="valor_unitario_add" class="form-label">Valor Unitário de Custo:</label>
                    <input type="number" class="form-control" id="valor_unitario_add" name="valor_unitario_add" step="0.01" min="0.01" value="0.00" required>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-success w-100" name="adicionar_item">Add</button>
                </div>
            </div>
        </form>
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

<?php require __DIR__ . '/../layout/footer.php'; ?>