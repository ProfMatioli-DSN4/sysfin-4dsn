<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="container mt-4">
    <h1 class="mb-4">Editar Cliente: <?= htmlspecialchars($cliente->nome) ?></h1>

    <form action="<?php echo BASE_URL; ?>/clientes/editar/<?= $cliente->id ?>" method="POST">
        
        <div class="mb-3">
            <label for="nome" class="form-label">Nome Completo</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?= htmlspecialchars($cliente->nome) ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="cpf_cnpj" class="form-label">CPF/CNPJ</label>
            <input type="text" class="form-control" id="cpf_cnpj" name="cpf_cnpj" value="<?= htmlspecialchars($cliente->cpf_cnpj) ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($cliente->email) ?>">
        </div>
        
        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="telefone" name="telefone" value="<?= htmlspecialchars($cliente->telefone) ?>">
        </div>
        
        <button type="submit" class="btn btn-success">Atualizar Cliente</button>
        <a href="<?php echo BASE_URL; ?>/clientes" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        
        // --- MÁSCARA DE TELEFONE ---
        $('#telefone').mask('(00) 00000-0000');
        
        // --- MÁSCARA DE CPF/CNPJ (DINÂMICA) ---
        var options = {
            onKeyPress: function(val, e, field, options) {
                const plain = val.replace(/\D/g, ''); // Remove tudo que não for dígito
                // Troca a máscara dinamicamente
                field.mask(plain.length > 11 ? '00.000.000/0000-00' : '000.000.000-009', options);
            }
        };
        
        // Seleciona o campo e já aplica a máscara correta (CPF ou CNPJ)
        // com base no tamanho do valor que veio do banco de dados.
        var cpfCnpjField = $('#cpf_cnpj');
        var plainValue = cpfCnpjField.val().replace(/\D/g, '');
        cpfCnpjField.mask(plainValue.length > 11 ? '00.000.000/0000-00' : '000.000.000-009', options);
    });
</script>

<?php require __DIR__ . '/../layout/footer.php'; ?>