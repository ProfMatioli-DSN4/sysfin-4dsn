<?php require __DIR__ . '/../layout/header.php'; ?>
    <div class="form-container">
        <h2>Registrar Lançamento Manual no Caixa</h2>

        <?php if (isset($_GET['success'])): ?>
            <p class="success-message">Lançamento salvo com sucesso!</p>
        <?php endif; ?>

        <form method="POST" action="<?= BASE_URL ?>/lancamento-manual-caixa/salvar">

            <label>Data do Lançamento:</label>
            <input type="date" name="data_movimento" required><br><br>

            <label>Descrição:</label>
            <input type="text" name="descricao" required><br><br>

            <label>Valor:</label>
            <input type="number" step="0.01" name="valor" required><br><br>

            <label>Tipo:</label>
            <select name="tipo" required>
                <option value="Entrada">Entrada</option>
                <option value="Saída">Saída</option>
            </select><br><br>

            <label>Categoria (Plano de Contas):</label>
            <select name="id_plano_contas" required>
                <option value="">Selecione...</option>
                <?php foreach ($contas as $conta): ?>
                    <option value="<?= htmlspecialchars($conta->id) ?>">
                        <?= htmlspecialchars($conta->descricao) ?> (<?= htmlspecialchars($conta->tipo) ?>)
                    </option>
                <?php endforeach; ?>
            </select><br><br>

            <button type="submit">Salvar</button>
        </form>

    </div>
<?php require __DIR__ . '/../layout/footer.php'; ?>