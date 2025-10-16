<?php require __DIR__ . '/layout/header.php'; ?>

<div class="container mt-4">
    <h2>Relatório de Vendas por Período</h2>
    <form method="POST" action="relatorio-venda/gerar" class="row g-3 mb-4">
        <div class="col-md-4">
            <label class="form-label">Data Inicial</label>
            <input type="date" name="data_inicial" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Data Final</label>
            <input type="date" name="data_final" class="form-control" required>
        </div>
        <div class="col-md-4 align-self-end">
            <button type="submit" class="btn btn-primary">Gerar Relatório</button>
        </div>
    </form>

    <?php if (isset($vendas)): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Cliente</th>
                    <th>Valor Total (R$)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($vendas as $v): ?>
                    <tr>
                        <td><?= date('d/m/Y', strtotime($v['data_venda'])) ?></td>
                        <td><?= htmlspecialchars($v['cliente']) ?></td>
                        <td><?= number_format($v['valor_total'], 2, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h5 class="mt-3">Número total de vendas: <?= $totalVendas ?></h5>
        <h5>Valor total vendido: R$ <?= number_format($valorTotal, 2, ',', '.') ?></h5>
    <?php endif; ?>
</div>
<?php require __DIR__ . '/layout/footer.php'; ?>
