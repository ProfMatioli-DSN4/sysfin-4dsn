<?php

$isEdit = $conta->id !== null;

$actionUrl = $isEdit ? BASE_URL . "/plano-contas/editar/{$conta->id}" : BASE_URL . "/plano-contas/novo";
?>

<form method="POST" action="<?= $actionUrl ?>">
    
    <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?= htmlspecialchars($conta->id) ?>">
    <?php endif; ?>
    
    <label for="descricao">Descrição:</label>
    <input type="text" id="descricao" name="descricao" 
           value="<?= htmlspecialchars($conta->descricao ?? '') ?>" required><br><br>

    <label for="tipo">Tipo:</label>
    <select id="tipo" name="tipo" required>
        <option value="Receita" <?= ($conta->tipo ?? '') === 'Receita' ? 'selected' : '' ?>>Receita</option>
        <option value="Despesa" <?= ($conta->tipo ?? '') === 'Despesa' ? 'selected' : '' ?>>Despesa</option>
    </select><br><br>

    <button type="submit"><?= $isEdit ? 'Salvar Edição' : 'Cadastrar Conta' ?></button>
    <a href="<?= BASE_URL ?>/plano-contas">Voltar para a Lista</a>
</form>