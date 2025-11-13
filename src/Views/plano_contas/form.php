<?php

$isEdit = $conta->id !== null;

$actionUrl = $isEdit ? BASE_URL . "/plano-contas/editar/{$conta->id}" : BASE_URL . "/plano-contas/novo";
?>

<form method="POST" action="<?= $actionUrl ?>">
    
    <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?= htmlspecialchars($conta->id) ?>">
    <?php endif; ?>
    
    <div class="mb-3">
        <label for="descricao" class="form-label">Descrição:</label>
        <input 
            type="text" 
            id="descricao" 
            name="descricao" 
            class="form-control" 
            value="<?= htmlspecialchars($conta->descricao ?? '') ?>" 
            required
        >
    </div>

    <div class="mb-3">
        <label for="tipo" class="form-label">Tipo:</label>
        <select id="tipo" name="tipo" class="form-select" required>
            <option value="R" <?= ($conta->tipo ?? '') === 'R' ? 'selected' : '' ?>>Receita</option>
            <option value="D" <?= ($conta->tipo ?? '') === 'D' ? 'selected' : '' ?>>Despesa</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">
        <?= $isEdit ? 'Salvar Edição' : 'Cadastrar Conta' ?>
    </button>
    <a href="<?= BASE_URL ?>/plano-contas" class="btn btn-secondary">
        Voltar para a Lista
    </a>
</form>