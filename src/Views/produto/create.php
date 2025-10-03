<?php require __DIR__ . '/../layout/header.php'; ?>
<div class="col-md-6">
    <h1>Cadastro de Produto</h1>
    <form action="<?php echo BASE_URL; ?>/produtos/novo " method="post">
        <div class="mb-3">
            <label class="form-label" for="nome" class="form-label">Nome:</label>
            <input class="form-control" type="text" id="nome" name="nome" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="descricao">Descrição:</label>
            <textarea class="form-control" name="descricao" id="descricao" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label" for="precoVenda">Preço de Venda:</label>
            <input class="form-control" type="number" id="precoVenda" name="preco_venda" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="estoque">Estoque:</label>
            <input class="form-control" type="number" id="estoque" name="estoque_atual" required>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>