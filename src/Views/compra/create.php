<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Registro de Compras</h1>
</div>

<div class="row">
    <div class="col-md-12">
        <form method="post" action="<?php echo BASE_URL; ?>/compras">
            <div class="card mb-4">
                <div class="card-header">Informações da Compra</div>
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
                <div class="card-header">Adicionar Itens</div>
                <div class="card-body">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-5">
                            <label for="produto_id_add" class="form-label">Produto:</label>
                            <select class="form-select" id="produto_id_add" name="produto_id_add" required>
                                <option value="">Selecione um produto</option>
                                <?php foreach ($produtos as $produto): ?>
                                    <option value="<?= $produto->id ?>">
                                        <?= htmlspecialchars($produto->nome) ?>
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
                            <input type="number" class="form-control" id="valor_unitario_add" name="valor_unitario_add" step="0.01" min="0.01" required>
                        </div>

                        <div class="col-md-1">
                            <button class="btn btn-success w-100" name="adicionar_item">Add</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">Itens da Compra</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover w-100">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Produto</th>
                                    <th>Quantidade</th>
                                    <th>Valor Unit. Custo</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($itens)): ?>
                                    <?php foreach ($itens as $item): ?>
                                        <tr>
                                            <td><?= $item['id'] ?></td>
                                            <td><?= htmlspecialchars($item['nome']) ?></td>
                                            <td><?= number_format($item['quantidade'], 2, ',', '.') ?></td>
                                            <td>R$ <?= number_format($item['valor_unitario'], 2, ',', '.') ?></td>
                                            <td>R$ <?= number_format($item['subtotal'], 2, ',', '.') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="5" class="text-center">Nenhum item adicionado</td></tr>
                                <?php endif; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-end">Valor Total:</th>
                                    <th>R$ <?= number_format($total, 2, ',', '.') ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-3">
                        <button type="submit" name="limpar_itens" class="btn btn-secondary">Limpar Itens</button>
                        <button type="submit" formaction="<?php echo BASE_URL; ?>/compras/finalizar" class="btn btn-primary">Finalizar Compra</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
