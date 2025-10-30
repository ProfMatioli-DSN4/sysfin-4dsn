<?php


require __DIR__ . '/../layout/header.php';
?>

<style>
    .card-value {
        font-size: 2.25rem;
        font-weight: 700;
    }
    .text-positive {
        color: #198754;
    }
    .text-negative {
        color: #dc3545;
    }
    .text-alert {
        color: #ffc107;
    }
</style>

<div class="container-fluid px-4">

    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Painel Principal</li>
    </ol>

    <div class="row">

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Saldo Atual em Caixa</div>
                            <div class="card-value <?php echo ($saldoCaixa >= 0) ? 'text-positive' : 'text-negative'; ?>">
                                R$ <?php echo number_format($saldoCaixa, 2, ',', '.'); ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Vendido Hoje</div>
                            <div class="card-value">
                                R$ <?php echo number_format($totalVendidoHoje, 2, ',', '.'); ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-cash-register fa-2x text-gray-300"></i> </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Produtos com Estoque Baixo</div>
                            <div class="card-value <?php echo ($produtosEstoqueBaixo > 0) ? 'text-alert' : ''; ?>">
                                <?php echo $produtosEstoqueBaixo; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-boxes fa-2x text-gray-300"></i> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">Últimos Lançamentos</h6>
        </div>
        <div class="card-body">
            
            <?php if (empty($ultimosLancamentos)): ?>
                
                <div class="alert alert-info">Nenhuma movimentação encontrada.</div>
            
            <?php else: ?>
                
                <ul class="list-group list-group-flush">
                    <?php foreach ($ultimosLancamentos as $lancamento): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            
                            <span><?php echo htmlspecialchars($lancamento['descricao']); ?></span>
                            
                            <?php if ($lancamento['tipo'] == 'entrada'): ?>
                                <span class="badge bg-success rounded-pill">
                                    + R$ <?php echo number_format($lancamento['valor'], 2, ',', '.'); ?>
                                </span>
                            <?php else: ?>
                                <span class="badge bg-danger rounded-pill">
                                    - R$ <?php echo number_format($lancamento['valor'], 2, ',', '.'); ?>
                                </span>
                            <?php endif; ?>
                            
                        </li>
                    <?php endforeach; ?>
                </ul>
                
            <?php endif; ?>
            
        </div>
    </div>
    </div>
<?php

require __DIR__ . '/../layout/footer.php';
?>