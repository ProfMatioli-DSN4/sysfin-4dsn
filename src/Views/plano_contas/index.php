<?php

require __DIR__ . '/../layout/header.php';

if (!defined('BASE_URL')) { define('BASE_URL', '/'); }

$is_editing = !empty($conta) && !empty($conta->id);
$title = $is_editing ? 'Editar Conta' : 'Cadastrar Nova Conta';

$action_url = BASE_URL . '/plano-contas/create';
if ($is_editing) {
    $action_url = BASE_URL . '/plano-contas/edit/' . $conta->id;
}

$descricao = $conta->descricao ?? '';
$tipo = $conta->tipo ?? '';
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm mb-5">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><?php echo htmlspecialchars($title); ?></h5>
            </div>
            <div class="card-body">

                <form action="<?php echo htmlspecialchars($action_url); ?>" method="POST">
                    
                    <?php if ($is_editing): ?>
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($conta->id); ?>">
                    <?php endif; ?>

                    <div class="mb-3">
                        <label for="descricao" class="form-label fw-bold">
                            Descrição:
                        </label>
                        <input 
                            type="text" 
                            id="descricao" 
                            name="descricao" 
                            value="<?php echo htmlspecialchars($descricao); ?>" 
                            required
                            class="form-control"
                            placeholder="Ex: Receita de Vendas ou Pagamento de Aluguel"
                        >
                    </div>

                    <div class="mb-3">
                        <label for="tipo" class="form-label fw-bold">
                            Tipo:
                        </label>
                        <select 
                            id="tipo" 
                            name="tipo" 
                            required
                            class="form-select"
                        >
                            <option value="" disabled hidden <?php echo (empty($tipo) ? 'selected' : ''); ?>>Selecione...</option>
                            <option 
                                value="Receita" 
                                <?php echo ($tipo === 'Receita' ? 'selected' : ''); ?>
                            >
                                Receita
                            </option>
                            <option 
                                value="Despesa" 
                                <?php echo ($tipo === 'Despesa' ? 'selected' : ''); ?>
                            >
                                Despesa
                            </option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-between pt-3">
                        <button 
                            type="submit" 
                            class="btn btn-success flex-grow-1 me-2"
                        >
                            <i class="bi bi-save"></i> Salvar
                        </button>
                        
                        <a 
                            href="<?php echo BASE_URL; ?>/plano-contas" 
                            class="btn btn-secondary"
                        >
                            Voltar para a Lista
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<?php 
require __DIR__ . '/../layout/footer.php'; 
?>
