<?php require __DIR__ . '/../layout/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Relatório de Estoque</h1>

    <style>
        .baixo {
            background-color: #ffb3b3; 
        }
    </style>


</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover w-100 mx-auto">
        <thead>
            <tr>
                <th>ID</th>
                <th>Produto</th>
                <th>Estoque Atual</th>
                <th>Estoque Mínimo</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produtos as $p): ?>
                <?php
                 $estoque_minimo = $p->estoque_minimo ?? 5; //valor padrão para teste
                ?>
                <tr class="<?= ($p->estoque_atual < $estoque_minimo) ? 'baixo' : '' ?>">
                    <td><?= $p->id ?></td>
                    <td><?= htmlspecialchars($p->nome) ?></td> 
                    <td><?= $p->estoque_atual ?></td>
                    <td><?= $estoque_minimo ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
