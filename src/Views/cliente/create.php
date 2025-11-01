<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="container mt-4">
    <h1 class="mb-4">Adicionar Novo Cliente</h1>

    <form action="<?php echo BASE_URL; ?>/clientes/novo" method="post">
        
        <div class="mb-3">
            <label for="nome" class="form-label">Nome Completo</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome do cliente" required>
        </div>
        
        <div class="mb-3">
            <label for="cpf_cnpj" class="form-label">CPF/CNPJ</label>
            <input type="text" class="form-control" id="cpf_cnpj" name="cpf_cnpj" placeholder="Digite o CPF ou CNPJ" required>
        </div>
        
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="exemplo@dominio.com">
        </div>
        
        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="telefone" name="telefone" placeholder="(00) 00000-0000">
        </div>
        
        <button type="submit" class="btn btn-success">Salvar Cliente</button>
        <a href="<?php echo BASE_URL; ?>/clientes" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>