<?php require __DIR__ . '/../layout/header.php'; ?>
    <div class="form-container">
        <h2>Registrar Lançamento Manual no Caixa</h2>

        <?php if (isset($_GET['success'])): ?>
            <p class="success-message">Lançamento salvo com sucesso!</p>
        <?php endif; ?>

        <form action="<?php echo BASE_URL; ?>/lancamento-manual-caixa/salvar" method="post">

            <div class="form-group">
                <label for="data_lancamento">Data do Lançamento</label>
                <input type="date" id="data_lancamento" name="data_lancamento" value="<?php echo date('Y-m-d'); ?>" required>
            </div>

            <div class="form-group">
                <label for="descricao">Descrição</label>
                <input type="text" id="descricao" name="descricao" placeholder="" required>
            </div>

            <div class="form-group">
                <label for="valor">Valor (R$)</label>
                <input type="number" id="valor" name="valor" step="0.01" min="0.01" placeholder="" required>
            </div>

            <div class="form-group">
                <label for="tipo">Tipo</label>
                <select id="tipo" name="tipo" required>
                    <option value="Entrada">Entrada</option>
                    <option value="Saída">Saída</option>
                </select>
            </div>

            <div class="form-group">
                <label for="plano_contas_id">Plano de Contas (Categoria)</label>
                <select id="plano_contas_id" name="id_plano_contas" required> 
                    <option value="">-- Selecione uma categoria --</option>
                    <option value="teste">teste</option>
                    <?php
                        // Loop para popular o seletor com os dados do controller
                        // while ($row = $planosDeContas->fetch(PDO::FETCH_ASSOC)) {
                        //     extract($row);
                        //     echo "<option value='{$id}'>{$descricao} ({$tipo})</option>";
                        // }
                    ?>
                </select>
            </div>

            <button type="submit">Salvar Lançamento</button>
        </form>
    </div>
<?php require __DIR__ . '/../layout/footer.php'; ?>